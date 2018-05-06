<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `erp_item_class`.
 */
class m160727_061645_create_SCM_tbTreeType extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // 树形记录表，
        $this->createTable('SCM_tbTreeType', [
            'fTreeTypeId' => $this->string(20).' NOT NULL', // 树类型ID
            'fTreeTypeName' => 'VARCHAR(30)	NOT NULL', // 树类型名称
            'fClassLvl' => 'NUMERIC(2)	NOT NULL', // 树层级 例如:2级 只允许最大建2级 多出来的级别为过滤节点
            'CONSTRAINT SCM_tbTreeType PRIMARY KEY("fTreeTypeId")'
        ]);

        $this->addCommentOnColumn('SCM_tbTreeType', 'fTreeTypeId', '分类树类型ID');
        $this->addCommentOnColumn('SCM_tbTreeType', 'fTreeTypeName', '分类树类型名称');
        $this->addCommentOnColumn('SCM_tbTreeType', 'fClassLvl', '用户ID');

        $this->addCommentOnTable('SCM_tbTreeType', '分类树类型记录表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbTreeType');
    }
}
