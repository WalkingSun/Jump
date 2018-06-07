<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbInvBackupDtl 盘点备份明细表
 */
class m161128_061946_create_SCM_tbInvBackupDtl extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbInvBackupDtl', [
            'fsCheckNo'=>"VARCHAR(40) NOT NULL",//盘点单号
            'fiEntryNumber'=>$this->smallInteger(4),//分录号
            'fsStorageId'=>'VARCHAR(20)',//盘点仓库代码
            'fsMaterialId'=>'VARCHAR(20)',//物料代码
            'fsMaterialName' => 'VARCHAR(50)	NOT NULL',//物料名称
            'fsModelno'=>'VARCHAR(250)',//规格型号
            'fsUnitId'=>'VARCHAR(20)',//单位
            'fdQtyMust'=>'NUMERIC(18,6)',//应收数量/帐存数量
            'fdNumber'=>'NUMERIC(18,6)',//数量
            'fdDiffQty'=>'NUMERIC(18,6)',//差异数量
            'fsRemark'=>'VARCHAR(255)',//备注
            'fiDtlType'=>$this->smallInteger(4). ' DEFAULT 1',//明细类型
            'fsBillNo'=>'VARCHAR(20)',//盘盈亏单号
            'fsBillType'=>"VARCHAR(20)",//单据类型Gain=盤盈單/Loss=盤虧單
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbInvBackupDtl PRIMARY KEY("fsCheckNo","fsStorageId","fsMaterialId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsCheckNo','盘点单号');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fiEntryNumber','分录号');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsStorageId','盘点仓库代码');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsMaterialName','物料名称');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsModelno','规格型号');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsUnitId','计量单位代码');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fdQtyMust','应收数量/帐存数量');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fdNumber','数量');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fdDiffQty','差异数量');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fiDtlType','明细类型');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsBillNo','盘盈亏单号');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsBillType','单据类型Gain=盤盈單/Loss=盤虧單');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbInvBackupDtl','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbInvBackupDtl','盘点备份明细');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbInvBackupDtl');
    }
}
