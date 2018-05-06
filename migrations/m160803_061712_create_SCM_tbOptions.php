<?php

use yii\db\Migration;

/**
 * Handles the creation for table `SCM_tbSupplierOptions `.
 */
class m160803_061712_create_SCM_tbOptions extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // 附件表
        $this->createTable('SCM_tbOptions', [
            'fsOptionsId' => 'VARCHAR(50)	NOT NULL',//代码
            'fsOptionsName' => 'VARCHAR(100)	NOT NULL',//名称
            'fsOptionsUrl' => 'VARCHAR(150)	NOT NULL',//地址
            'fsOptionsType' => 'VARCHAR(10)	NOT NULL',//Supplier=供应商Cust=客户Material=物料
            'fsOptionsCode' => 'VARCHAR(30)	',//供应商代码、客户代码、物料代码
            'fsDataAttribute' => 'VARCHAR(4)	NOT NULL',//	--数据属性;user用户级,sys系统级
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常9禁用13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbOptions PRIMARY KEY("fsOptionsId","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbOptions', 'fsOptionsId', '代码');
        $this->addCommentOnColumn('SCM_tbOptions', 'fsOptionsName', '名称');
        $this->addCommentOnColumn('SCM_tbOptions', 'fsOptionsUrl', '地址');
        $this->addCommentOnColumn('SCM_tbOptions', 'fsOptionsType', 'Supplier=供应商 Cust=客户 Material=物料');
        $this->addCommentOnColumn('SCM_tbOptions', 'fsOptionsCode', '供应商代码、客户代码、物料代码');
        $this->addCommentOnColumn('SCM_tbOptions', 'fsDataAttribute', '数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbOptions', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbOptions', 'fsCreateTime', '创建日期时间');
        $this->addCommentOnColumn('SCM_tbOptions', 'fsCreateUserId', '创建人ID');
        $this->addCommentOnColumn('SCM_tbOptions', 'fsCreateUserName', '创建人用户名');
        $this->addCommentOnColumn('SCM_tbOptions', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnColumn('SCM_tbOptions', 'fsUpdateUserId', '更新人ID');
        $this->addCommentOnColumn('SCM_tbOptions', 'fsUpdateUserName', '更新人用户名');
        $this->addCommentOnColumn('SCM_tbOptions', 'fsShopGUID', '店铺GUID');

        $this->addCommentOnTable('SCM_tbOptions', '附件表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbOptions');
    }
}
