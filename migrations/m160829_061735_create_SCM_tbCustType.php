<?php

use yii\db\Migration;

/**
 * Handles the creation for table `SCM_tbCustType`.
 */
class m160829_061735_create_SCM_tbCustType extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // 客户类型
        $this->createTable('SCM_tbCustType', [
            'fsCustTypeId' => 'VARCHAR(20)	NOT NULL',//代码
            'fsCustTypeName' => 'VARCHAR(30)	NOT NULL',//名称
            'fsDataAttribute' => 'VARCHAR(4)	NOT NULL',//数据属性;user用户级,sys系统级
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常9禁用13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbCustType PRIMARY KEY("fsCustTypeId","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbCustType', 'fsCustTypeId', '代码');
        $this->addCommentOnColumn('SCM_tbCustType', 'fsCustTypeName', '名称');
        $this->addCommentOnColumn('SCM_tbCustType', 'fsDataAttribute', '数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbCustType', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbCustType', 'fsCreateTime', '创建日期时间');
        $this->addCommentOnColumn('SCM_tbCustType', 'fsCreateUserId', '创建人ID');
        $this->addCommentOnColumn('SCM_tbCustType', 'fsCreateUserName', '创建人用户名');
        $this->addCommentOnColumn('SCM_tbCustType', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnColumn('SCM_tbCustType', 'fsUpdateUserId', '更新人ID');
        $this->addCommentOnColumn('SCM_tbCustType', 'fsUpdateUserName', '更新人用户名');
        $this->addCommentOnColumn('SCM_tbCustType', 'fsShopGUID', '店铺GUID');

        $this->addCommentOnTable('SCM_tbCustType', '客户类型表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbCustType');
    }
}
