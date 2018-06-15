<?php

namespace app\commands;

use app\models\Common;
use app\models\DB;
use app\models\MetaWeblog;
use app\models\Parsedown;
use yii\console\Controller;

class MetaweblogController extends Controller
{
    public $modelClass= 'app\models\JpBlogQueue';

    public function actionIndex(){
        $model = $this->modelClass;
        $modelBlogRecord = 'app\models\JpBlogRecord';
        $data = $model::find()->where(['publishStatus'=>0])->asArray()->all();

        $DB = new DB();
        Common::addLog('error.log',$data);

        if( $data ){
            foreach ($data as $v){
                $blogName = Common::blogParamName($v['blogType']);
                $blogid = $v['blogType']==6 ? \Yii::$app->params[$blogName]['blogid']:'';

                $blogMetaweblogUrl = Common::MetaweblogUrl($v['blogType'],$blogid);
                $target = new MetaWeblog( $blogMetaweblogUrl );
                $username = \Yii::$app->params[$blogName]['username'];
                $passwd = \Yii::$app->params[$blogName]['password'];
                $target->setAuth( $username,$passwd );

                $blog = $modelBlogRecord::find()->where(['id'=>$v['blogId']])->asArray()->one();
                $DB->update($model::tableName(),['publishStatus'=>1],['queueId'=>$v['queueId']]);   //更新队列状态  进行中

                #执行动作，1 创建，2 更新，3 删除
                if( $v['action']==1 || $v['action']==2 ){
                    $v['action'] = $blog[$blogName.'Id'] ? 2:1;
                }

                switch ($v['action']){
                    case   1:
                        $this->save($target,$blog,$blogName,$v);
                        break;
                    case    2:
                        $this->save($target,$blog,$blogName,$v);
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

    protected function save( $target,$blog ,$blogName='',$v){
        $model = 'app\models\JpBlogQueue';
        $modelBlogRecord = 'app\models\JpBlogRecord';
        $DB = new DB();

        $blogIteam = $blogName?$blog[$blogName.'Id']:'';
        $content = $blog['content']?:file_get_contents($blog['fileurl']);

        //xml替换不允许字符 参考： http://note.youdao.com/noteshare?id=f303e349322890f31aaea3bc84345d88&sub=wcp1529043319262675
        $content = str_replace('&','&amp;',$content);
        $content = str_replace('"','&quot;',$content);
        $content = str_replace("'",'&apos;',$content);
        $content = str_replace(">",'&gt;',$content);
        $content = str_replace("<",'&lt;',$content);

        $params = [
            'title'=> $blog['title'],
            'description'=> $content,
            'categories'=> [ '[Markdown]' ]               //编辑器格式
        ];
        if( !$blogIteam ){
            if( $target->newPost( $params ) ){
                $blog_id = $target->getBlogId();
                $DB->update($modelBlogRecord::tableName(),[$blogName.'Id'=>$blog_id],['id'=>$blog['id']]);
                $DB->update($model::tableName(),['publishStatus'=>2],['queueId'=>$v['queueId']]);                   //更新队列状态  发布成功
            }else{
                $DB->update($model::tableName(),['publishStatus'=>3],['queueId'=>$v['queueId']]);                   //更新队列状态  发布失败
                Common::addLog('error.log',$target->getErrorMessage());
            }
        }else{
            if( !$target->editPost( $blogIteam,$params ) ){
                $DB->update($model::tableName(),['publishStatus'=>3],['queueId'=>$v['queueId']]);                   //更新队列状态  发布失败
                Common::addLog('error.log',$target->getErrorMessage());
            }
        }

    }

    protected function delete(){

    }
}
