<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/5/10
 * Time: 10:21 AM
 */
namespace app\commands;

use app\models\Linklist;
use app\models\LinkListQueue;
use app\models\LinklistStack;
use yii\web\Link;

Class LinklistController extends \yii\console\Controller{


    public function actionIndex(){

//        $node = new \app\models\Linklist();
//        $node->addFirst(1);
//        $node->addFirst(7);
//        $node->addFirst(9);
//        $node->add(0,5);
//        $node->add(1,7);
//        $node->add(2,10);
//        $node->edit(1,8);
//        var_dump($node->select(1)) ;
//        $node->delete(1);
//        $node->addLast(99);
//        var_dump($node->iscontain(2));
//        var_export($node);
//        var_export($node->tostring());


//        $stack = new LinklistStack();
//        $stack = new LinkListQueue();
//        $stack->push(1);
//        $stack->push(3);
//        $stack->push(6);
//        $stack->push(9);
//
//        print_r($stack->pop());
//        print_r($stack->head);
//        print_r($stack->checkHead());
//        print_r($stack->checkEnd());
//        print_r($stack->toString());


        $link = new Linklist();
        $link->addLast(1);
        $link->addLast(3);
        $link->addLast(5);
        $link->addLast(9);
        $link->addLast(5);
        $link->addLast(8);
        $link->addLast(5);


//        $link->removeFileds(5);

        $link->removeFiledsByRecursion(5);


        print_r($link->head->next);
        die;

    }





}