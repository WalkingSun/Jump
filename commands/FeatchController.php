<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/5/29
 * Time: 4:19 PM
 */
//declare(strict_types=1);     //开启严格模式
namespace app\commands;


use yii\console\Controller;

class FeatchController extends Controller
{


    public function actionIndex(){

        var_dump($this->sumOfInts(2,'3.1',6));
        var_dump($this->sumOfInts(null));
        var_dump($page = $_GET['page'] ?? $_POST['page'] ?? 0);
        var_dump(intdiv( 10, 3 ));

        $arr = [1,2,3];
//list($a, $b, $c) = $arr;
        [$a, $b, $c] = $arr;

        //Error 捕获语法错误、Fatal eoor
        try{
            undefindfunc();
        }catch(\Error $e){
            var_dump($e->getMessage());
        }


        var_dump($a,$b,$c);die;
    }

    public function sumOfInts(? int ...$ints): ? int
    {
        return array_sum($ints);
    }

//    undefindfunc();
}