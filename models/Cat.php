<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/6/16
 * Time: 10:00 PM
 */

namespace app\models;

use \yii\base\Component;

class Cat extends Component
{

    public function shut(){

        echo "there have a car is shuting!\r\n";
        $this->trigger('miao');
    }



}