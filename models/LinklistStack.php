<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/7/7
 * Time: 7:28 PM
 */

namespace app\models;

/**
 * 链表实现栈
 * Class LinklistStack
 * @package app\models
 */
class LinklistStack extends Linklist
{
    /**
     * @param $value
     */
    public function push( $value ){
        $this->addFirst($value);
    }

    /**
     * @return mixed
     */
    public function pop(){
        $r = $this->head->next->val;
        $this->delete(0);
        return $r;
    }
}