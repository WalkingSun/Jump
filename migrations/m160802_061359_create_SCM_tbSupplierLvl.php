<?php

use yii\db\Migration;

/**
 * Handles the creation for table `SCM_tbSupplierLvl`.
 */
class m160802_061359_create_SCM_tbSupplierLvl extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // 供应商评级
        $this->createTable('SCM_tbSupplierLvl', [
            'fsSupplierLvlId' => 'VARCHAR(20) NOT NULL',//供应商评级代码
            'fsSupplierLvlName' => 'VARCHAR(30)	NOT NULL',//评级名称
            'fsSupplierMemo' => 'VARCHAR(225)',//备注
            'fsDataAttribute' => 'VARCHAR(4) NOT NULL',//	--数据属性;user用户级,sys系统级
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常9禁用13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL', // 店铺GUID
            'CONSTRAINT SCM_tbSupplierLvl PRIMARY KEY("fsSupplierLvlId","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbSupplierLvl', 'fsSupplierLvlId', '供应商评级代码');
        $this->addCommentOnColumn('SCM_tbSupplierLvl', 'fsSupplierLvlName', '评级名称');
        $this->addCommentOnColumn('SCM_tbSupplierLvl', 'fsSupplierMemo', '备注');
        $this->addCommentOnColumn('SCM_tbSupplierLvl', 'fsDataAttribute', '数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbSupplierLvl', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbSupplierLvl', 'fsCreateTime', '创建日期时间');
        $this->addCommentOnColumn('SCM_tbSupplierLvl', 'fsCreateUserId', '创建人ID');
        $this->addCommentOnColumn('SCM_tbSupplierLvl', 'fsCreateUserName', '创建人用户名');
        $this->addCommentOnColumn('SCM_tbSupplierLvl', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnColumn('SCM_tbSupplierLvl', 'fsUpdateUserId', '更新人ID');
        $this->addCommentOnColumn('SCM_tbSupplierLvl', 'fsUpdateUserName', '更新人用户名');
        $this->addCommentOnColumn('SCM_tbSupplierLvl', 'fsShopGUID', '店铺GUID');

        $this->addCommentOnTable('SCM_tbSupplierLvl', '供应商评级表');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbSupplierLvl');
    }
}
