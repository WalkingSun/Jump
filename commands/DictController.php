<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/7/24
 * Time: 4:14 PM
 */

namespace app\commands;


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

        $dict = new DictLinkList();
        $dict->set('sun',111); //O(n)
        $dict->set('sun',222);
        $dict->set('w',111);
        $dict->set('k',111);
        var_dump($dict->get('w'));   //O(n)
        var_dump($dict->isExist('v'));   //O(n)
        var_dump($dict->delete('sun'));    //O(n)
        var_dump($dict->getSize());
//        print_r($dict);

        die;

    }


}