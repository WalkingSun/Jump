<?php

use yii\db\Migration;

/**
 * Class SCM_tbPORequest 申请单主表
 */
class m170215_102024_create_SCM_tbPORequest extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbPORequest', [
            'fsRequestNo'=>"VARCHAR(40) NOT NULL",//申请单号
            'fsRequestDate'=>"VARCHAR(20) NOT NULL",//申请日期
            'fsUseDate'=>"VARCHAR(20) NOT NULL",//预设使用日期
            'fdTotPri'=>'NUMERIC(18,6)',//估计金额
            'fiSourceType'=>$this->smallInteger(2) ,//源单类型
            'fiDocumentStatus'=>$this->smallInteger(4).' DEFAULT 0',//单据状态 0未审核1已审核
            'fsAuditor'=>'VARCHAR(30)',//审核人
            'fsAuditTime'=>'VARCHAR(20)',//审核时间
            'fsRemark'=>'VARCHAR(255)',//备注
            'fsDepartmentId' => 'VARCHAR(20)',//使用部门代码
            'fsStaffId' => 'VARCHAR(20)',//申请员工代码
            'fiCloseType'=>$this->smallInteger(4).' DEFAULT 1',//关闭类型 1采购 2领料
            'fiCloseID'=>$this->smallInteger(4).' DEFAULT 1',//关闭标识 1=未取用/2=未取用关闭/3=已取用/4=已取用关闭
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbPORequest PRIMARY KEY("fsRequestNo","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbPORequest', 'fsRequestNo', '申请单号');
        $this->addCommentOnColumn('SCM_tbPORequest', 'fsRequestDate', '申请日期');
        $this->addCommentOnColumn('SCM_tbPORequest', 'fsUseDate', '预设使用日期');
        $this->addCommentOnColumn('SCM_tbPORequest', 'fdTotPri', '估计金额');
        $this->addCommentOnColumn('SCM_tbPORequest', 'fiSourceType', '源单类型');
        $this->addCommentOnColumn('SCM_tbPORequest', 'fiDocumentStatus', '单据状态 0未审核1已审核');
        $this->addCommentOnColumn('SCM_tbPORequest', 'fsAuditor', '审核人');
        $this->addCommentOnColumn('SCM_tbPORequest', 'fsAuditTime', '审核时间');
        $this->addCommentOnColumn('SCM_tbPORequest', 'fsRemark', '备注');
        $this->addCommentOnColumn('SCM_tbPORequest','fsDepartmentId','部门代码');
        $this->addCommentOnColumn('SCM_tbPORequest','fsStaffId','员工代码');
        $this->addCommentOnColumn('SCM_tbPORequest','fiCloseType','关闭类型 1采购 2领料');
        $this->addCommentOnColumn('SCM_tbPORequest','fiCloseID','关闭标识 1=未取用/2=未取用关闭/3=已取用/4=已取用关闭');
        $this->addCommentOnColumn('SCM_tbPORequest','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbPORequest','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbPORequest','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbPORequest','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbPORequest','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbPORequest','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbPORequest','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbPORequest','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbPORequest', '申请单主表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbPORequest');
    }
}
