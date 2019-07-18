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
    public $size;
    protected $binarytree;

    public function __construct()
    {
        $this->binarytree = new TreeBinarySearch();
    }


    public function insert($value){
        $this->binarytree->add($value);
    }

    public function select( $value=null ){
        if( !$value )
            return $this->binarytree->select();
//        else

    }

    public function update( $index,$value ){

    }

    public function delete($value){

    }

    public function isExists( $value ){

    }

    public function toString(){

    }

    public function getSize(){
        return $this->size;
    }

}