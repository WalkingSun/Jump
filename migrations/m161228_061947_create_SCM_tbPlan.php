<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbPlan 方案
 */
class m161228_061947_create_SCM_tbPlan extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbPlan', [
            'fsPlanId' => 'VARCHAR(20) NOT NULL', // 方案代码
            'fsPlanName'=>'VARCHAR(50) NOT NULL', // 方案名称
            'fiIsDisable'=>$this->smallInteger(4),//是否使用禁用
            'fsData'=>Schema::TYPE_TEXT . ' NOT NULL',//数据
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbPlan PRIMARY KEY("fsPlanId","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbPlan', 'fsPlanId', '方案代码');
        $this->addCommentOnColumn('SCM_tbPlan', 'fsPlanName', '方案名称');
        $this->addCommentOnColumn('SCM_tbPlan', 'fiIsDisable', '是否使用禁用数据 1使用2不使用');
        $this->addCommentOnColumn('SCM_tbPlan', 'fsData', '数据');
        $this->addCommentOnColumn('SCM_tbPlan', 'fiStatus','状态： 1正常13删除');
        $this->addCommentOnColumn('SCM_tbPlan', 'fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbPlan', 'fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbPlan', 'fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbPlan', 'fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbPlan', 'fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbPlan', 'fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbPlan', 'fsShopGUID','门店代码');

        $this->addCommentOnTable('SCM_tbPlan', '方案');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbPlan');
    }
}
