<?php

use yii\db\Migration;

/**
 * Class SCM_tbTransferOrder 店内调拨单
 */
class m170328_102030_create_SCM_tbTransferOrder extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbTransferOrder', [
            'fsTransferOrderId'=>"VARCHAR(40) NOT NULL",//单据单号
            'fsBillTime'=>"VARCHAR(20) NOT NULL",//单据日期
            'fiDocumentStatus'=>$this->smallInteger(4).' DEFAULT 0',//单据状态 0未审核1已审核
            'fsAuditor'=>'VARCHAR(30)',//审核人
            'fsAuditTime'=>'VARCHAR(20)',//审核时间
            'fsRemark'=>'VARCHAR(255)',//备注
            'fsDepartmentId' => 'VARCHAR(20)',//使用部门代码
            'fsCSUser' =>'VARCHAR(20)',//验收/经办 人
            'fsSGUser' =>'VARCHAR(20)',//保管
            'fsStorageId_I'=>'VARCHAR(20)',//入库仓
            'fsStorageId_O'=>'VARCHAR(20)',//出库仓
            'fsBRWords'=>"VARCHAR(4) DEFAULT 'B'",//红蓝字，B=蓝字/ R=红字
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbTransferOrder PRIMARY KEY("fsTransferOrderId","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbTransferOrder', 'fsTransferOrderId', '单据编号');
        $this->addCommentOnColumn('SCM_tbTransferOrder', 'fsBillTime', '单据日期');
        $this->addCommentOnColumn('SCM_tbTransferOrder', 'fiDocumentStatus', '单据状态 0未审核1已审核');
        $this->addCommentOnColumn('SCM_tbTransferOrder', 'fsAuditor', '审核人');
        $this->addCommentOnColumn('SCM_tbTransferOrder', 'fsAuditTime', '审核时间');
        $this->addCommentOnColumn('SCM_tbTransferOrder', 'fsRemark', '备注');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsDepartmentId','部门代码');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsCSUser','验收/经办 人');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsSGUser','保管');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsStorageId_I','调入仓编码');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsStorageId_O','调出仓编码');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsBRWords','红蓝字;B=蓝字/R=红字');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbTransferOrder','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbTransferOrder', '店内调拨单');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbTransferOrder');
    }
}
