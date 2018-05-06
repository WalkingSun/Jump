<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `SCM_tbNo `
 */
class m160913_061845_create_SCM_tbNo extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //        取号表，单据
        $this->createTable('SCM_tbNo', [
            'fsCls'=>'VARCHAR(30)	NOT NULL',//		--类别
            'fdNo'=>'NUMERIC(12)	NOT NULL',//--流水号
            'fsUse'=>'VARCHAR(2)',//使用否;n/y
            'fsSysDate' => $this->dateTime(),//喜帖时间
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbNo PRIMARY KEY("fsCls","fdNo","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbNo','fsCls','--类别');
        $this->addCommentOnColumn('SCM_tbNo','fdNo','流水号');
        $this->addCommentOnColumn('SCM_tbNo','fsUse','使用否;n/y');
        $this->addCommentOnColumn('SCM_tbNo','fsSysDate','喜帖时间');
        $this->addCommentOnColumn('SCM_tbNo','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbNo','单据取号');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbNo');
    }
}
