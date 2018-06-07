<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m161107_061645_create_SCM_tbInvInitial初始化库存表
 */
class m161107_061645_create_SCM_tbInvInitial extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //        初始化库存
        $this->createTable('SCM_tbInvInitial', [
            'fiId' => $this->smallInteger(4),//序号
            'fsYYMM' => 'VARCHAR(20)	NOT NULL',//存货年月
            'fsMaterialId'=>'VARCHAR(20) NOT NULL',//物料代码
            'fsMaterialName' => 'VARCHAR(30)',//物料名称
            'fsModelno'=>'VARCHAR(250)',//规格型号
            'fsUnitId' => 'VARCHAR(20)',//计量单位
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fdQty' => 'NUMERIC(18,6)',//存货数量
            'fdBal' =>'NUMERIC(18,6)',//存货余额
            'fdCostPrice'=>'NUMERIC(18,6)',//--成本价
            'fsStorageId' => 'VARCHAR(20)	NOT NULL',//仓库代码
            'fsStorageName' => 'VARCHAR(30)',//仓库名称
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbInvInitial PRIMARY KEY("fsStorageId","fsYYMM","fsMaterialId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbInvInitial','fiId','序号');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsYYMM','存货年月');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsStorageId','仓库代码');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsStorageName','仓库名称');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsMaterialName','物料名称');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsModelno','规格型号');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsUnitId','计量单位代码');
        $this->addCommentOnColumn('SCM_tbInvInitial','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbInvInitial','fdQty','存货数量');
        $this->addCommentOnColumn('SCM_tbInvInitial','fdBal','存货余额');
        $this->addCommentOnColumn('SCM_tbInvInitial','fdCostPrice','成本价');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbInvInitial','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbInvInitial','初始化库存');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbInvInitial');
    }
}
