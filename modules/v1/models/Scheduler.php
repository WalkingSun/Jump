<?php
/**
 * Created by PhpStorm.
 * User: MW
 * Date: 2018/10/16
 * Time: 17:16
 */

namespace app\modules\v1\models;

/**
 * Class Scheduler 协程任务调度
 * @package app\modules\v1\models
 */
class Scheduler
{
    protected $maxTaskId = 0;
    protected $taskMap = [];            //任务map  taskId  => task
    protected $taskQueue;               //任务队列

    public function __construct()
    {
        $this->taskQueue = new \SplQueue();
    }

    /**新建任务
     * @param \Generator $coroutine
     */
    public function newTask( \Generator $coroutine ){
        $taskId = ++$this->maxTaskId;
        $task = new Task($taskId,$coroutine);
        $this->taskMap[$taskId] = $task;
        $this->enqueue($task);
        return $taskId;
    }

    public function enqueue(Task $task){
        return  $this->taskQueue->enqueue($task);
    }

    public function dequeue(){
        return $this->taskQueue->dequeue();
    }

    public function run(){
        while( !($this->taskQueue->isEmpty()) ){
            $task = $this->dequeue();
            $retval = $task->run();

            if ($retval instanceof SystemCall) {
                $retval($task, $this);
                continue;
            }

            if( $task->isFinished() ){
                unset($this->taskMap[$task->taskId]);
            }else{
                $this->enqueue($task);
            }
        }
    }
}