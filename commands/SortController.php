<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/8/22
 * Time: 10:33 AM
 */

namespace app\commands;


use app\models\SortModel;
use yii\console\Controller;

class SortController extends Controller
{
    public function actionIndex(){

        $sortModel = new SortModel();

        $data = [5,8,3,2,6,9,7,10];

        $res = $sortModel->charu($data);   //插入排序
//        $res = $sortModel->maopao($data);  //冒泡排序
//        $res = $sortModel->xuanze($data);  //选择排序

        var_dump($res);die;



    }



}