<?php
/**
 * Created by PhpStorm.
 * User: MW
 * Date: 2018/10/16
 * Time: 10:53
 */
namespace app\modules\v1\models;

/**
 * Class Task  协程任务
 * @package app\modules\v1\models
 */
class Task
{
    protected $taskId;    //任务id
    protected $coroutine;   //协程
    protected $beforeYieldFirst = true;         //首次运行yield
    protected $sendValue;         //send数据

    public function __construct( $taskId , \Generator $coroutine)
    {
        $this->taskId = $taskId;
        $this->coroutine = $coroutine;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function getTaskId() {
        return $this->taskId;
    }

    public function setSendValue($sendValue) {
        $this->sendValue = $sendValue;
    }

    public function run(){

        if( $this->beforeYieldFirst ){
            $this->beforeYieldFirst = false;
            return $this->coroutine->current();
        }else{
            $retval = $this->coroutine->send($this->sendValue);
            $this->sendValue = null;
            return $retval;
        }
    }

    public function isFinished() {
//        var_dump(!$this->coroutine->valid());
        return !$this->coroutine->valid();      //valid 检查迭代器是否被关闭 如果迭代器已被关闭返回 FALSE，否则返回 TRUE。
    }

}