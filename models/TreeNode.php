<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/5/10
 * Time: 10:24 AM
 */

namespace app\models;


class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;

    public function __construct($value){
        $this->val = $value;
    }




}