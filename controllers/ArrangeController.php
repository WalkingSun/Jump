<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/8/20
 * Time: 1:51 PM
 */

namespace app\controllers;


use yii\web\Controller;

class ArrangeController extends Controller
{
    //输入一个字符串，打印出该字符串的所有排列。
    //例如输入字符串abc，则输出由字符a、b、c所能排列出来的所有字符串 abc,acb,bac,bca,cab,cba。
    public function actionIndex(){
        ini_set('max_execution_time',0);
        $str = 'abc';
        $strArr = str_split($str);

        $r = $this->fullArrange($strArr);

        var_dump($r);die;

    }


    //全排列
    function fullArrange( $arr,$starti=0,&$result='' )
    {
        if( count($arr)<=0 )
            throw new \Exception('空项');

        $count = count($arr);

        if($starti == $count-1){
            $result .= implode($arr)."\n";
        }

        for ($i=$starti;$i<$count;$i++) {
            if($starti!=$i){
                $tmp = $arr[$i];
                $arr[$i] = $arr[$starti];
                $arr[$starti]= $tmp;
            }

            $this->fullArrange($arr,$starti+1,$result);

            if($starti!=$i){
                $tmp = $arr[$i];
                $arr[$i] = $arr[$starti];
                $arr[$starti]= $tmp;
            }
        }
        return $result;
    }


}