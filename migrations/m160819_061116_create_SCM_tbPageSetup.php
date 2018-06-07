<?php

use yii\db\Migration;

/**
 * Handles the creation for table `SCM_tbPageSetup `.
 */
class m160819_061116_create_SCM_tbPageSetup extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // finder列表设置
        $this->createTable('SCM_tbPageSetup', [
            'fsPageId' => 'VARCHAR(50)	NOT NULL',//页面代码
            'fsSetupData'=>'VARCHAR(255)',
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUserId'=>'VARCHAR(20)',
            'fsUserName'=>'VARCHAR(30)',
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbPageSetup PRIMARY KEY("fsPageId","fsUserId","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbPageSetup', 'fsPageId', '页面代码');
        $this->addCommentOnColumn('SCM_tbPageSetup', 'fsSetupData', '设置内容');
        $this->addCommentOnColumn('SCM_tbPageSetup', 'fsUpdateTime', '更新时间');
        $this->addCommentOnColumn('SCM_tbPageSetup', 'fsUserId', '用户ID');
        $this->addCommentOnColumn('SCM_tbPageSetup', 'fsUserName', '用户名');
        $this->addCommentOnColumn('SCM_tbPageSetup', 'fsShopGUID', '店铺GUID');

        $this->addCommentOnTable('SCM_tbPageSetup', 'finder列表设置');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbPageSetup');
    }
}
