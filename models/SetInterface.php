<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/7/17
 * Time: 10:32 AM
 */

namespace app\models;

/**
 * 集合接口
 * Interface SetInterface
 * @package app\models
 */
interface SetInterface
{

    public function insert($value);

    public function update($index,$value);

    public function delete($value);

    public function select($value);

    public function isExists($value);

    public function getSize();

    public function toString();


}