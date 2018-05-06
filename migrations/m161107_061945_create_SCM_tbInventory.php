<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m161107_061945_create_SCM_tbInventory
 * 即时库存
 */
class m161107_061945_create_SCM_tbInventory extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //        实时库存
        $this->createTable('SCM_tbInventory', [
            'fsMaterialId'=>'VARCHAR(20) NOT NULL',//物料代码
            'fsStorageId' => 'VARCHAR(20)	NOT NULL',//仓库代码
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fdQty' => 'NUMERIC(18,6)',//存货数量
            'fdBal' =>'NUMERIC(18,6)',//存货余额
            'fdCostPrice'=>'NUMERIC(18,6)',//--成本价
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbInventory PRIMARY KEY("fsStorageId","fsMaterialId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbInventory','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbInventory','fsStorageId','仓库代码');
        $this->addCommentOnColumn('SCM_tbInventory','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbInventory','fdQty','存货数量');
        $this->addCommentOnColumn('SCM_tbInventory','fdBal','存货余额');
        $this->addCommentOnColumn('SCM_tbInventory','fdCostPrice','成本价');
        $this->addCommentOnColumn('SCM_tbInventory','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbInventory','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbInventory','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbInventory','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbInventory','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbInventory','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbInventory','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbInventory','即时库存');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbInventory');
    }
}
