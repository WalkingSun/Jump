<?php

namespace app\commands;

use app\models\Common;
use app\models\DB;
use yii\console\Controller;

class MetaweblogController extends Controller
{
    public $modelClass= 'app\models\JpBlogQueue';
    public function actionIndex(){
        $model = $this->modelClass;
        $modelBlogRecord = 'app\models\JpBlogRecord';
        $data = $model->find()->where(['publishStatus'=>0])->asArray()->all();

        if( $data ){
            foreach ($data as $v){
                $blogMetaweblogUrl = Common::MetaweblogUrl($v['blogType']);
                $target = new MetaWeblog( $blogMetaweblogUrl );
                $blogName = Common::blogParamName($v['blogType']);
                $username = \Yii::$app->params[$blogName]['username'];
                $passwd = \Yii::$app->params[$blogName]['password'];
                $target->setAuth( $username,$passwd );

                $blog = $modelBlogRecord::find()->where(['id'=>$v['blogId']])->asArray()->one();

                #执行动作，1 创建，2 更新，3 删除
                switch ($v['action']){
                    case   1:
                        $this->save($target,$blog);
                        break;
                    case    2:
                        $this->save($target,$blog,$blogName);
                        break;
                    case    3:
                        $this->delete($target);
                        break;
                    default:
                        continue;
                }
            }
        }

        die('success');
    }

    protected function save( $target,$blog ,$blogName=''){
        $modelBlogRecord = 'app\models\JpBlogRecord';
        $DB = new DB();

        $blogIteam = $blogName?$blog[$blogName.'Id']:'';
        $content = $blog['content']?:file_get_contents($blog['fileurl']);
        $params = [
            'title'=> $blog['title'],
            'description'=> $content,
            'categories'=> [ 1 ]
        ];
        if( !$blogIteam ){
            if( $target->newPost( $params ) ){
                $blog_id = $target->getBlogId();
                $DB->update($modelBlogRecord::tableName(),[$blogName.'Id'=>$blog_id],['id'=>$blog['id']]);
            }else{
                var_dump( $target,$target->getErrorMessage() );
            }
        }else{
            if( !$target->editPost( $blogIteam,$params ) ){
                var_dump( $target->getErrorMessage() );
            }
        }

    }

    protected function delete(){

    }
}
