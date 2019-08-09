<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/8/9
 * Time: 11:34 AM
 */

namespace app\models;

class MyClass extends \yii\base\Component
{
    public function __construct(/*Some lightweight dependencies here*/TreeBinarySearch $tree, $config )
    {
        // ...
        var_dump($config);
    }

    public function doSomething($param1, Linklist $something)
    {
        // do something with $something
        $something->addLast(1);
        var_dump($param1,$something);die;
    }
}