<?php
/**
 * 仓库表
 */
use yii\db\Migration;
use yii\db\Schema;


class m161107_061342_create_SCM_tbStorage extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //        仓库
        $this->createTable('SCM_tbStorage', [
            'fsStorageId' => 'VARCHAR(20)	NOT NULL',//代码
            'fsStorageName' => 'VARCHAR(30)	NOT NULL',//名称
            'fsStaffId' => 'VARCHAR(20)	NOT NULL',//管理员工代码
            'fiDirectDial'=>$this->smallInteger(4),//是否直拨 0否1是
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常9禁用13删除
            'fsDataAttribute' => 'VARCHAR(4)	NOT NULL',//	--数据属性;user用户级,sys系统级
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbStorage PRIMARY KEY("fsStorageId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbStorage','fsStorageId','仓库代码');
        $this->addCommentOnColumn('SCM_tbStorage','fsStorageName','仓库名称');
        $this->addCommentOnColumn('SCM_tbStorage','fsStaffId','管理员工代码');
        $this->addCommentOnColumn('SCM_tbStorage','fiDirectDial','是否直拨 0否1是');
        $this->addCommentOnColumn('SCM_tbStorage','fsDataAttribute','--数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbStorage','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbStorage','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbStorage','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbStorage','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbStorage','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbStorage','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbStorage','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbStorage','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbStorage','仓库');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbStorage');
    }
}
