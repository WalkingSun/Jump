<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/8/22
 * Time: 10:34 AM
 */

namespace app\models;


use yii\base\Object;

class SortModel extends Object
{

    /**冒泡法排序
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function maopao( array $data ){
        if(  empty($data) )
            throw new \Exception('array cannot null');

        $count = count($data);
        for ($i=0;$i<$count-1;$i++){
            for($j=0;$j<$count-$i-1;$j++){
                if($data[$j]>$data[$j+1]){
                    [$data[$j+1],$data[$j]] = [ $data[$j] , $data[$j+1] ];      //php7 中list方括号写法
                }
            }
        }

        return $data;
    }


    /**选择法排序
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function xuanze(array $data ){
        if(  empty($data) )
            throw new \Exception('array cannot null');

        $count = count($data);
        for($i=0;$i<$count;$i++){
            $min = $i;
            for ($j=$i+1;$j<$count;$j++){
                if($data[$i]>$data[$j]){
                    $min =$j;
                }
            }
            [$data[$i],$data[$min]] = [$data[$min],$data[$i]];
        }
        return $data;
    }

    /**
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function charu( array $data ){
        if(  empty($data) )
            throw new \Exception('array cannot null');

        $count = count($data);
        for ($i=2;$i<$count;$i++){
            $preIndex = $i;
            $current = $data[$i];
            for($j=$i-1;$j>=0;$j--){
                if( $data[$j]>$current ){
                    $data[$j+1] =  $data[$j];
                    $preIndex = $j;
                }
            }

            $data[$preIndex] = $current;
        }
        return $data;
    }

}