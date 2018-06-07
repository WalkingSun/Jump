<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m161109_061945_create_SCM_tbIOStock 入出库主表
 */
class m161109_061946_create_SCM_tbIOStock extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbIOStock', [
            'fsBillTime'=>"VARCHAR(20)",//单据日期（当天）
            'fsBillNo'=>"VARCHAR(40) NOT NULL",//单据编码
            'fsBillType'=>"VARCHAR(20)",//单据类型Stock=采购入库单(进货单)/采购退货单Picking=领料单/退料单Transfer=调拨单Gain=盘盈单Loss=盘亏单ProductIn=产品入库单/SaleOut=销售出库单/销售退货单/Process_I半成品加工入库单/Process_O半成品加工出库单
            'fsBRWords'=>"VARCHAR(4)",//红蓝字，B=蓝字/ R=红字
            'fsSupplierId' => 'VARCHAR(30)',//供应商代码||客户
            'fsSupplierName' => 'VARCHAR(50)',//供应商名称||客户名称
            'fsSupplierGUID'=>'VARCHAR(80)',//供应商平台GUID||客户平台GUID
            'fsSupplierContact'=>'VARCHAR(50)',//联系人
            'fsSupplierCellphone'=>'VARCHAR(50)',//联系人电话
            'fiDirectDial'=>$this->smallInteger(4),//是否直拨 0否1是
            'fsDialNumber'=>'VARCHAR(30)',//直拨单号|申请单号|人工单号
            'fsDepartmentId'=>'VARCHAR(20)',//领料部门代码
            'fsPurpose'=>'VARCHAR(20)',//领料用途
            'fsCSUser' =>'VARCHAR(20)',//验收/领料/经办 人
            'fsSGUser' =>'VARCHAR(20)',//保管/发料/保管
            'fiDocumentStatus'=>$this->smallInteger(4).' DEFAULT 0',//单据状态 0未审核1已审核
            'fsAuditor'=>'VARCHAR(30)',//审核人
            'fsAuditTime'=>'VARCHAR(20)',//审核时间
            'fsAddress'=>'VARCHAR(50)',//交货地址
            'fsRemark'=>'VARCHAR(255)',//备注
            'fsSaleId'=>'VARCHAR(30)',//销售方式代码
            'fiSourceType'=>$this->smallInteger(2) ,//源单类型，1采购订单 or 2采购入库单 3 盘点单
            'fiBillOverSteId'=>$this->smallInteger(2).' DEFAULT 0',//单据结存状态 0=未结转/1=已结转，结转存货
            'fiMaterialCloseID'=>$this->smallInteger(4) .' DEFAULT 1',//领料取用关闭标示
            'fiReturnCloseID'=>$this->smallInteger(4),//采购退货取用关闭标识
            'fiFeedBackCloseID'=>$this->smallInteger(4) .' DEFAULT 1',//退料取用标示
            'fiInvoiceCloseID'=>$this->smallInteger(4) .' DEFAULT 1',//发票取用标示
            'fiRefundCloseID'=>$this->smallInteger(4) .' DEFAULT 1',//销售退库取用标示
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fdMoneyTotal'=>'NUMERIC(18,6)',//总金额
            'fdTaxTotal'=>'NUMERIC(18,6)',//总税额
            'fdGross_profit'=>'NUMERIC(18,6) DEFAULT 0',//总毛利
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbIOStock PRIMARY KEY("fsBillNo","fsBillType","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbIOStock','fsBillTime','单据时间');
        $this->addCommentOnColumn('SCM_tbIOStock','fsBillNo','单据编码');
        $this->addCommentOnColumn('SCM_tbIOStock','fsBillType','单据类型Stock=采购入库单(进货单)/采购退货单Picking=领料单/退料单Transfer=调拨单Gain=盘盈单Loss=盘亏单ProductIn=产品入库单/SaleOut=销售出库单/销售退货单');
        $this->addCommentOnColumn('SCM_tbIOStock','fsBRWords','红蓝字，B=蓝字/ R=红字');
        $this->addCommentOnColumn('SCM_tbIOStock','fsSupplierId','供应商代码');
        $this->addCommentOnColumn('SCM_tbIOStock','fsSupplierName','供应商名称');
        $this->addCommentOnColumn('SCM_tbIOStock','fsSupplierGUID','供应商平台GUID');
        $this->addCommentOnColumn('SCM_tbIOStock','fsSupplierContact','联系人');
        $this->addCommentOnColumn('SCM_tbIOStock','fsSupplierCellphone','联系人电话');
        $this->addCommentOnColumn('SCM_tbIOStock','fiDirectDial','是否直拨 0否1是');
        $this->addCommentOnColumn('SCM_tbIOStock','fsDialNumber','直拨单号|申请单号|人工单号');
        $this->addCommentOnColumn('SCM_tbIOStock','fsDepartmentId','领料部门');
        $this->addCommentOnColumn('SCM_tbIOStock','fsPurpose','领料用途');
        $this->addCommentOnColumn('SCM_tbIOStock','fsCSUser','验收/领料/经办 人');
        $this->addCommentOnColumn('SCM_tbIOStock','fsSGUser','保管/发料/保管');
        $this->addCommentOnColumn('SCM_tbIOStock','fiDocumentStatus','单据状态 0未审核1已审核');
        $this->addCommentOnColumn('SCM_tbIOStock','fsAuditor','审核人');
        $this->addCommentOnColumn('SCM_tbIOStock','fsAuditTime','审核时间');
        $this->addCommentOnColumn('SCM_tbIOStock','fsAddress','交货地址');
        $this->addCommentOnColumn('SCM_tbIOStock','fsRemark','备注');
        $this->addCommentOnColumn('SCM_tbIOStock','fsSaleId','销售方式代码');
        $this->addCommentOnColumn('SCM_tbIOStock','fiSourceType','源单类型，1采购订单 or 2采购入库单 3 盘点单 4 领料单 5 销售订单 6销售出库单');
        $this->addCommentOnColumn('SCM_tbIOStock','fiBillOverSteId','单据结存状态 0=未结转/1=已结转，结转存货');
        $this->addCommentOnColumn('SCM_tbIOStock','fiMaterialCloseID','领料取用关闭标示 1=未取用/2=未取用关闭、3=已取用/4=已取用关闭');
        $this->addCommentOnColumn('SCM_tbIOStock','fiReturnCloseID','采购退货取用关闭标识 1=未取用/2=未取用关闭、3=已取用/4=已取用关闭');
        $this->addCommentOnColumn('SCM_tbIOStock','fiFeedBackCloseID','退料取用标示 1=未取用/2=未取用关闭、3=已取用/4=已取用关闭');
        $this->addCommentOnColumn('SCM_tbIOStock','fiInvoiceCloseID','发票取用标示 1=未取用/2=未取用关闭、3=已取用/4=已取用关闭');
        $this->addCommentOnColumn('SCM_tbIOStock','fiRefundCloseID','销售退库取用标示 1=未取用/2=未取用关闭、3=已取用/4=已取用关闭');
        $this->addCommentOnColumn('SCM_tbIOStock','fdMoneyTotal','总金额');
        $this->addCommentOnColumn('SCM_tbIOStock','fdTaxTotal','总税额');
        $this->addCommentOnColumn('SCM_tbIOStock','fdGross_profit','总毛利');
        $this->addCommentOnColumn('SCM_tbIOStock','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbIOStock','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbIOStock','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbIOStock','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbIOStock','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbIOStock','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbIOStock','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbIOStock','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbIOStock','出入库单据');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbIOStock');
    }
}
