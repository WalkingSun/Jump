<?php

use yii\db\Migration;

/**
 * Class SCM_tbProcessOrder 半成品加工单
 */
class m170327_102024_create_SCM_tbProcessOrder extends Migration
{
        /**
         * @inheritdoc
         */
        public function up()
        {
                $this->createTable('SCM_tbProcessOrder', [
                    'fsProcessOrderId'=>"VARCHAR(40) NOT NULL",//单据单号
                    'fsBillTime'=>"VARCHAR(20) NOT NULL",//单据日期
                    'fiSourceType'=>$this->smallInteger(2) ,//源单类型
                    'fiDocumentStatus'=>$this->smallInteger(4).' DEFAULT 0',//单据状态 0未审核1已审核
                    'fsAuditor'=>'VARCHAR(30)',//审核人
                    'fsAuditTime'=>'VARCHAR(20)',//审核时间
                    'fsRemark'=>'VARCHAR(255)',//备注
                    'fsDepartmentId' => 'VARCHAR(20)',//使用部门代码
                    'fsCSUser' =>'VARCHAR(20)',//验收/领料/经办 人
                    'fsSGUser' =>'VARCHAR(20)',//保管/发料/保管
                    'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
                    'fsCreateTime' => $this->dateTime(),//创建时间
                    'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
                    'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
                    'fsUpdateTime' => $this->dateTime(),//更新时间
                    'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
                    'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
                    'fsShopGUID' => 'VARCHAR(80) NOT NULL',
                    'fsBRWords'=>"VARCHAR(4) DEFAULT 'B'",//红蓝字，B=蓝字/ R=红字
                    'fsStaffId'=>'VARCHAR(20)',//员工代码
                    'CONSTRAINT SCM_tbProcessOrder PRIMARY KEY("fsProcessOrderId","fsShopGUID")'
                ]);

                $this->addCommentOnColumn('SCM_tbProcessOrder', 'fsProcessOrderId', '单据编号');
                $this->addCommentOnColumn('SCM_tbProcessOrder', 'fsBillTime', '单据日期');
                $this->addCommentOnColumn('SCM_tbProcessOrder', 'fiSourceType', '源单类型');
                $this->addCommentOnColumn('SCM_tbProcessOrder', 'fiDocumentStatus', '单据状态 0未审核1已审核');
                $this->addCommentOnColumn('SCM_tbProcessOrder', 'fsAuditor', '审核人');
                $this->addCommentOnColumn('SCM_tbProcessOrder', 'fsAuditTime', '审核时间');
                $this->addCommentOnColumn('SCM_tbProcessOrder', 'fsRemark', '备注');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fsDepartmentId','部门代码');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fsCSUser','验收/领料/经办 人');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fsSGUser','保管/发料/保管');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fiStatus','状态：1正常13删除');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fsCreateTime','创建时间');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fsCreateUserId','创建用户uid');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fsCreateUserName','创建用户名称');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fsUpdateTime','更新时间');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fsUpdateUserId','更新用户uid');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fsUpdateUserName','更新用户名称');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fsShopGUID','门店代码');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fsBRWords','红蓝字，B=蓝字/ R=红字');
                $this->addCommentOnColumn('SCM_tbProcessOrder','fsStaffId','员工代码');
                $this->addCommentOnTable('SCM_tbProcessOrder', '半成品加工单');
        }

        /**
         * @inheritdoc
         */
        public function down()
        {
                $this->dropTable('SCM_tbProcessOrder');
        }
}