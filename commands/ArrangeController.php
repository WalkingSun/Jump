<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/8/20
 * Time: 1:51 PM
 */

namespace app\commands;


use yii\console\Controller;

class ArrangeController extends Controller
{
    public function actionIndex(){
        $str = 'abc';
        $strArr = str_split($str);


        $r = $this->fullArrange($strArr);

        var_dump($r);die;




    }


    //全排列
    function fullArrange( $arr,$starti=0 )
    {
        static $result =[];
        static $str = '';
        if( count($arr)<=0 )
            throw new \Exception('空项');
        $count = count($arr);
        for ($i=$starti;$i<$count;$i++) {
            if($starti!=$i){
                $tmp = $arr[$i];
                $arr[$i] = $arr[$starti];
                $arr[$starti]= $tmp;
            }

            $str .= $arr[$i];

            if($starti== $count-1){
                $str .=',';
            }

            var_dump($arr[$i]);

            $this->fullArrange($arr,$i+1);



            if($starti!=$i){
                $tmp = $arr[$i];
                $arr[$i] = $arr[$starti];
                $arr[$starti]= $tmp;
            }
        }
        return $str;
    }


}