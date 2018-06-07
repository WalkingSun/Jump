<?php

use yii\db\Migration;

class m160829_061411_create_SCM_tbStaff extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // 员工
        $this->createTable('SCM_tbStaff', [
            'fsStaffId' => 'VARCHAR(20)	NOT NULL',//代码
            'fsStaffName' => 'VARCHAR(30)	NOT NULL',//名称
            'fsDepartmentId'=>'VARCHAR(20)',//部门代码
            'fsMobile'=>'VARCHAR(50)',//手机
            'fsRemark'=>'VARCHAR(250)',//备注
            'fsDataAttribute' => 'VARCHAR(4)	NOT NULL',//数据属性;user用户级,sys系统级
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常9禁用13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbStaff PRIMARY KEY("fsStaffId","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbStaff', 'fsStaffId', '代码');
        $this->addCommentOnColumn('SCM_tbStaff', 'fsStaffName', '名称');
        $this->addCommentOnColumn('SCM_tbStaff', 'fsDepartmentId', '部门代码');
        $this->addCommentOnColumn('SCM_tbStaff', 'fsMobile', '手机');
        $this->addCommentOnColumn('SCM_tbStaff', 'fsRemark', '备注');
        $this->addCommentOnColumn('SCM_tbStaff', 'fsDataAttribute', '数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbStaff', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbStaff', 'fsCreateTime', '创建日期时间');
        $this->addCommentOnColumn('SCM_tbStaff', 'fsCreateUserId', '创建人ID');
        $this->addCommentOnColumn('SCM_tbStaff', 'fsCreateUserName', '创建人用户名');
        $this->addCommentOnColumn('SCM_tbStaff', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnColumn('SCM_tbStaff', 'fsUpdateUserId', '更新人ID');
        $this->addCommentOnColumn('SCM_tbStaff', 'fsUpdateUserName', '更新人用户名');
        $this->addCommentOnColumn('SCM_tbStaff', 'fsShopGUID', '店铺GUID');

        $this->addCommentOnTable('SCM_tbStaff', '客户等级表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbStaff');
    }
}
