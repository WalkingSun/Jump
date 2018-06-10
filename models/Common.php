<?php
/**
 * Created by PhpStorm.
 * User: MW
 * Date: 2018/6/10
 * Time: 22:36
 */

namespace app\models;


class Common
{

    /***
     * Metaweblog 地址
     * @param $id  int    1 51cto;2 sina;3 csdn;4 163;5 oschina;6 cnblogs;7 chinaunix
     * @param $blogId string 博客id,有些博客需要，例如 cnblogs
     * 各大博客MetaWeblog地址
    http://imguowei.blog.51cto.com/xmlrpc.php	51cto
    http://upload.move.blog.sina.com.cn/blog_rebuild/blog/xmlrpc.php	sina
    http://write.blog.csdn.net/xmlrpc/index	csdn（每日20篇文章）
    http://os.blog.163.com/word/	163
    https://my.oschina.net/action/xmlrpc	oschina
    http://www.cnblogs.com/博客名称/services/metaweblog.aspx	cnblogs
    http://blog.chinaunix.net/xmlrpc.php?r=rpc/server	chinaunix
     */
    public static function MetaweblogUrl( $id='',$blogId='' ){

        $data = [
            1   =>  'http://imguowei.blog.51cto.com/xmlrpc.php',
            2   =>  'http://upload.move.blog.sina.com.cn/blog_rebuild/blog/xmlrpc.php',
            3   =>  'http://write.blog.csdn.net/xmlrpc/index',
            4   =>  'http://os.blog.163.com/word/',
            5   =>  'https://my.oschina.net/action/xmlrpc',
            6   =>  'http://www.cnblogs.com/'.$blogId.'/services/metaweblog.aspx',
            7   =>  ' http://blog.chinaunix.net/xmlrpc.php?r=rpc/server',
        ];

        if( $id ){
            return $data[$id];
        }

        return $data;
    }

    /**
     * blogType对应参数名称
     * @param $id int 1 51cto;2 sina;3 csdn;4 163;5 oschina;6 cnblogs;7 chinaunix
     */
    public static function blogParamName( $id ){
        $data = [
            1   =>    '51cto',
            2   =>    'sina',
            3   =>    'csdn',
            4   =>    '163',
            5   =>    'oschina',
            6   =>    'cnblogs',
            7   =>    'chinaunix',
        ];
        return $data[$id];
    }

}