<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `erp_item_class`.
 */
class m160728_061645_create_SCM_tbTreeBuild extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // 树形记录组合表
        $this->createTable('SCM_tbTreeBuild', [
            'fdNodeCd' => 'NUMERIC(18)	NOT NULL',//节点码
            'fsNodeText' => 'VARCHAR(30)	NOT NULL',//节点内容
            'fdParentNodeCd' => 'NUMERIC(18)	NOT NULL',//父节点码
            'fdNodeLevel' => 'NUMERIC(2)	NOT NULL',//节点等级
            'fsNodeFullText' => 'VARCHAR(250)	NOT NULL',//节点内容全名;ex:物料_海鲜_鱼类_活海鱼
            'fsNodeFullCode' => 'VARCHAR(250)	NOT NULL',//代码全名
            'fsTreeTypeId' => 'VARCHAR(20)	NOT NULL',//树类别代码;Material、Supplier 、Cust
            'fsNodeCode' => 'VARCHAR(30) NOT NULL',//代码
            'fsNodeCls' => 'VARCHAR(6) NOT NULL',//节点类别;class=分类节点/filter=过滤节点
            'fsDataAttribute' => 'VARCHAR(4)	NOT NULL',//	--数据属性;user用户级,sys系统级
            'fiStatus' => $this->smallInteger(4), // 数据状态 1正常/9=禁用/13删除
            'fsCreateTime' => $this->dateTime(), // 创建日期时间
            'fsCreateUserId' => 'VARCHAR(20)', // 创建人ID
            'fsCreateUserName' => 'VARCHAR(30)', // 创建人用户名
            'fsUpdateTime' => $this->dateTime(), // 更新日期时间
            'fsUpdateUserId' => 'VARCHAR(20)', // 更新人ID
            'fsUpdateUserName' => 'VARCHAR(30)', // 更新人用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL', // 店铺GUID
            'CONSTRAINT SCM_tbTreeBuild PRIMARY KEY("fdNodeCd","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fdNodeCd', '节点码');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsNodeText', '节点内容');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fdParentNodeCd', '父节点码');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fdNodeLevel', '节点等级');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsNodeFullText', '节点内容全名;ex:物料_海鲜_鱼类_活海鱼');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsNodeFullCode', '代码全名');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsTreeTypeId', '树类别代码;Material、Supplier 、Cust');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsNodeCode', '代码');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsNodeCls', '代码');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsDataAttribute', '数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsCreateTime', '创建日期时间');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsCreateUserId', '创建人ID');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsCreateUserName', '创建人用户名');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsUpdateUserId', '更新人ID');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsUpdateUserName', '更新人用户名');
        $this->addCommentOnColumn('SCM_tbTreeBuild', 'fsShopGUID', '店铺GUID');

        $this->addCommentOnTable('SCM_tbTreeBuild', '分类树表');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbTreeBuild');
    }
}
