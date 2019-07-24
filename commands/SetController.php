<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/7/24
 * Time: 4:14 PM
 */

namespace app\commands;


use app\models\Set;
use yii\console\Controller;

class SetController extends Controller
{

    public function actionIndex(){
        $set = new Set();


        $set->insert(5);
        $set->insert(8);
        $set->insert(10);
        $set->insert(4);
        $set->insert(2);


        $set->delete(8);
        $set->update(2,3);
        $set->toString();

        var_dump($set->select(5));

        var_dump( $set->isExists(10) );
        die;

    }


}