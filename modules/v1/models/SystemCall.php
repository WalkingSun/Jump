<?php
/**
 * Created by PhpStorm.
 * User: MW
 * Date: 2018/10/16
 * Time: 18:26
 */

namespace app\modules\v1\models;


class SystemCall {
    protected $callback;

    public function __construct(callable $callback) {
        $this->callback = $callback;
    }

    public function __invoke(Task $task, Scheduler $scheduler) {
        $callback = $this->callback;
        return $callback($task, $scheduler);
    }
}