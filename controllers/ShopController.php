<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\modules\Common;

/**
 * 模拟抢购处理
 * Class ShopController
 * @package app\controllers
 */
class ShopController extends Controller
{
    public $goods = 'huawei P20';

    //初始化数据
    public function actionInit(){
        $redis = Yii::$app->redis;
        $redis->set('goodNums',100);   //设置库存
        $redis->del('order');           //清空抢购订单
        die('success');
    }

    //悲观锁
    //setnx 实现，有个问题 expire失败（1.人为错误;2.redis崩了）了，这个锁就持久化，一直被锁了
    public function actionBuy(){
        $userId = mt_rand(1,99999999);
        $goods = $this->goods;
        $redis = Yii::$app->redis;
        $lock = $goods;

        try {
            $inventory['num'] = $redis->get('goodNums');
            if($inventory['num']<=0){
                self::removeLock($lock);
                throw new \Exception('活动结束');
            }
            if( $redis->setnx($lock,1) ){
                $redis->expire($lock,60);//设置过期时间，防止死锁

                //业务处理  减库存，创建订单
                $redis->decr('goodNums');
                $redis->sadd('order',$userId);

                $this->removeLock($lock);

            }else{
                throw new \Exception($userId.' 抢购失败');
            }
            Common::addLog('shop.log',$userId.' 抢购成功');
        }catch (\Exception $e){
            $this->removeLock($lock);
            Common::addLog('shop.log',$e->getMessage());
        }

        die('success');
    }

    //删除锁
    protected function removeLock( $lock ){
        $redis = Yii::$app->redis;
        return $redis->del($lock);
    }

    //悲观锁
    //incr 解决expire失效，解锁
    public function actionBuy2(){
        $userId = mt_rand(1,99999999);
        $goods = $this->goods;
        $redis = Yii::$app->redis;
        $lock = $goods;

        try {
            $inventory['num'] = $redis->get('goodNums');
            if($inventory['num']<=0){
                $this->removeLock($lock);
                throw new \Exception('活动结束');
            }

            $lockset = $redis->incr($lock);
            if( !$lockset ){
                throw new \Exception($userId.' 抢购失败');
            }

            if($lockset==1){
                $redis->expire($lock,60);//设置过期时间，防止死锁

                //业务处理  减库存，创建订单
                $redis->decr('goodNums');
                $redis->sadd('order',$userId);

                $this->removeLock($lock);
            }

            //锁的数量大于1并且没有设置过期时间，失败处理
            if( $lockset>1 && $redis->ttl($lock)===-1 ){
                $this->removeLock($lock);
                throw new \Exception($userId.' 抢购失败');
            }

            Common::addLog('shop.log',$userId.' 抢购成功');
        }catch (\Exception $e){
            $this->removeLock($lock);
            Common::addLog('shop.log',$e->getMessage());
        }

        die('success');
    }


    //悲观锁
    //set key value [expiration EX seconds|PX milliseconds] [NX|XX] 原子命令（redis必须大于2.6版本）
    public function actionBuy3(){
        $userId = mt_rand(1,99999999);
        $goods = $this->goods;
        $redis = Yii::$app->redis;
        $lock = $goods;

        try {
            $inventory['num'] = $redis->get('goodNums');
            if($inventory['num']<=0){
                $this->removeLock($lock);
                throw new \Exception('活动结束');
            }

            $lockset = $redis->set($lock,1,'EX',60,'NX');
            if( !$lockset ){
                throw new \Exception($userId.' 抢购失败');
            }

            if($lockset==1){

                //业务处理  减库存，创建订单
                $redis->decr('goodNums');
                $redis->sadd('order',$userId);

                $this->removeLock($lock);
            }

            Common::addLog('shop.log',$userId.' 抢购成功');
        }catch (\Exception $e){
            $this->removeLock($lock);
            Common::addLog('shop.log',$e->getMessage());
        }

        die('success');
    }

    # 乐观锁
    public function actionBuy4(){
        $userId = mt_rand(1,99999999);
        $goods = $this->goods;
        $redis = Yii::$app->redis;
        $lock = $goods;

        try {
            $inventory['num'] = $redis->get('goodNums');
            if($inventory['num']<=0){
                throw new \Exception('活动结束');
            }

            $redis->watch($lock);
            $redis->multi();

            //todo：这里还需要重新判断下库存，否则会出现超发，高并发情况下$inventory['num']肯定会出现同时读取一个值；为了方便测试，没写db操作
            //redis事务是将命令放入队列中，无法取goodNums来判断库存是否结束，此处使用数据库来判断库存合理

            //业务处理  减库存，创建订单
            $redis->decr('goodNums');
            $redis->sadd('order',$userId);

            $redis->exec();

            Common::addLog('shop.log',$userId.' 抢购成功');
        }catch (\Exception $e){
            Common::addLog('shop.log',$e->getMessage());
        }

        die('success');
    }

    # 队列
    # 排队处理，让先进来的下单，后面的拦截掉  （此处不做模拟）
}
