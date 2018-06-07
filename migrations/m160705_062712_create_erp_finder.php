<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `erp_finder`.
 */
class m160705_062712_create_erp_finder extends Migration
{

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = '';
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // 操作记录表
        // 设置列表的属性：
        $this->createTable('erp_finder', [
            'finder_id' => Schema::TYPE_STRING . ' NOT NULL ',
            'fsShopGUID' => Schema::TYPE_STRING . ' NOT NULL',
            'fsUserId' => Schema::TYPE_STRING . ' NOT NULL',
            'data' => Schema::TYPE_TEXT . ' NOT NULL',
            'add_time'=>Schema::TYPE_DATETIME,
        ],$tableOptions);

        $this->addCommentOnColumn('erp_finder', 'finder_id', 'finder列表ID');
        $this->addCommentOnColumn('erp_finder', 'fsShopGUID', '门店唯一ID');
        $this->addCommentOnColumn('erp_finder', 'fsUserId', '用户ID');
        $this->addCommentOnColumn('erp_finder', 'data', '数据');
        $this->addCommentOnColumn('erp_finder', 'add_time', '添加时间');

        $this->addCommentOnTable('erp_finder', 'finder列表相关设置数据记录');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
//        $this->dropTable('erp_finder');
    }
}
