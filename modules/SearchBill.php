<?php
/**
 * Created by SearchBill.php.
 * User: wuxiang
 * Date: 2016/12/14
 * Time: 11:42
 */

namespace app\modules;


use app\modules\v1\models\Basic;
use app\modules\v1\models\ErpFinder;

class SearchBill extends Basic
{
    /**
     *查询显示记录
     * @param $finder_id   查询标记
     * @param $fsShopGUID
     * @param $fsUserId
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getErpFinder($finder_id,$fsShopGUID,$fsUserId){
        $where= [
            'finder_id' => $finder_id,
            'fsShopGUID' => $fsShopGUID,
            'fsUserId' => $fsUserId
        ];
        $result  = ErpFinder::find()->where($where)->asArray()->one();
        if(empty($result)){
            return [];
        }
        return $result;
    }

}