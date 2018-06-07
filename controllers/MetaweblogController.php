<?php
/**
 * Created by PhpStorm.
 * User: MW
 * Date: 2018/6/7
 * Time: 9:51
 */

namespace app\controllers;


use app\models\DB;
use app\models\MetaWeblog;
use yii\web\Controller;

class MetaweblogController extends Controller
{
    public $modelClass= 'app\models\JpBlogRecord';
    public $data;
    public $result;

    public function init()
    {
        parent::init();

        $this->data = array_merge(\Yii::$app->request->get(),\Yii::$app->request->post());
    }

    /**
     *各大博客MetaWeblog地址
    http://imguowei.blog.51cto.com/xmlrpc.php	51cto
    http://upload.move.blog.sina.com.cn/blog_rebuild/blog/xmlrpc.php	sina
    http://write.blog.csdn.net/xmlrpc/index	csdn（每日20篇文章）
    http://os.blog.163.com/word/	163
    https://my.oschina.net/action/xmlrpc	oschina
    http://www.cnblogs.com/博客名称/services/metaweblog.aspx	cnblogs
    http://blog.chinaunix.net/xmlrpc.php?r=rpc/server	chinaunix
     */
    public function  actionAdd(){

        $url = "http://www.cnblogs.com/followyou/services/metablogapi.aspx";
//        $url = "https://my.oschina.net/action/xmlrpc";
        $target = new MetaWeblog( $url );
        $username = \Yii::$app->params['cnblogs']['username'];
        $passwd = \Yii::$app->params['cnblogs']['password'];
        $target->setAuth( $username,$passwd );

        $blog_id = '';//784865;//等执行了发布新文章之后就会有这个值了

        if( $blog_id ){
            $params = [
                'title'=> '测试博文标题--编辑',
                'description'=> '测试博文内容--编辑',
                'categories'=> [ 1 ]
            ];
            if( !$target->editPost( $blog_id,$params ) ){
                var_dump( $target->getErrorMessage() );
            }
        }else{
            $params = [
                'title'=> '测试博文标题',
                'description'=> '测试博文内容',
                'categories'=> [ 1 ]
            ];
            if( $target->newPost( $params ) ){
                $blog_id = $target->getBlogId();
                var_dump( $blog_id );
            }else{
                var_dump( $target,$target->getErrorMessage() );
            }
        }




    }

    public function actionIndex(){
        $d = $this->data;
        $model =$this->modelClass;

        $filter = [];
        $offset = !empty($d['page']) ? $d['page']:1;
        $limit = !empty($d['size']) ? $d['size']:20;
        $orderType = ['createtime'=>SORT_DESC];
        $this->result = $model::getList($cols = array(), $filter , $offset , $limit , $andWhere='', $orWhere='', $orderType ,$andWhereArray = []);
        return $this->render('index',['result'=>$this->result]);
    }

    public function actionQueue(){
        $d = $this->data;
        $model = 'app\models\JpBlogQueue';

        $DB = new DB();
        $data = [
            'blogId'    => $d['blogId'],
            'action'    => $d['action'],
            'publishStatus'    => '',
            'response'    => '',
            'createtime'    => date('Y-m-d'),
            'updatetime'    => date('Y-m-d'),
        ];
        $DB->insert($model::tableName(),$data);

        echo json_encode(['code'=>200,'msg'=>'success']);
    }

}