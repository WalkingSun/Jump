<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `SCM_tbSaleOrder `
 */
class m161028_061342_create_SCM_tbSaleOrder extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //        销售订单
        $this->createTable('SCM_tbSaleOrder', [
            'fsBillTime'=>"VARCHAR(20)",//单据日期（当天）
            'fsSaleOrderId'=>"VARCHAR(40) NOT NULL",//单据编码
            'fsCustId' => 'VARCHAR(30)	NOT NULL',//客户代码
            'fsGUId'=>'VARCHAR(80)',//平台GUID
            'fsCustName' => 'VARCHAR(50)',//客户名称
            'fsContact'=>'VARCHAR(50)',//联系人
            'fsCellphoneCt'=>'VARCHAR(50)',//手机
            'fiSaleType'=>'VARCHAR(50)',//销售方式表：1=赊销/2=现销
            'fsDeliveryDate'=>'VARCHAR(20)',//交货日期
            'fsDeliveryReminder'=>'VARCHAR(1)',//交货提醒标示Y=是/N=否
            'fiDeliVeryType'=>$this->smallInteger(4),//交货方式1=提货/2=送货/3=物流
            'fsAddress' => 'VARCHAR(250)',//交货地址
            'fsDepartmentId' => 'VARCHAR(20)',//部门代码
            'fsStaffId' => 'VARCHAR(20)',//员工代码
            'fdSaleMoney'=>'NUMERIC(18,6)',//销售金额
            'fdSaleTax'=>'NUMERIC(18,6)',//销售税额
            'fdSaleTotalTax'=>'NUMERIC(18,6)',//销售价税合计
            'fiDocumentStatus'=>$this->smallInteger(4).' DEFAULT 0',//单据状态 0未审核1已审核
            'fsAuditor'=>'VARCHAR(30)',//审核人
            'fsAuditTime'=>'VARCHAR(20)',//审核时间
            'fsRemark'=>'VARCHAR(255)',//订单备注
            'fdDeliverGoodsMoney'=>'NUMERIC(18,6)',//发货金额
            'fdDeliverGoodsTax'=>'NUMERIC(18,6)',//发货税额
            'fdDeliverGoodsTotalTax'=>'NUMERIC(18,6)',//发货价税合计
            'fiCollectionMark'=>$this->smallInteger(4).' DEFAULT 0',//收款标示
            'fsDateAccount'=>'VARCHAR(20)',//列账年月
            'fiSourceType'=>$this->smallInteger(4),//来源单据
            'fiShippingMarkOff'=>$this->smallInteger(4).' DEFAULT 0',//销售出库取用关闭标识1=未取用/2=未取用关闭/3=已取用/4=已取用关闭
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),
            'fsCreateUserId' => 'VARCHAR(20)',
            'fsCreateUserName' => 'VARCHAR(30)',
            'fsUpdateTime' => $this->dateTime(),
            'fsUpdateUserId' => 'VARCHAR(20)',
            'fsUpdateUserName' => 'VARCHAR(30)',
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbSaleOrder PRIMARY KEY("fsSaleOrderId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsBillTime','单据日期（当天）');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsSaleOrderId','单据编码');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsCustId','客户代码');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsGUId','平台GUID');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsCustName','客户名称');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsContact','联系人');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsCellphoneCt','联系人电话');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fiSaleType','销售方式表：1=赊销/2=现销');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsDeliveryDate','交货日期');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsDeliveryReminder','交货提醒标示Y=是/N=否');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fiDeliVeryType','交货方式1=提货/2=送货/3=物流');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsAddress','交货地址');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsDepartmentId','部门代码');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsStaffId','员工代码');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fdSaleMoney','销售金额');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fdSaleTax','销售税额');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fdSaleTotalTax','销售价税合计');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fiDocumentStatus','单据状态 0未审核1已审核');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsAuditor','审核人');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsAuditTime','审核时间');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsRemark','订单备注');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fdDeliverGoodsMoney','发货金额');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fdDeliverGoodsTax','发货税额');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fdDeliverGoodsTotalTax','发货价税合计');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fiCollectionMark','收款标示');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsDateAccount','列账年月');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fiSourceType','来源单据');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fiShippingMarkOff','销售出库取用关闭标识1=未取用/2=未取用关闭/3=已取用/4=已取用关闭');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbSaleOrder','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbSaleOrder','销售订单');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbSaleOrder');
    }
}
