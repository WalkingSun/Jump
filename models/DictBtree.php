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
    public $rigth;
    private $size;

    public function __construct($key,$value)
    {
//        $this->
    }

    public function set( $key , $value ){

    }

    public function get( $key ){

    }

    public function isExist( $key ){

    }

    public function delete($key){

    }

    public function getSize(){

    }

}