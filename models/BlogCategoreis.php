<?php
/**
 * Created by PhpStorm.
 * User: MW
 * Date: 2018/7/26
 * Time: 10:25
 */

namespace app\models;


trait BlogCategoreis
{

    //获取分类
    public function get( $blogName ){
        $cache = \Yii::$app->cache;
        if( !$cache->exists(\Yii::$app->params[$blogName]['blogid']) ){
            $blogid = \Yii::$app->params[$blogName]['blogid'];
            $blogMetaweblogUrl = Common::MetaweblogUrl(6,$blogid);
            $target = new MetaWeblog( $blogMetaweblogUrl );
            $username = \Yii::$app->params[$blogName]['username'];
            $passwd = \Yii::$app->params[$blogName]['password'];
            $target->setAuth( $username,$passwd );
            $Categories = $target->getCategories(\Yii::$app->params[$blogName]['blogid']);
            $cache->set(\Yii::$app->params[$blogName]['blogid'],json_encode($Categories),60*60*24*30);
        }
        return json_decode($cache->get(\Yii::$app->params[$blogName]['blogid']),1);
    }

}