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

        $data = [5,3,7,6,4,1,0,2,9,10,8];
//        var_dump(intdiv( 10, 3 ),10/3);
//        $res = $sortModel->charu($data);   //插入排序
//        $res = $sortModel->maopao($data);  //冒泡排序
//        $res = $sortModel->xuanze($data);  //选择排序
//        $res = $sortModel->quick_sort($data);  //快速排序
        $res = $sortModel->quickSort2($data);  //快速排序

        var_dump($res);die;



    }

    public function actionIndex2(){

        $data = [
            [2,3,5,9],
            [3,4,7,10],
            [4,5,8,12],
            [6,8,9,15]
        ];
        $r = $this->checkValue($data,8);
       var_dump($r);die;
        die;


    }

    function checkValue(array $data,int $aim){
        $result = false;
        $start = 0;
        $end = count($data[0])-1;
        foreach ($data  as $k=>$v){
            $res = $this->erfenFind($v,$aim,$start,$end);var_dump($res);
            if($res['code']==0){
                $result = true;
                break;
            }elseif($res['code']==-1){
                $result = false;
                break;
            }else{
                $start = $res['start'];
                $end = $res['end'];
            }
        }
        return $result;
    }

    function erfenFind( $data,$aim,$start,$end ){
        $len = ($end-$start)+1;
        $len_center =  $start+intval($len/2);

        $result = ['code'=>-2,'start'=>$start,'end'=>$end];

        if($aim < $data[0]){
            return ['code'=>-1,'start'=>'','end'=>''];
        }


        if($aim==$data[$start] || $aim == $data[$end] || $aim==$data[$len_center]){
            $result = ['code'=>0,'start'=>'','end'=>''];
        }


        if($start<$end && $end!=$len_center){

            if( $aim < $data[$start] ){
                return ['code'=>-2,'start'=>$start-1,'end'=>$start];
            }

            if( $aim>$data[$end] ){
                return ['code'=>-2,'start'=>$end,'end'=>$end];
            }

            if( $aim<$data[$len_center] ){
                $result = $this->erfenFind($data,$aim,$start,$len_center);
            }else{
                $result = $this->erfenFind($data,$aim,$len_center,$end);
            }
        }

        return $result;
    }

    public function actionIndex3(){
        $data = [4,5,6,7,8,9,10,1,2,3];

        $r = $this->getMin($data,0,count($data)-1);
        var_dump($r);
        die;
    }


    public function getMin( array $data,$start,$end ){
        $center = $start+intval(($end-$start+1)/2);

        if( $center==$end ){

            return $data[$start]<$data[$end] ?$data[$start]:$data[$end];
        }

        if( $data[$center]>$data[$start]){
            return $this->getMin($data,$center,$end);
        }else{
            return $this->getMin($data,$start,$center);
        }


    }

    public function actionIndex4(){

        $data = ['a','b','c'];

//        $res= $this->get_combinations('abc');

//        var_dump($res);die;

        for($i=0;$i<count($data);$i++){

            $r = $this->arrange($data,$i+1,0,count($data)-1);
        }

    }

    function arrange( array $data,int $num,int $start,int $end,$prev='' ){
        if( $num==0 ){
           echo $prev.',';
           return;
        }

        for($i=$start;$i<=$end;$i++){
            $t= $data[$i];
            $this->arrange($data,$num-1,$i+1,$end,$prev.$t);
        }

       return ;
    }

    function get_combinations($str = '', &$comb = array())
    {
        if (trim($str) == '' || ! $str) return false;
        if (strlen($str) <= 1) {
            $comb[] = $str;
        } else {
            $str_first = $str[0];
            $comb_temp = $this->get_combinations(substr($str, 1), $comb);
            $comb[] = $str_first;
            foreach ($comb_temp as $k => $v) {
                $comb[] = $str_first . $v;
            }
        }
        return $comb;
    }


    public function actionIndex5(){
        $data = [3, 2, 5, 6, 1];

        usort($data,function($a,$b){
            return $a<=>$b;
        });


        $data = [
            ['id' => 2, 'name'=> 'sun'],
            ['id' => 1, 'name'=> 'c'],
            ['id' => 9, 'name'=> 'b'],
            ['id' => 6, 'name'=> 'g'],
        ];

        usort($data,function($a,$b){
            return $a['id']<=>$b['id'];
        });

        var_dump($data);


        die;

    }

}