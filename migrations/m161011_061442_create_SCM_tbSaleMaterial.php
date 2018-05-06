<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `SCM_tbSaleMaterial `
 */
class m161011_061442_create_SCM_tbSaleMaterial extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //        销售明细
        $this->createTable('SCM_tbSaleMaterial', [
            'fiEntryNumber'=>$this->smallInteger(4),//分录号
            'fsSaleOrderId'=>"VARCHAR(40) NOT NULL",//单据编码
            'fsPkNo'=>'VARCHAR(40)',//唯一标示
            'fsMaterialId' => 'VARCHAR(30)	NOT NULL',//物料代码
            'fsMaterialName' => 'VARCHAR(50)	NOT NULL',//物料名称
            'fsModelno'=>'VARCHAR(250)',//规格型号
            'fsOrderUnit'=>'VARCHAR(20)',//采购计量单位
            'fdNumber'=>'NUMERIC(18,6)',//数量
            'fdPrice'=>'NUMERIC(18,6)',//--单价
            'fdTaxPrice'=>'NUMERIC(18,6)',//含税单价
            'fdMoney'=>'NUMERIC(18,6)',//金额
            'fdValueAddRate'=>'NUMERIC(18,6)',//--增值税率%
            'fdTax'=>'NUMERIC(18,6)',//税额
            'fdTotalTax'=>'NUMERIC(18,6)',//价税合计
            'fdNumberOfGifts'=>'NUMERIC(18,6)',//赠送数量
            'fsApplicationUnitName' => 'VARCHAR(40)',//申请单位名称
            'fsDetailedNotes'=>'VARCHAR(255)',//明细备注
            'fiSourceType'=>$this->smallInteger(2) ,//源单类型，1采购订单 or 2采购申请单
            'fsSingleSourceNumber'=>'VARCHAR(50)',//源单单号
            'fsSourceEntryNumber'=>$this->integer(12),//源单流水号
            'fsGUId'=>'VARCHAR(80)',//客户平台GUId
            'fdShippedQty'=>'NUMERIC(18,6)',//销售出库取用数量
            'fdReturnQty'=>'NUMERIC(18,6)',//发货退回数量
            'fdShippedMoney'=>'NUMERIC(18,6)',//发货金额
            'fdShippedTax'=>'NUMERIC(18,6)',//发货税额
            'fdShippedTotalTax'=>'NUMERIC(18,6)',//发货价税合计
            'fdNumberOfOutgoing'=>'NUMERIC(18,6) DEFAULT 0',//已出库数量
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),
            'fsCreateUserId' => 'VARCHAR(20)',
            'fsCreateUserName' => 'VARCHAR(30)',
            'fsUpdateTime' => $this->dateTime(),
            'fsUpdateUserId' => 'VARCHAR(20)',
            'fsUpdateUserName' => 'VARCHAR(30)',
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbSaleMaterial PRIMARY KEY("fiEntryNumber","fsSaleOrderId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsSaleOrderId','单据编码');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fiEntryNumber','分录号');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsPkNo','唯一标示');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsMaterialName','物料名称');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsModelno','规格型号');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsOrderUnit','采购计量单位');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdNumber','数量');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdPrice','单价');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdTaxPrice','含税单价');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdMoney','金额');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdValueAddRate','增值税率%');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdTax','税额');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdTotalTax','价税合计');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdNumberOfGifts','赠送数量');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsApplicationUnitName','申请单位名称');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsDetailedNotes','明细备注');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fiSourceType','源单类型，1采购订单 or 2采购申请单');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsSingleSourceNumber','源单单号');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsSourceEntryNumber','源单流水号');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsGUId','客户平台GUId');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdShippedQty','销售出库取用数量');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdReturnQty','发货退回数量');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdShippedMoney','发货金额');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdShippedTax','发货税额');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdShippedTotalTax','发货价税合计');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fdNumberOfOutgoing','已出库数量');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbSaleMaterial','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbSaleMaterial','销售订单明细');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbSaleMaterial');
    }
}
