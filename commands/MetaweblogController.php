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

                #执行动作，1 创建，2 更新，3 删除
                switch ($v['action']){
                    case   1:
                        $this->save($target,$blog,$blogName);
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
        $filterList = [ '<','>'];
        $content = str_replace($filterList,'',$content);

        $params = [
            'title'=> $blog['title'],
            'description'=> $content,
            'categories'=> [ '[Markdown]' ]               //编辑器格式
        ];
//        Common::addLog('error.log',$params);
        if( !$blogIteam ){
            if( $target->newPost( $params ) ){
                $blog_id = $target->getBlogId();
                $DB->update($modelBlogRecord::tableName(),[$blogName.'Id'=>$blog_id],['id'=>$blog['id']]);
            }else{
                Common::addLog('error.log',$target->getErrorMessage());
            }
        }else{
            if( !$target->editPost( $blogIteam,$params ) ){
                Common::addLog('error.log',$target->getErrorMessage());
            }
        }

    }

    protected function delete(){

    }

    //markdown 转 html
    public function markdownToHtml( $MDurl,$style='none',$method='' ){
        $url = 'https://markdown.win/api.php?url='.$MDurl.'&style='.$style;
        if($method) $url .= '&method='.$method;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36");
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        $text = curl_exec($curl);
        curl_close($curl);
        print_r($url);die;
        $Parsedown = new Parsedown();

        return $Parsedown->text($text);
    }
}
