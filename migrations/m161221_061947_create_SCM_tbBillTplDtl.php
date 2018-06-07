<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbBillTplDtl 单据模板明细
 */
class m161221_061947_create_SCM_tbBillTplDtl extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbBillTplDtl', [
            'fsBillTplId' =>'VARCHAR(20) NOT NULL', // 模板代码
            'fsMaterialId'=>'VARCHAR(30) NOT NULL', // 物料代码
            'fdNumber' => 'NUMERIC(18,6)', // 数量
            'fsDtlNote'=>'VARCHAR(250)',   // 备注
            'fiEntryNumber'=>$this->smallInteger(4),  // 显示序号
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',// 1正常 13删除
            'fsUpdateTime' => $this->dateTime(), // 更新日期时间
            'fsShopGUID' => 'VARCHAR(80) NOT NULL', // 商户GUID
            'CONSTRAINT SCM_tbBillTplDtl PRIMARY KEY("fsBillTplId","fiEntryNumber","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbBillTplDtl', 'fsBillTplId', '模板代码');
        $this->addCommentOnColumn('SCM_tbBillTplDtl', 'fsMaterialId', '物料代码');
        $this->addCommentOnColumn('SCM_tbBillTplDtl', 'fdNumber', '数量');
        $this->addCommentOnColumn('SCM_tbBillTplDtl', 'fsDtlNote', '备注');
        $this->addCommentOnColumn('SCM_tbBillTplDtl', 'fiEntryNumber', '显示序号');
        $this->addCommentOnColumn('SCM_tbBillTplDtl', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbBillTplDtl', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnColumn('SCM_tbBillTplDtl', 'fsShopGUID', '店铺GUID');

        $this->addCommentOnTable('SCM_tbBillTplDtl', '单据模板');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbBalance');
    }
}
