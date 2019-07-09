<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/7/3
 * Time: 4:09 PM
 */

namespace app\models;


class Node
{
    public $val;
    public $next;



    public function __construct( $val = null, $next = null )
    {
        $this->val  = $val;
        $this->next = $next;
    }


}