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
use app\models\MyClass;
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

        $object = \Yii::createObject([
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=demo',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ]);



        //构造函数注入
//        var_dump(\Yii::$container->get('app\models\MyClass',[1=>1]));

        //方法注入
//        $obj = new MyClass(/*...*/);
//        \Yii::$container->invoke([$obj, 'doSomething'], ['param1' => 42]); // $something will be provided by the DI container

        //回调方法注入
        \Yii::$container->set('yii\db\Connection',['class'=>'app\models\MyClass'],[1=>1]);
//        \Yii::$container->set('Foo', function () {
//            $foo =1111;
//             ... 其他初始化 ...
//            return $foo;
//        });

        $foo =  \Yii::$container->get('yii\db\Connection');
//        $foo =  \Yii::$container->get('Foo');
        var_dump($foo);
        die;
        $cat = new Cat();
        $dog = new Dog();
        $run = function(){
          echo "Then dog is running!\r\n";
        };

        $cat->on('miao',[$dog,'see']);
        $cat->on('miao',$run);
//        $cat->off('miao',[$dog,'see']);
        $cat->shut();
        die;
    }

}