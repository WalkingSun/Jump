<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbInvBalance 仓库存货余额表
 */
class m161206_061946_create_SCM_tbInvBalance extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbInvBalance', [
            'fsYYMM' =>'VARCHAR(20) NOT NULL',//存货年月
            'fsStorageId'=>'VARCHAR(20) NOT NULL',//仓库代码
            'fsMaterialId'=>'VARCHAR(30) NOT NULL',//物料代码
            'fsMaterialName' => 'VARCHAR(50)',//物料名称
            'fsModelno'=>'VARCHAR(250)',//规格型号
            'fsUnitId'=>'VARCHAR(20)',//单位
            'fdBeginQty'=>'NUMERIC(18,6)',//初期數量
            'fdBeginBal'=>'NUMERIC(18,6)',//期初余额
            'fdReceiveQty'=>'NUMERIC(18,6)',//本期收入数量
            'fdReceiveBal'=>'NUMERIC(18,6)',//本期收入余额
            'fdSendQty'=>'NUMERIC(18,6)',//本期发出数量
            'fdSendBal'=>'NUMERIC(18,6)',//本期发出余额
            'fdGainQty'=>'NUMERIC(18,6)',//本期盘盈数量
            'fdGainBal'=>'NUMERIC(18,6)',//本期盘盈余额
            'fdLossQty'=>'NUMERIC(18,6)',//本期盘亏数量
            'fdLossBal'=>'NUMERIC(18,6)',//本期盘亏余额
            'fdEndQty'=>'NUMERIC(18,6)',//期末数量
            'fdEndBal'=>'NUMERIC(18,6)',//期末余额
            'fsBillInterNo'=>'VARCHAR(20)',//顺序号
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'fdBeginCost'=>'NUMERIC(18, 6) NOT NULL DEFAULT 0',//
            'fdEndCost'=>'NUMERIC(18, 6) NOT NULL DEFAULT 0',//
            'CONSTRAINT SCM_tbInvBalance PRIMARY KEY("fsYYMM","fsStorageId","fsMaterialId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbInvBalance','fsYYMM','存货年月');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsStorageId','仓库代码');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsMaterialName','物料名称');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsModelno','规格型号');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsUnitId','计量单位代码');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdBeginQty','期初数量');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdBeginBal','期初余额');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdReceiveQty','本期收入数量');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdReceiveBal','本期收入余额');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdSendQty','本期发出数量');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdSendBal','本期发出余额');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdGainQty','本期盘盈数量');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdGainBal','本期盘盈余额');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdLossQty','本期盘亏数量');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdLossBal','本期盘亏余额');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdEndQty','期末数量');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdEndBal','期末余额');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsBillInterNo','顺序号');
        $this->addCommentOnColumn('SCM_tbInvBalance','fiStatus','状态： 1正常13删除');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbInvBalance','fsShopGUID','门店代码');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdBeginCost','期初平均成本价');
        $this->addCommentOnColumn('SCM_tbInvBalance','fdEndCost','期末平均成本价');
        $this->addCommentOnTable('SCM_tbInvBalance','仓库存货余额');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbInvBalance');
    }
}
