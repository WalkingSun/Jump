<?php

use yii\db\Migration;

/**
 * Handles the creation for table `SCM_tbCustLvl`.
 */
class m160829_061359_create_SCM_tbCustLvl extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // 客户等级
        $this->createTable('SCM_tbCustLvl', [
            'fsCustLvlId' => 'VARCHAR(20)	NOT NULL',//客户评级代码
            'fsCustLvlName' => 'VARCHAR(30)	NOT NULL',//评级名称
            'fsDataAttribute' => 'VARCHAR(4)	NOT NULL',//数据属性;user用户级,sys系统级
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常9禁用13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbCustLvl PRIMARY KEY("fsCustLvlId","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbCustLvl', 'fsCustLvlId', '代码');
        $this->addCommentOnColumn('SCM_tbCustLvl', 'fsCustLvlName', '名称');
        $this->addCommentOnColumn('SCM_tbCustLvl', 'fsDataAttribute', '数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbCustLvl', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbCustLvl', 'fsCreateTime', '创建日期时间');
        $this->addCommentOnColumn('SCM_tbCustLvl', 'fsCreateUserId', '创建人ID');
        $this->addCommentOnColumn('SCM_tbCustLvl', 'fsCreateUserName', '创建人用户名');
        $this->addCommentOnColumn('SCM_tbCustLvl', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnColumn('SCM_tbCustLvl', 'fsUpdateUserId', '更新人ID');
        $this->addCommentOnColumn('SCM_tbCustLvl', 'fsUpdateUserName', '更新人用户名');
        $this->addCommentOnColumn('SCM_tbCustLvl', 'fsShopGUID', '店铺GUID');

        $this->addCommentOnTable('SCM_tbCustLvl', '客户等级表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbCustLvl');
    }
}
