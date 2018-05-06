<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\CodeForm;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitmqController extends Controller
{
    public $host = '192.168.33.30';
    public $port = '5672';
    public $user = 'guest';
    public $psd = 'guest';
    public $vhost = '/';

    public $mqName = 'hellos';

    //rabbitMQ发送
    public function actionSend(){
        //连接MQ
        $connection = new AMQPStreamConnection($this->host,$this->port,$this->user,$this->psd,$this->vhost);

        //建立通道
        $channel = $connection->channel();
//        $channel->tx_select();

        //声明队列
        $mqName = $this->mqName;
        $channel->queue_declare($mqName,false,false,false,false);

        //消息
        $content = !empty($_GET['content']) ? $_GET['content']: 'Hello World!';
        $msg = new AMQPMessage($content,['delivery_mode'=>2]);

        //发布消息
        $channel->basic_publish($msg,'',$mqName);
//        $channel->tx_commit();

        echo "[x] Sent '{$content}!'\n";

        $channel->close();
        $connection->close();
    }

    //接受消息
    public function actionReceive(){
        //连接MQ
        $connection = new AMQPStreamConnection('192.168.33.30','5672','guest','guest','/');

        //建立通道
        $mqName = $this->mqName;
        $channel = $connection->channel();
        $channel->queue_declare($mqName,false,false,false,false);

        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

        $callback = function($msg) {
            echo " [x] Received ", $msg->body, "\n";
            sleep(substr_count($msg->body, '.'));  //模拟业务执行时间延迟
            echo " [x] Done", "\n";

            //消费确认
            //$msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);

            error_log(" [x] Received ". $msg->body. "\n",3,\Yii::$app->basePath . '/runtime/logs/mq.log');
        };

        //消费 告诉服务器从队列中发送消息【消息是从服务器异步发送到客户机的】
        $channel->basic_consume($mqName, '', false, true, false, false, $callback);

        /**
         * 为了确保消息不会丢失，RabbitMQ支持消息确认。ACK消费者返回的结果告诉RabbitMQ有一条消息收到，可以自由可控的删除它；
         * 如果一个消费者中止，RabbitMQ将会重新分配消息，其他消费者可以处理。
         * 消息确认是默认关闭。可通过设置的第四个参数basic_consume设置为false（true意味着没有ACK）和从消费者发送合适的确认，一旦我们完成一个任务
         */


        //存在回调，阻塞等待
        while(count($channel->callbacks)) {
            $channel->wait();
        }

    }

    /**持久性及调度**/

    #生产者
    public function actionNew_task(){
        $connection =  new AMQPStreamConnection($this->host,$this->port,$this->user,$this->psd,$this->host);
        $channel = $connection->channel();

        #第三个参数 durable 消息持久化
        $channel->queue_declare('task_queue',false,true,false,false);

        $data = time();
        $msg = new AMQPMessage($data,array('delivery_mode'=>AMQPMessage::DELIVERY_MODE_PERSISTENT));

        $channel->basic_publish($msg,'','task_queue');

        echo " [x] Sent ",$data,"\n";

        $channel->close();
        $connection->close();
    }

    #消费者【工人】
    public function actionWorker(){
        $connection = new AMQPStreamConnection($this->host,$this->port,$this->user,$this->psd,$this->vhost);
        $channel = $connection->channel();

        $channel->queue_declare('task_queue',false,true,false,false);

        echo ' [*] Waiting for message. To exit press CTRL+C',"\n";

        $callback = function($msg){
            echo "[x] Received ",$msg->body,"\n";
            sleep( substr_count($msg->body,'.') );
            echo " [x] Done","\n";
            //确认消息
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        //多消费者，调度分发
        $channel->basic_qos(null,1,null);
        $channel->basic_consume('task_queue','',false,false,false,false,$callback);

        while(count($channel->callbacks)){
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
