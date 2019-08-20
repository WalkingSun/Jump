<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/8/14
 * Time: 2:40 PM
 */

namespace app\models;


class DictLinkList implements Dict
{
    protected $size=0;
    public $key;
    public $value;
    public $next;

    public function __construct($key=null,$value=null,$next=null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->next = $next;
    }

    public function set($key,$value){
        $node = $this;
        while( $node && $node->next ){
            if( $node->next->key==$key ){
                $node->next->value = $value;
                return $node->next;
            }
            $node = $node->next;
        }

        $node->next =  new self($key,$value,$node->next);
        $this->size++;
        return  $node->next;
    }


    public function get($key){
        $node = $this;
        while($node){
            if( $node->key ==$key  ){
                return $node->value;
            }
            $node = $node->next;
        }

        throw new \Exception('cannot found key');
    }


    public function isExist($key)
    {
        $node = $this;
        while($node){
            if( $node->key ==$key  ){
                return true;
            }
            $node = $node->next;
        }
        return false;
    }

    public function delete($key)
    {
        if( $this->size==0)
            throw new \Exception('key is not exist');

        $node = $this;
        while($node->next){
            if( $node->next->key == $key  ){
                $node->next = $node->next->next;
                $this->size--;
                break;
            }
            $node = $node->next;
        }

        return $this;
    }

    public function getSize()
    {
        return $this->size;
    }
}