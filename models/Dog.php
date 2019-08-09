<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/6/16
 * Time: 10:00 PM
 */

namespace app\models;

use \yii\base\Component;


class Dog extends Component
{

    public function see(){

        echo "The dog see a cat\r\n";
    }



}