<?php

namespace app\commands;

use app\models\Code;
use Yii;
use yii\filters\AccessControl;
use yii\console\Controller;
use yii\filters\VerbFilter;
use app\models\CodeForm;
use app\modules\Common;
use app\modules\UpYunForm;

class DownloadController extends Controller
{

    //下载凡人修仙传 大灰狼 有声听书  哈哈！！！
    public function actionIndex()
    {
        header("Content-type:text/html;charset=utf-8");

        $filepath = \Yii::$app->basePath.'/runtime/fanren/';
        for($i=711;$i<1700;$i++){
            $file="http://tingmp3.meiwenfen.com/%E7%8E%84%E5%B9%BB%E5%A5%87%E5%B9%BB/%E5%87%A1%E4%BA%BA%E4%BF%AE%E4%BB%99%E4%BC%A0/{$i}.mp3";
            $handle = fopen($file,'r');
            $filepathMp3 = $filepath."/{$i}.mp3";
            if( !file_exists($filepathMp3) ){
                $handle1 = fopen($filepathMp3, "w");
                fclose($handle1);
            }

            $r = file_put_contents($filepathMp3, $handle);
            fclose($handle);
            var_dump($i." $r \r\n");
            sleep(2);
        }
    }
}
