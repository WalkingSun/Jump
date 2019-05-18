<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/5/10
 * Time: 3:39 PM
 */

/**
 * 事件产生类
 * Class EventGenerator
 */
abstract class EventGenerator
{
    private $ObServers = [];

    //增加观察者
    public function add(ObServer $ObServer)
    {
        $this->ObServers[] = $ObServer;
    }

    //事件通知
    public function notify()
    {
        foreach ($this->ObServers as $ObServer) {
            $ObServer->update();
        }
    }

}

/**
 * 观察者接口类
 * Interface ObServer
 */
interface ObServer
{
    public function update($event_info = null);
}

/**
 * 观察者1
 */
class ObServer1 implements ObServer
{
    public function update($event_info = null)
    {
        echo "观察者1 收到执行通知 执行完毕！\n";
    }
}

/**
 * 观察者1
 */
class ObServer2 implements ObServer
{
    public function update($event_info = null)
    {
        echo "观察者2 收到执行通知 执行完毕！\n";
    }
}

/**
 * 事件
 * Class Event
 */
class Event extends EventGenerator
{
    /**
     * 触发事件
     */
    public function trigger()
    {
        //通知观察者
        $this->notify();
    }
}

//创建一个事件
$event = new Event();
//为事件增加旁观者
$event->add(new ObServer1());
$event->add(new ObServer2());
//执行事件 通知旁观者
$event->trigger();