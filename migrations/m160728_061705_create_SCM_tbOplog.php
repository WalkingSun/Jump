<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `erp_item_class`.
 */
class m160728_061705_create_SCM_tbOplog extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // 操作日志
        $this->createTable('SCM_tbOplog', [
            'fsRemark'=>'VARCHAR(255)', // 备注
            'fsAction'=>'VARCHAR(255)', // 动作
            'fsIp' => 'VARCHAR(20) NOT NULL',
            'fsDataAttribute' => 'VARCHAR(4) NOT NULL', // 数据属性;user用户级,sys系统级
            'fsCreateTime' => $this->dateTime(), // 创建时间
            'fsUserId' => 'VARCHAR(20)', // 操作人ID
            'fsUserName' => 'VARCHAR(30)', // 操作人名称
            'fsShopGUID' => 'VARCHAR(80) NOT NULL', // 店铺GUID
            'fiStatus' => $this->smallInteger(4), // 数据状态 1正常/9=禁用/13删除
            'fsRatioData'=>$this->text(),//对比数据
        ]);
        $this->createIndex('index_userName','SCM_tbOplog','fsUserName');
        $this->createIndex('index_GUID','SCM_tbOplog','fsShopGUID');
        $this->createIndex('index_time','SCM_tbOplog','fsCreateTime');

        $this->addCommentOnColumn('SCM_tbOplog', 'fsRemark', '备注');
        $this->addCommentOnColumn('SCM_tbOplog', 'fsAction', '操作');
        $this->addCommentOnColumn('SCM_tbOplog', 'fsIp', '访问IP');
        $this->addCommentOnColumn('SCM_tbOplog', 'fsDataAttribute', '数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbOplog', 'fsCreateTime', '创建日期事件');
        $this->addCommentOnColumn('SCM_tbOplog', 'fsUserId', '操作人ID');
        $this->addCommentOnColumn('SCM_tbOplog', 'fsUserName', '操作人名称');
        $this->addCommentOnColumn('SCM_tbOplog', 'fsShopGUID', '店铺GUID');
        $this->addCommentOnColumn('SCM_tbOplog', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbOplog', 'fsRatioData', '对比数据');

        $this->addCommentOnTable('SCM_tbOplog', '操作日志');
    }
 
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbOplog');
    }
}
