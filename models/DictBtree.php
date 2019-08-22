<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/8/16
 * Time: 3:16 PM
 */

namespace app\models;


class DictBtree implements Dict
{
    public $key;
    public $value;

    public $left;
    public $right;
    private $size;

    public function __construct($key=null,$value=null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->left = null;
        $this->right = null;
        $this->size = 0;
    }

    public function set( $key , $value ){
        if( $this->size ==0 ){
            $node = new static( $key,$value );
            $this->key = $node->key;
            $this->value = $node->value;
            $this->size++;
        }else{
            $node = $this;
            while($node){
                if( $node->key == $key ){
                    $node->value = $value;
                    break;
                }
                if($node->key>$key){
                    if($node->left==null){
                        $node->left = new static( $key,$value );
                        $this->size++;
                        break;
                    }
                    $node = $node->left;
                }else{
                    if($node->right==null){
                        $node->right = new static( $key,$value );
                        $this->size++;
                        break;
                    }
                    $node = $node->right;
                }
            }
        }

        return $this;
    }

    public function get( $key ){
        if( $this->size ==0 )
            throw new \Exception('empty');
        $node = $this;
        while($node) {
            if ($node->key == $key) {
                return $node->value;
            }
            if ($node->key > $key) {
                $node = $node->left;
            } else {
                $node = $node->right;
            }
        }
        throw new \Exception('this key not exist');
    }

    public function isExist( $key ){
        if( $this->size ==0 )
            return false;
        $node = $this;
        while($node) {
            if ($node->key == $key) {
                return true;
            }
            if ($node->key > $key) {
                $node = $node->left;
            } else {
                $node = $node->right;
            }
        }
        return false;
    }

    public function delete($key){

        //找到元素，寻找元素左边最小元素
        $node = $this->select($key);
        if( $node->right!=null ){
            $node1 = $node->selectMin($node->right);

            //替换当前node
            $node->key = $node1->key;
            $node->value = $node1->value;

            //删除$node->right最小元素，获取最终元素赋给$node->right
            $nodeMin = $this->deleteMin($node->right);
            $node->right = $nodeMin;
        }else{
            $node1 = $node->selectMax($node->left);

            $node->key = $node1->key;
            $node->value = $node1->value;

            $nodeMax = $this->deleteMax($node->left);
            $node->left = $nodeMax;
        }

       return $this;

    }

    protected function deleteMin( $node ){
//        if( $this->size ==0 )
//            throw new \Exception('empty');

//        $prev = new static();
//        $prev->left = $node;
//        while($prev->left->left!=null){
//
//            $prev = $prev->left;
//        }
//        $prev->left = $prev->left->right;

        if( $node->left==null ){
            $rightNode = $node->right;
            $node->right = null;
            $this->size--;
            return $rightNode;
        }

       $node->left = $this->deleteMin($node->left);

        return $node;
    }

    protected function deleteMax($node){

        if( $node->right==null ){
            $leftNode = $node->left;
            $node->left = null;
            $this->size--;
            return $leftNode;
        }

        $node->right = $this->deleteMax($node->right);
        return $node;

    }

    public function getSize(){
        return $this->size;
    }


    public function select($key){
        $node = $this;

        while($node){
            if($node->key==$key){
                return $node;
            }
            if ($node->key > $key) {
                $node = $node->left;
            } else {
                $node = $node->right;
            }
        }

        throw new \Exception('this key not exist');
    }

    public function selectMin( $node ){
        while($node->left){

            $node = $node->left;
        }
        return $node;
    }


    public function selectMax( $node ){
        while($node->right){

            $node = $node->right;
        }
        return $node;
    }
}