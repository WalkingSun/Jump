<?php

namespace app\commands;

use yii\console\Controller;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Yii;
use yii\db\Exception;

class SupplierController extends Controller
{

    public function actionIndex(){echo 111;die;
        $modelShop = 'app\modules\v1\models\Tbshop';
        $modelCommon = 'app\modules\v1\models\SCMTbFreUsedSup';
        $modelPO = 'app\modules\v1\models\SCMTbPurchaseOrder';

        //查询所有门店
        $shopList = $modelShop::find()->select(['fsShopGUID','fsShopName'])->where(['fiStatus'=>1])->andWhere(['in','fiShopKind',['7','8']])->asArray()->all();
        if( $shopList ){
            $DB = new DB();
            $tb = $modelCommon::tableName();
            try{
                foreach ($shopList as $k => $v){
                    //新增  订单最多的10个供应商
                    $time_end = date("Y-m-d");
                    $time_sta = date("Y-m-d",strtotime($time_end.' -90 Day'));
                    $sql = 'SELECT * FROM(
                                SELECT "fsSupplierId",count("fsSupplierId") as num FROM "SCM_tbPurchaseOrder" WHERE "fsShopGUID"=\''.$v['fsShopGUID'].'\' AND "fiDocumentStatus"=1 AND "fiStatus"=1 
                                AND "fsAuditTime" BETWEEN \''.$time_sta.'\' AND \''.$time_end.'\'
                                GROUP BY "fsSupplierId" 
                                ) 
                                as tmp ORDER BY num LIMIT 10';
                    $POlist = $DB->get_all($sql);
                    if( $POlist ){
                        //删除原数据
                        if( $modelCommon::find()->where(['fsShopGUID'=>$v['fsShopGUID']])->asArray()->one() ){
                            $del = $modelCommon::deleteAll(['fsShopGUID'=>$v['fsShopGUID']]);
                            if( !$del ) {
                                throw new Exception("{$tb}删除失败");
                            }
                        }

                        foreach ($POlist as $v1){
                            $data = [
                                'fsShopGUID'   =>   $v['fsShopGUID'],
                                'fsSupplierId'   =>   $v1['fsSupplierId'],
                                'fdNumber'   =>   $v1['num'],
                                'fsCreateTime'   =>   date('Y-m-d H:i:s'),
                                'fsUpdateTime'   =>   date('Y-m-d H:i:s'),
                            ];
                            $insert = $DB->insert($tb,$data);
                            if( !$insert ) {
                                throw new Exception("{$tb}添加失败，数据".var_export($data,1));
                            }
                        }
                    }
                }
            }catch(\Exception $e){
                //写日志
                $msg = $e->getMessage();
                error_log(date("Y-m-d H:i:s") . "：{$msg}\n", 3, Yii::$app->basePath . '/runtime/logs/fre_used_sup.log');
//                die('error');
            }
        }
        die('success');
    }

}
