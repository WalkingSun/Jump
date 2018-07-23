<?php
/**
 * Created by PhpStorm.
 * User: MW
 * Date: 2018/7/23
 * Time: 20:32
 */

namespace app\commands;


use League\Csv\Reader;
use League\Csv\Statement;
use yii\console\Controller;

class ScanController  extends Controller
{
    public $argv;             //定义接受参数

    /**
     * 命令行接受参数
     * 传递参数如：php /app/space/jump/yii jump/emit_log --argv=123 --argv1=4876
     */
    public function options($actionID)
    {
        return ['argv'];
    }


    /**CSV文件扫描器**/
    public function actionIndex(){

        //实例 Guzzle HTTP客户端
        $client = new \GuzzleHttp\Client();

        //打开并迭代处理CSV 参考文档 https://csv.thephpleague.com/9.0/
//        $csv = \League\Csv\Reader::createFromPath(\Yii::$app->basePath.'/'.$this->argv);
        $csv = Reader::createFromPath(\Yii::$app->basePath.'/commands/'.$this->argv, 'r');
        $csv->setHeaderOffset(0);

        //get 25 records starting from the 11th row
        $stmt = (new Statement())
//            ->offset(10)
//            ->limit(25)
        ;

        $records = $stmt->process($csv);
//        print_r($records);die;
//        $csv = new \League\Csv\Reader($argv[1]);
        foreach ($records->getHeader() as $record){
            try{
                //发送HTTP OPTIONS请求
                $httpResponse = $client->options($record[0]);

                //检查HTTP响应的状态码
                if( $httpResponse->getStatusCode() >= 400){
                    throw new \Exception();
                }
            }catch(\Exception $e){
                //把死链发给标准输出
                echo $record[0] . PHP_EOL;
            }
        }

    }
}