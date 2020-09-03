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



    public function  quickSort2( array $data,$left=0,$right=null){
        if(  empty($data) )
            throw new \Exception('array cannot null');

        $count = count($data);


        $pivot = $left;   //设定基准值
        $index = $pivot+1;
        $right = $right??($count-1);

        if( $left<$right ){
            for($i=$index;$i<=$right;$i++){
                if( $data[$i]<$data[$pivot] ){
                    [$data[$i],$data[$index]] = [$data[$index],$data[$i]]; //交换
                    $index++;
                }
            }

            [$data[$index-1],$data[$pivot]] = [$data[$pivot],$data[$index-1]];

//            var_dump($left.','.$right.','.($index-1).','.implode('_',$data));
            $data = $this->quickSort($data,$left,$index-1); var_dump($left.','.$right.','.($index-1).','.implode('_',$data));
            $data = $this->quickSort($data,$index+1,$right);die;var_dump($index.','.$right.','.$left);
        }

        return $data;
    }

    public function quick_sort($arr)
    {
        // 判断是否需要继续
        if (count($arr) <= 1) {
            return $arr;
        }

        $middle = $arr[0]; // 中间值

        $left = array(); // 小于中间值
        $right = array();// 大于中间值

        // 循环比较
        for ($i=1; $i < count($arr); $i++) {
            if ($middle < $arr[$i]) {
                // 大于中间值
                $right[] = $arr[$i];
            } else {

                // 小于中间值
                $left[] = $arr[$i];
            }
        }

        // 递归排序两边
        $left = $this->quick_sort($left);
        $right = $this->quick_sort($right);

        // 合并排序后的数据，别忘了合并中间值
        return array_merge($left, array($middle), $right);
    }


    /**
     * @param array $data
     * @param int|null $start
     * @param int|null $end
     * @return array
     */
    public function quickSort( array &$data,int $start=null,int $end=null ){
        $start = $start??0;
        $len = count($data);
        $end = $end??($len-1);
        $pivot = $data[$start];

        $j=$end;
        $i=$start;
        while($i<$j){

            for (;$j>$i;$j--){
                if($data[$j]<$pivot){
                    [$data[$i],$data[$j]] = [$data[$j],$data[$i]];
                    break;
                }
            }

           for (;$i<$j;$i++){
               if($data[$i]>$pivot){
                   [$data[$i],$data[$j]] = [$data[$j],$data[$i]];
                   break;
               }
           }

        }
//        var_dump($i,$j,implode('_',$data));

        if( $start<$i-1 )
            $this->quickSort($data,$start,$i-1);

        if( $j+1<$end )
            $this->quickSort($data,$j+1,$end);

        return $data;
    }
}