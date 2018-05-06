<?php

use yii\db\Migration;

class m160826_061409_create_SCM_tbUnit extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //计量单位
        $this->createTable('SCM_tbUnit', [
            'fsUnitId' => 'VARCHAR(20)	NOT NULL',//代码
            'fsUnitName' => 'VARCHAR(30)	NOT NULL',//名称
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常9禁用13删除
            'fsDataAttribute' => 'VARCHAR(4)	NOT NULL',//	--数据属性;user用户级,sys系统级
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbUnit PRIMARY KEY("fsUnitId","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbUnit', 'fsUnitId', '代码');
        $this->addCommentOnColumn('SCM_tbUnit', 'fsUnitName', '名称');
        $this->addCommentOnColumn('SCM_tbUnit', 'fsDataAttribute', '数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbUnit', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbUnit', 'fsCreateTime', '创建日期时间');
        $this->addCommentOnColumn('SCM_tbUnit', 'fsCreateUserId', '创建人ID');
        $this->addCommentOnColumn('SCM_tbUnit', 'fsCreateUserName', '创建人用户名');
        $this->addCommentOnColumn('SCM_tbUnit', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnColumn('SCM_tbUnit', 'fsUpdateUserId', '更新人ID');
        $this->addCommentOnColumn('SCM_tbUnit', 'fsUpdateUserName', '更新人用户名');
        $this->addCommentOnColumn('SCM_tbUnit', 'fsShopGUID', '店铺GUID');

        $this->addCommentOnTable('SCM_tbUnit', '计量单位');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbUnit');
    }
}
