<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `SCM_tbPurchaseMaterial `
 */
class m160928_061442_create_SCM_tbPurchaseMaterial extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //        采购订单明细
        $this->createTable('SCM_tbPurchaseMaterial', [
            'fiEntryNumber'=>$this->smallInteger(4),//分录号
            'fsPurchaseOrderId'=>"VARCHAR(40) NOT NULL",//单据编码
            'fsPkNo'=>'VARCHAR(40)',//唯一标示
            'fsMaterialId' => 'VARCHAR(30)	NOT NULL',//物料代码
            'fsMaterialName' => 'VARCHAR(50)	NOT NULL',//物料名称
            'fsModelno'=>'VARCHAR(250)',//规格型号
            'fsOrderUnit'=>'VARCHAR(20)',//采购计量单位
            'fdNumber'=>'NUMERIC(18,6)',//数量
            'fdPrice'=>'NUMERIC(18,6)',//--单价
            'fdTaxPrice'=>'NUMERIC(18,6)',//含税单价
            'fdMoney'=>'NUMERIC(18,6)',//金额
            'fdDiscountRate'=>'NUMERIC(18,6)',//折扣率
            'fdActualTaxPrice'=>'NUMERIC(18,6)',//实际含税单价
            'fdTaxDiscountRate'=>'NUMERIC(18,6)',//含税折扣率
            'fdValueAddRate'=>'NUMERIC(18,6)',//--增值税率%
            'fdTax'=>'NUMERIC(18,6)',//税额
            'fdTotalTax'=>'NUMERIC(18,6)',//价税合计
            'fsApplicationUnitId' => 'VARCHAR(20)',//申请单位代码
            'fsDetailedNotes'=>'VARCHAR(255)',//明细备注
            'fiSourceType'=>$this->smallInteger(2) ,//源单类型，1采购申请单 or 2销售订单
            'fsSingleSourceNumber'=>'VARCHAR(50)',//源单单号
            'fsSourceEntryNumber'=>$this->integer(12),//源单分录号
            'fsGUId'=>'VARCHAR(80)',//供应商平台GUId
            'fdReceivingQuantity'=>'NUMERIC(18,6)',//收货数量
            'fdReturnQuantity'=>'NUMERIC(18,6)',//收货退回数量
            'fdReceivingTax'=>'NUMERIC(18,6)',//收货税务
            'fdReceivingMoney'=>'NUMERIC(18,6)',//收货金额
            'fdTotalTaxReceipt'=>'NUMERIC(18,6)',//收货价税合计
            'fdNumberOfGifts'=>'NUMERIC(18,6)',//赠送数量
            'fsReceivingExceptionType'=>'VARCHAR(100)',//收货异常类型
            'fsAbnormalReason'=>'VARCHAR(255)',//异常原因说明
            'fiLaunchEetUp'=>$this->smallInteger(2),//0=否 /1=是
            'fsNumberComplaints'=>"VARCHAR(40)",//投诉单号
            'fdStorageQuantity'=>'NUMERIC(18,6)',//入库已关联数量
            'fdSalesNumber'=>'NUMERIC(18,6)',//销售已关联数量
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),
            'fsCreateUserId' => 'VARCHAR(20)',
            'fsCreateUserName' => 'VARCHAR(30)',
            'fsUpdateTime' => $this->dateTime(),
            'fsUpdateUserId' => 'VARCHAR(20)',
            'fsUpdateUserName' => 'VARCHAR(30)',
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbPurchaseMaterial PRIMARY KEY("fiEntryNumber","fsPurchaseOrderId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsPurchaseOrderId','单据编码');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fiEntryNumber','分录号');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsPkNo','唯一标示');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsMaterialName','物料名称');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsModelno','规格型号');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsOrderUnit','采购计量单位');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdNumber','数量');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdPrice','单价');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdTaxPrice','含税单价');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdDiscountRate','折扣率');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdTaxDiscountRate','含税折扣率');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdActualTaxPrice','实际含税单价');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdMoney','金额');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdValueAddRate','增值税率%');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdTax','税额');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdTotalTax','价税合计');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsApplicationUnitId','申请单位代码');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsDetailedNotes','明细备注');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fiSourceType','源单类型，1采购订单 or 2采购申请单');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsSingleSourceNumber','源单单号');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsSourceEntryNumber','源单分录号');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsGUId','供应商平台GUId');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdReceivingQuantity','收货数量');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdReturnQuantity','收货退回数量');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdReceivingTax','收货税额');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdReceivingMoney','收货金额');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdTotalTaxReceipt','收货价税合计');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdNumberOfGifts','赠送数量');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsReceivingExceptionType','收货异常类型');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsAbnormalReason','异常原因说明');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fiLaunchEetUp','0=否 /1=是');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsNumberComplaints','投诉单号');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdStorageQuantity','入库已关联数量');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fdSalesNumber','销售已关联数量');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbPurchaseMaterial','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbPurchaseMaterial','采购订单明细');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbPurchaseMaterial');
    }
}
