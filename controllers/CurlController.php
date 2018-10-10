<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class CurlController extends Controller
{
    public $urls =  [
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=>'http://192.168.33.30:83/wx/users/customerlist','params'=>''],
        ['url'=> '192.168.33.30:81','params'=>''],
        ['url'=> 'http://www.cnblogs.com/followyou/p/9725136.html','params'=>''],
    ];

    #参考https://segmentfault.com/a/1190000016343861#articleHeader0

    //curl循环请求
    public function actionLoop(){
        $urls = $this->urls;
        foreach($urls as $value) {
            $ch = curl_init();
            $url = $value['url'];
            $url .= strpos($url, '?') ? '&' : '?';
            $params = $value['params'];
            $url .= is_array($params) ? http_build_query($params) : $params;
            curl_setopt($ch, CURLOPT_URL, $url);
            // 设置数据通过字符串返回，而不是直接输出
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response[$url] = curl_exec($ch);
        }
        curl_close($ch);
        var_dump($response);
    }
    //curl多线程模拟
    public function actionMulti_threads(){
        $urls = $this->urls;
        $mh = curl_multi_init();
        $urlHandlers = [];
        $urlData = [];
        // 初始化多个请求句柄为一个
        foreach($urls as $value) {
            $ch = curl_init();
            $url = $value['url'];
            $url .= strpos($url, '?') ? '&' : '?';
            $params = $value['params'];
            $url .= is_array($params) ? http_build_query($params) : $params;
            curl_setopt($ch, CURLOPT_URL, $url);
            // 设置数据通过字符串返回，而不是直接输出
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $urlHandlers[$url] = $ch;
            curl_multi_add_handle($mh, $ch);
        }

        $active = null;
        // 检测操作的初始状态是否OK，CURLM_CALL_MULTI_PERFORM为常量值-1
        do {
            // 返回的$active是活跃连接的数量，$mrc是返回值，正常为0，异常为-1
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        // 如果还有活动的请求，同时操作状态OK，CURLM_OK为常量值0
        while ($active && $mrc == CURLM_OK) {
            // 持续查询状态并不利于处理任务，每50ms检查一次，此时释放CPU，降低机器负载
            usleep(50000);
            // 如果批处理句柄OK，重复检查操作状态直至OK。select返回值异常时为-1，正常为1（因为只有1个批处理句柄）
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        // 获取返回结果
        foreach($urlHandlers as $index => $ch) {
            $urlData[$index] = curl_multi_getcontent($ch);
            // 移除单个curl句柄
            curl_multi_remove_handle($mh, $ch);
        }
        curl_multi_close($mh);
        var_dump($urlData);
    }

    /**
     * 测试13个请求  循环处理时间 13050ms，curl批处理时间 6309ms,我本地环境CPU不行，相信生产的性能会更佳；
     * 超时时间：为了防止慢请求影响整个服务，可以设置CURLOPT_TIMEOUT来控制超时时间，防止部分假死的请求无限阻塞进程处理，最后打死机器服务。
     * CPU负载打满：如果持续查询并发的执行状态，会导致cpu的负载过高，所以，需要在代码里加上usleep(50000);的语句。
    同时，curl_multi_select也可以控制cpu占用，在数据有回应前会一直处于等待状态，新数据一来就会被唤醒并继续执行，减少了CPU的无谓消耗。
     * 并发数限制：
    curl_multi会消耗很多的系统资源，在并发请求时并发数有一定阈值，一般为512，是由于CURL内部限制，超过最大并发会导致失败。具体的测试结果我没有做，可以参考别人的文章：每次使用curl multi同时并发多少请求合适
     */
}
