<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/7/10
 * Time: 5:19 PM
 */

namespace app\models;

/**
 * 链表实现队列
 * Class LinkListQueue
 * @package app\models
 */
class LinkListQueue extends Linklist
{
    public $tail;    //尾节点

    /**
     * push
     * @param $value
     */
    public function push( $value ){

        if( $this->head->val==null ){
            $this->tail = new Node( $value );
            $this->head = $this->tail;
        }else{
            $this->tail->next =  new Node( $value );
            $this->tail = $this->tail->next;
        }
        $this->size++;
    }

    /**
     * pop
     * @return null
     * @throws \Exception
     */
    public function pop(){
        if( $this->size<=0 )
            throw new \Exception('超过链表范围');
        $val = $this->head->val;
        $this->head = $this->head->next;

        $this->size--;
        return $val;
    }

    /**
     * 查看队首
     */
    public function checkHead(){
        return $this->head->val;
    }

    /**
     * 查看队尾
     */
    public function checkEnd(){
        return $this->tail->val;
    }

    /**
     * toString
     */
    public function toString(){
        $r = [];
        while( $this->head ){
            $r[] = $this->head->val;
            $this->head = $this->head->next;
        }
        return implode('->',$r);
    }
}