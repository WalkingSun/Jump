<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbBalance 存货余额表
 */
class m161206_061947_create_SCM_tbBalance extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbBalance', [
            'fsYYMM' =>'VARCHAR(20) NOT NULL',//存货年月
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
            'CONSTRAINT SCM_tbBalance PRIMARY KEY("fsYYMM","fsMaterialId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbBalance','fsYYMM','存货年月');
        $this->addCommentOnColumn('SCM_tbBalance','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbBalance','fsMaterialName','物料名称');
        $this->addCommentOnColumn('SCM_tbBalance','fsModelno','规格型号');
        $this->addCommentOnColumn('SCM_tbBalance','fsUnitId','计量单位代码');
        $this->addCommentOnColumn('SCM_tbBalance','fdBeginQty','期初数量');
        $this->addCommentOnColumn('SCM_tbBalance','fdBeginBal','期初余额');
        $this->addCommentOnColumn('SCM_tbBalance','fdReceiveQty','本期收入数量');
        $this->addCommentOnColumn('SCM_tbBalance','fdReceiveBal','本期收入余额');
        $this->addCommentOnColumn('SCM_tbBalance','fdSendQty','本期发出数量');
        $this->addCommentOnColumn('SCM_tbBalance','fdSendBal','本期发出余额');
        $this->addCommentOnColumn('SCM_tbBalance','fdEndQty','期末数量');
        $this->addCommentOnColumn('SCM_tbBalance','fdEndBal','期末余额');
        $this->addCommentOnColumn('SCM_tbBalance','fsBillInterNo','顺序号');
        $this->addCommentOnColumn('SCM_tbBalance','fiStatus','状态： 1正常13删除');
        $this->addCommentOnColumn('SCM_tbBalance','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbBalance','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbBalance','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbBalance','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbBalance','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbBalance','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbBalance','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbBalance','存货余额');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbBalance');
    }
}
