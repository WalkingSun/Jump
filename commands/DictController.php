<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/7/24
 * Time: 4:14 PM
 */

namespace app\commands;


use app\models\DictBtree;
use app\models\DictLinkList;
use yii\console\Controller;

/**
 * 映射（字典）
 * Class DictController
 * @package app\commands
 */
class DictController extends Controller
{

    public function actionIndex(){

        #链表字典
//        $dict = new DictLinkList();
//        $dict->set('sun',111); //O(n)
//        $dict->set('sun',222);
//        $dict->set('w',111);
//        $dict->set('k',111);
//        var_dump($dict->get('w'));   //O(n)
//        var_dump($dict->isExist('v'));   //O(n)
//        var_dump($dict->delete('sun'));    //O(n)
//        var_dump($dict->getSize());
//        print_r($dict);


        # 二叉树字典
        $dict = new DictBtree();
        $dict->set('5',111); //O(n)
        $dict->set('9',222);
        $dict->set('6',222);
//        $dict->set('3',111);
//        $dict->set('4',111);
        $dict->set('18',111);
//        $dict->set('2',111);
//        $dict->set('1',111);
//        var_dump($dict->get('2'));   //O(n)
//        var_dump($dict->isExist('v'));   //O(n)
        $dict->delete(5);    //O(n)
//        var_dump($dict->getSize());
        print_r($dict);

        die;

    }


}