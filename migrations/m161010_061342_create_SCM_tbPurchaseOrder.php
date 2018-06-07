<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `SCM_tbPurchaseOrder `
 */
class m161010_061342_create_SCM_tbPurchaseOrder extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //        采购订单
        $this->createTable('SCM_tbPurchaseOrder', [
            'fsBillTime'=>"VARCHAR(20)",//单据日期（当天）
            'fsPurchaseOrderId'=>"VARCHAR(40) NOT NULL",//单据编码
            'fsSupplierId' => 'VARCHAR(30)	NOT NULL',//供应商代码
            'fsSupplierName' => 'VARCHAR(50)',//供应商名称
            'fsGUId'=>'VARCHAR(80)',//平台GUID
            'fsContact'=>'VARCHAR(50)',//联系人
            'fsCellphoneCt'=>'VARCHAR(50)',//联系人电话
            'fsDeliveryDate'=>'VARCHAR(20)',//交货日期
            'fiDeliveryReminder'=>$this->smallInteger(4),//交货提醒标示
            'fsAddress' => 'VARCHAR(250)',//交货地址
            'fsDepartmentId' => 'VARCHAR(20)',//部门代码
            'fsStaffId' => 'VARCHAR(20)',//员工代码
            'fdPurchaseTaxAmount'=>'NUMERIC(18,6)',//采购含税金额
            'fdIncomeTaxAmount'=>'NUMERIC(18,6)',//收货含税金额
            'fiDocumentStatus'=>$this->smallInteger(4).' DEFAULT 0',//单据状态 0未审核1已审核
            'fsAuditor'=>'VARCHAR(30)',//审核人
            'fsAuditTime'=>'VARCHAR(20)',//审核时间
            'fsRemark'=>'VARCHAR(255)',//订单备注
            'fiPaymentID'=>$this->smallInteger(4).' DEFAULT 0',//付款标示 0未付1已付
            'fsPaymentDate'=>'VARCHAR(20)',//付款日期
            'fiPaymentBasis'=>$this->smallInteger(4),//1采购2收货3入库
            'fiReceiptCloseID'=>$this->smallInteger(4) .' DEFAULT 1',//收货取用关闭标示
            'fiSaleCloseID'=>$this->smallInteger(4).' DEFAULT 1',//销售取用关闭标识 1=未取用/2=未取用关闭/3=已取用/4=已取用关闭
            'fiStorageCloseID'=>$this->smallInteger(4).' DEFAULT 1',//入库取用关闭标识
            'fiSourceType'=>$this->smallInteger(4),//来源单据 1采购申请单 or 2销售订单
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),
            'fsCreateUserId' => 'VARCHAR(20)',
            'fsCreateUserName' => 'VARCHAR(30)',
            'fsUpdateTime' => $this->dateTime(),
            'fsUpdateUserId' => 'VARCHAR(20)',
            'fsUpdateUserName' => 'VARCHAR(30)',
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'fsShopName'=>'VARCHAR(80)',//商户名称
            'CONSTRAINT SCM_tbPurchaseOrder PRIMARY KEY("fsPurchaseOrderId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsBillTime','单据日期（当天）');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsPurchaseOrderId','单据编码');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsSupplierId','供应商代码');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsGUId','平台GUID');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsSupplierName','供应商名称');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsContact','联系人');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsCellphoneCt','联系人电话');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsDeliveryDate','交货日期');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fiDeliveryReminder','交货提醒标示Y=是/N=否');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsAddress','交货地址');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsDepartmentId','部门代码');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsStaffId','员工代码');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fdPurchaseTaxAmount','采购含税金额');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fdIncomeTaxAmount','收货含税金额');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fiDocumentStatus','单据状态 0未审核1已审核');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsAuditor','审核人');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsAuditTime','审核时间');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsRemark','订单备注');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fiPaymentID','付款标示 0未付1已付');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsPaymentDate','付款日期');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fiPaymentBasis','1采购2收货3入库');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fiReceiptCloseID','收货取用关闭标示 1=未取用/2=未取用关闭/3=已取用/4=已取用关闭');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fiSaleCloseID','销售取用关闭标识 1=未取用/2=未取用关闭/3=已取用/4=已取用关闭');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fiStorageCloseID','入库取用关闭标识 1=未取用/2=未取用关闭/3=已取用/4=已取用关闭');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fiSourceType','来源单据');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbPurchaseOrder','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbPurchaseOrder','采购订单');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbPurchaseOrder');
    }
}
