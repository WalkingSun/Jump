<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbInvBackupStorage 盘点备份仓库表
 */
class m161128_061947_create_SCM_tbInvBackupStorage extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbInvBackupStorage', [
            'fsCheckNo'=>"VARCHAR(40) NOT NULL",//盘点单号
            'fsStorageId'=>'VARCHAR(20)',//盘点仓库代码
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbInvBackupStorage PRIMARY KEY("fsCheckNo","fsStorageId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbInvBackupStorage','fsCheckNo','盘点单号');
        $this->addCommentOnColumn('SCM_tbInvBackupStorage','fsStorageId','仓库代码');
        $this->addCommentOnColumn('SCM_tbInvBackupStorage','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbInvBackupStorage','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbInvBackupStorage','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbInvBackupStorage','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbInvBackupStorage','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbInvBackupStorage','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbInvBackupStorage','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbInvBackupStorage','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbInvBackupStorage','盘点备份仓库');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbInvBackupStorage');
    }
}
