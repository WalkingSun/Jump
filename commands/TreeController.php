<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/5/10
 * Time: 10:21 AM
 */
namespace app\commands;

Class TreeController extends \yii\console\Controller{

    # 二分搜索树实现
    public function actionBinarySearch(){
        $node = new \app\models\TreeBinarySearch();

        $node->add(5);
        $node->add(2);
        $node->add(3);
        $node->add(6);
        $node->add(8);
        $node->add(5);
        $node->deleteMin($node);
        $node->deleteMax($node);
        var_dump($node);
        die;


        $node->select('pre');//前序遍历
//        $node->select('in');//中序遍历 （结果是顺序）
//        $node->select('last');//后序遍历 应用：未二分搜索树释放内存
    }





}