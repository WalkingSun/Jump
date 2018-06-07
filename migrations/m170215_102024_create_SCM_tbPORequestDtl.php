<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbPORequestDtl 申请单明细表
 */
class m170215_102024_create_SCM_tbPORequestDtl extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbPORequestDtl', [
            'fsRequestNo'=>"VARCHAR(40) NOT NULL",//申请单号
            'fiEntryNumber'=>$this->smallInteger(4),//分录号
            'fsPkNo'=>'VARCHAR(40)',//唯一标示
            'fsMaterialId' => 'VARCHAR(30)	NOT NULL',//物料代码
            'fsMaterialName' => 'VARCHAR(50)	NOT NULL',//物料名称
            'fsModelno'=>'VARCHAR(250)',//规格型号
            'fsUnitId'=>'VARCHAR(20)',//单位
            'fdNumber'=>'NUMERIC(18,6)',//数量
            'fdPrice'=>'NUMERIC(18,6)',//--单价
            'fdMoney'=>'NUMERIC(18,6)',//金额
            'fsDetailedNotes'=>'VARCHAR(255)',//明细备注
            'fsApplicationUnitId' => 'VARCHAR(20)',//申请单位代码
            'fsPurpose'=>'VARCHAR(255)',//用途
            'fdPurchaseNumber'=>'NUMERIC(18,6)',//采购关联数量
            'fdPickingNumber'=>'NUMERIC(18,6)',//领料关联数量
            'fsSingleSourceNumber'=>'VARCHAR(50)',//源单单号
            'fsSourceEntryNumber'=>$this->integer(12),//源单分录号
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbPORequestDtl PRIMARY KEY("fsRequestNo","fiEntryNumber","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbPORequestDtl', 'fsRequestNo', '申请单号');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fiEntryNumber','分录号');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsPkNo','唯一标示');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsMaterialName','物料名称');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsModelno','规格型号');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsUnitId','单位');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fdNumber','数量');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fdPrice','单价');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fdMoney','金额');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsApplicationUnitId','申请单位代码');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsDetailedNotes','明细备注');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsPurpose','用途');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fdPurchaseNumber','采购关联数量');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fdPickingNumber','领料关联数量');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsSingleSourceNumber','源单单号');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsSourceEntryNumber','源单分录号');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbPORequestDtl','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbPORequestDtl', '申请单明细表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbPORequestDtl');
    }
}
