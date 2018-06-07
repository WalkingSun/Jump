<?php

use yii\db\Migration;

class m160826_061411_create_SCM_tbDepartment extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // 部门
        $this->createTable('SCM_tbDepartment', [
            'fsDepartmentId' => 'VARCHAR(20)	NOT NULL',//代码
            'fsDepartmentName' => 'VARCHAR(30)	NOT NULL',//名称
            'fiType'=>$this->smallInteger(4),//部门类型; 0一般 /1传菜部门 /2制作部门
            'fsDataAttribute' => 'VARCHAR(4)	NOT NULL',// 数据属性;user用户级,sys系统级
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',// 1正常9禁用13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbDepartment PRIMARY KEY("fsDepartmentId","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbDepartment', 'fsDepartmentId', '代码');
        $this->addCommentOnColumn('SCM_tbDepartment', 'fsDepartmentName', '名称');
        $this->addCommentOnColumn('SCM_tbDepartment', 'fiType', '部门类型; 0一般 /1传菜部门 /2制作部门');
        $this->addCommentOnColumn('SCM_tbDepartment', 'fsDataAttribute', '数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbDepartment', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbDepartment', 'fsCreateTime', '创建日期时间');
        $this->addCommentOnColumn('SCM_tbDepartment', 'fsCreateUserId', '创建人ID');
        $this->addCommentOnColumn('SCM_tbDepartment', 'fsCreateUserName', '创建人用户名');
        $this->addCommentOnColumn('SCM_tbDepartment', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnColumn('SCM_tbDepartment', 'fsUpdateUserId', '更新人ID');
        $this->addCommentOnColumn('SCM_tbDepartment', 'fsUpdateUserName', '更新人用户名');
        $this->addCommentOnColumn('SCM_tbDepartment', 'fsShopGUID', '店铺GUID');

        $this->addCommentOnTable('SCM_tbDepartment', '部门表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbDepartment');
    }
}
