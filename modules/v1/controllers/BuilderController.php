<?php
/**
 * Created by PhpStorm.
 * User: MW
 * Date: 2018/10/14
 * Time: 15:13
 */

namespace app\modules\v1\controllers;


use app\modules\v1\models\Scheduler;
use app\modules\v1\models\SystemCall;
use app\modules\v1\models\Task;
use yii\web\Controller;

class BuilderController extends Controller
{
    //参加鸟哥文章 http://www.laruence.com/2015/05/28/3038.html
    //yield  中断运行
    //生成器 是Iterator的实例，隐式调用迭代器执行一次，默认调用rewind(),代码运行到第一次yield出现的地方，yield语句的返回值可通过current()获取
    //send() 协程通信，传递数据,返回下一个yield返回值
    //rewind  重置生成器
    //next 生成器继续执行
    //valid 检查迭代器是否被关闭 如果迭代器已被关闭返回 FALSE，否则返回 TRUE。
    public function actionIndex(){
        $coroutine = $this->xrange(1,10);
        $coroutine2 = $this->xrange(1,2);
        $task = new Task(1,$coroutine);
        $task2 = new Task(2,$coroutine2);
        $res = $task->run();
        $res2 = $task2->run();
        var_dump($res);
        var_dump($res2);
        $task->sendValue = 111;
        $task2->sendValue = 222;
        var_dump($task->run());
        var_dump($task2->run());
        var_dump($task->run());
        var_dump($task2->run());

    }

    function xrange( $m,$n,$step=1 ){
        for ($n;$m<=$n;$m+=$step){
            $ret = yield $m;
            var_dump($ret);   //接受send数据
        }
    }


    /**==================调度================================*/

    //看到结果  任务一与任务二交替执行，任务一迭代五次结束，任务二继续执行
    public function actionSchedule(){
        $schedule = new Scheduler();
        $schedule->newTask($this->task1());
        $schedule->newTask($this->task2());
        $schedule->run();
    }

    function task1() {
        for ($i = 1; $i <= 10; ++$i) {
            echo "This is task 1 iteration $i.\n";
            yield;
        }
    }

    function task2() {
        for ($i = 1; $i <= 5; ++$i) {
            echo "This is task 2 iteration $i.\n";
            yield;
        }
    }

    /**=================================系统调用==================================*/
    //任务和调度器的通信，使用进程用来和操作系统会话同样的方式进行通信：系统调用

    public function actionSyscall(){
        $scheduler = new Scheduler;

        $scheduler->newTask($this->task(10));
        $scheduler->newTask($this->task(5));

        $scheduler->run();
    }

    function task($max) {
        $tid = (yield $this->getTaskId()); // <-- here's the syscall!
        for ($i = 1; $i <= $max; ++$i) {
            echo "This is task $tid iteration $i.\n";
            yield;
        }
    }

    //注意系统调用如何同其他任何调用一样正常地运行, 只不过预先增加了yield.
    function getTaskId() {
        return new SystemCall(function(Task $task, Scheduler $scheduler) {
            $task->setSendValue($task->getTaskId());
            $scheduler->enqueue($task);
        });
    }
}