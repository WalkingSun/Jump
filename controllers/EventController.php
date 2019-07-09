<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/6/16
 * Time: 11:23 AM
 */

namespace app\controllers;


use app\models\Cat;
use app\models\Dog;
use yii\web\Application;
use yii\web\Controller;

class EventController extends  Controller
{
    const EVENT_CALL='call';

    public function actionIndex(){

        \Yii::$app->on(Application::EVENT_AFTER_REQUEST,function(){
            echo 'after 111';
        });

        echo 1111;
    }

    public function actionCall(){

        $cat = new Cat();
        $dog = new Dog();

        $cat->on('miao',[$dog,'see']);
        $cat->shut();

    }

}