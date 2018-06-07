<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbInvBackup 盘点备份表
 */
class m161128_061946_create_SCM_tbInvBackup extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbInvBackup', [
            'fsCheckNo'=>"VARCHAR(40) NOT NULL",//盘点单号
            'fsCheckName'=>'VARCHAR(50)',//盘点方案名称
            'fsBackupDateTime'=>$this->dateTime(),//账存时间
            'fsCheckDate'=>'VARCHAR(20)',//盘点时间
            'fsStaffNameCheck'=>'VARCHAR(30)',//盘点人
            'fsStaffNameKeep'=>'VARCHAR(30)',//保管人
            'fsRemark'=>'VARCHAR(255)',//备注
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbInvBackup PRIMARY KEY("fsCheckNo","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbInvBackup','fsCheckNo','盘点单号');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsCheckName','盘点方案名称');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsBackupDateTime','账存时间');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsCheckDate','盘点时间');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsStaffNameCheck','盘点人');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsStaffNameKeep','保管人');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsRemark','备注');
        $this->addCommentOnColumn('SCM_tbInvBackup','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbInvBackup','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbInvBackup','盘点备份');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbInvBackup');
    }
}
