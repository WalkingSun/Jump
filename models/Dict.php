<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/8/14
 * Time: 2:27 PM
 */

namespace app\models;

/**
 * 接口 字典
 * Interface Dict
 * @package app\models
 */
Interface Dict
{

    public function set( $key , $value );

    public function get( $key );

    public function isExist( $key );

    public function delete($key);

    public function getSize();


}