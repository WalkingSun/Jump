<?php

namespace app\commands;

use app\models\FibonacciRpcClient;
use yii\console\Controller;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class JumpController extends Controller
{
    public $host = '192.168.33.30';
    public $port = '5672';
    public $user = 'guest';
    public $psd = 'guest';
    public $vhost = '/';

    public $mqName = 'hellos';

    public $argv;             //定义接受参数
    public $severity;             //路由键
    public $severities;      //路由键s

    /**
     * 命令行接受参数
     * 传递参数如：php /app/space/jump/yii jump/emit_log --argv=123 --argv1=4876
    */
    public function options($actionID)
    {
        return ['argv', 'severity','severities'];
    }


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
        $connection =  new AMQPStreamConnection($this->host,$this->port,$this->user,$this->psd,$this->vhost);
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

    /**交换机(Exchange)
     *类型：direct,topic,headers,fanout
     *举例：使fanout 类型创建日志
     * 参考：https://segmentfault.com/a/1190000013285229
     */

    //构建一个简单的日志系统。它将由两个程序组成，第一个程序将发出日志消息，第二个程序将接收并打印它们。

    //生成日志
    public function actionEmit_log(){
        $connection = new AMQPStreamConnection($this->host,$this->port,$this->user,$this->psd,$this->vhost);
        $channel = $connection->channel();

        $channel->exchange_declare('logs','fanout',false,false,false);

        //在建立连接之后，我们声明交换。这一步是必要的，因为发布到一个不存在的交换机是禁止的。
        //如果没有队列绑定到Exchange，消息将丢失，但这对我们来说是好的；如果没有用户正在监听，我们可以安全地丢弃消息。

        $data = $this->argv;//echo $this->argv;
        if( empty($data) ) $data = "info: Hello World!";
        $msg = new AMQPMessage($data);

        $channel->basic_publish($msg,'logs');

        echo "[x] Sent ",$data,"\n";

        $channel->close();
        $connection->close();
    }

    //接受显示日志
    public function actionReceive_logs(){
        $connection = new AMQPStreamConnection($this->host,$this->port,$this->user,$this->psd,$this->vhost);
        $channel = $connection->channel();

        //声明exchange
        $channel->exchange_declare('logs','fanout',false,false,false);

        //将队列名称作为空字符串提供时，我们创建一个带有生成名称的非持久队列
        //方法返回时，queue_name变量包含一个随机生成的RabbitMQ队列名称。例如，它可能看起来像amq.gen-jzty20brgko-hjmujj0wlg
        //当声明它关闭的连接时，队列将被删除，因为它被声明为独占。
        list($queue_name,,) = $channel->queue_declare("",false,false,true,false);

        //队列与交换绑定
        $channel->queue_bind($queue_name,'logs');

        echo '[*] Waiting for logs.To exit press CTRL+C',"\n";

        $callback = function($msg){
            echo ' [x] ',$msg->body."\n";
        };

        $channel->basic_consume($queue_name,'',false,true,false,false,$callback);

        while(count($channel->callbacks)){
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }


    /***
     * Direct Exchange
     * 参考链接：https://segmentfault.com/a/1190000013488291
     */

    public function actionEmit_log_direct(){
        $connection = new AMQPStreamConnection($this->host,$this->port,$this->user,$this->psd,$this->vhost);
        $channel = $connection->channel();

        $channel->exchange_declare('direct_logs','direct',false,false,false);

        $severity = $this->severity?$this->severity:"info";   //

        $data = $this->argv?$this->argv:'Hello World!';

        $msg = new AMQPMessage($data);

        $channel->basic_publish($msg,'direct_logs',$severity);

        echo " [x] Sent ",$severity,':',$data,"\n";

        $channel->close();
        $connection->close();
    }

    //php /app/space/jump/yii jump/receive_logs_direct --severities=info,warning
    //只接受路由键 info、warning 的日志
    public function actionReceive_logs_direct(){
        $connection = new AMQPStreamConnection($this->host,$this->port,$this->user,$this->psd,$this->vhost);
        $channel = $connection->channel();

        $channel->exchange_declare('direct_logs','direct',false,false,false);

        list($queue_name,,) = $channel->queue_declare("",false,false,true,false);

        $severities = !empty($this->severities)?explode(',',$this->severities):'';
        if(empty($severities)){
            file_put_contents('php://stderr',"Usage: [info] [warning] [error]\n");
            exit();
        }

        foreach ($severities as $severity){
            $channel->queue_bind($queue_name,'direct_logs',$severity);
        }

        echo ' [*] Waiting for logs.TO exit press CTRL+C',"\n";

        $callback = function($msg){
            echo ' [x] ',$msg->delivery_info['routing_key'],':',$msg->body."\n";
        };

        $channel->basic_consume($queue_name,'',false,true,false,false,$callback);

        while(count($channel->callbacks)){
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }


    /**Topic excahnge
     *
     * 参考链接：https://segmentfault.com/a/1190000013489663
     */

    //php receive_logs_topic.php "#"  接受所有日志
    //php receive_logs_topic.php "kern.*"   接受所有日志来自 kern
    //php receive_logs_topic.php "*.critical"  接受关于 critical 的日志
    //php receive_logs_topic.php "kern.*" "*.critical"  多个绑定
    //php emit_log_topic.php "kern.critical" "A critical kernel error"   触发一个日志来自路由键kern.critical类型
    public function actionEmit_log_topic(){
        $connection = new AMQPStreamConnection($this->host,$this->port,$this->user,$this->psd,$this->vhost);
        $channel = $connection->channel();

        $channel->exchange_declare('topic_logs','topic',false,false,false);

        $routing_key = $this->severity?$this->severity:"anonymous.info";
        $data = !empty($this->argv) ? $this->argv:'Hello World!';

        $msg = new AMQPMessage($data);

        $channel->basic_publish($msg,'topic_logs',$routing_key);

        echo " [x] Sent ",$routing_key,':',$data,"\n";

        $channel->close();
        $connection->close();
    }

    public function actionReceive_logs_topic(){
        $connection  = new AMQPStreamConnection($this->host,$this->port,$this->user,$this->psd,$this->vhost);
        $channel = $connection->channel();

        $channel->exchange_declare('topic_logs','topic',false,false,false);

        list($queue_name,,) = $channel->queue_declare("",false,false,true,false);

        $binding_keys = !empty($this->severities)?explode(',',$this->severities):'';
        if(empty($binding_keys)){
            file_put_contents('php://stderr', "Usage: $binding_keys [binding_key]\n");
            exit(1);
        }

        foreach ($binding_keys as $bind_key){
            $channel->queue_bind($queue_name,'topic_logs',$binding_keys);
        }

        echo ' [*] Waiting for logs,To exit press CTRL+C',"\n";

        $callback = function ($msg){
            echo ' [x] ',$msg->delivery_info['routing_key'],':',$msg->body,"\n";
        };

        $channel->basic_consume($queue_name,'',false,true,false,false,$callback);

        while(count($channel->callbacks)){
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }



    /**
     * （PRC）远程过程调用
     *
     * 参考链接：https://segmentfault.com/a/1190000013490939
     */

    //fibonacci(菲波那契)
    function fib($n){
        if( $n == 0 ){
            return 0;
        }

        if( $n==1){
            return 1;
        }

        return fib($n-1)+fib($n-2);
    }

    //RPC服务端
    public function actionRpc_server(){
        $connection = new AMQPStreamConnection($this->host,$this->port,$this->user,$this->psd,$this->vhost);
        $channel = $connection->channel();

        $channel->queue_declare('rpc_queue',false,false,false,false);

        echo " [x] Awaiting RPC requests /n";

        //fibonacci(菲波那契)
        function fib($n){
            if( $n == 0 ){
                return 0;
            }

            if( $n==1){
                return 1;
            }

            return fib($n-1)+fib($n-2);
        };

        $callback = function($req){
            $n = intval($req->body);
            echo " [.] fib(",$n,")\n";

            $msg = new AMQPMessage(
                (string) fib($n),
                array('correlation_id'=>$req->get('correlation_id'))
            );

            $req->delivery_info['channel']->basic_publish(
                $msg,'',$req->get('reply_to'));
            $req->delivery_info['channel']->basic_ack(
                $req->delivery_info['delivery_tag']
            );
        };

        $channel->basic_qos(null,1,null);
        $channel->basic_consume('rpc_queue','',false,false,false,false,$callback);

        while(count($channel->callbacks)){
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    //RPC 客户端
    public function actionRpc_client(){
        $fibonacci = new FibonacciRpcClient($this->host,$this->port,$this->user,$this->psd,$this->vhost);
        $response = $fibonacci->call(30);
        echo "[.] Got ",$response,"\n";
    }

}
