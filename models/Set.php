<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/7/17
 * Time: 10:37 AM
 */

namespace app\models;


class Set implements SetInterface
{
    protected $binarytree;

    public function __construct()
    {
        $this->binarytree = new TreeBinarySearch();
    }


    public function insert($value){
        $this->binarytree->add($value);

    }

    public function select( $value=null ){
        return $this->binarytree->select($value);
    }

    public function update( $index,$value ){
        $this->delete($index);
        return $this->insert($value);
    }

    public function delete($value){
        return $this->binarytree->delete($value);
    }

    public function isExists( $value ){
        return $this->select($value)?true:false;
    }

    public function toString(){
        return $this->select(null,'in');
    }

    public function getSize(){
        return $this->binarytree->size;
    }

}