<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Handles the creation for table `SCM_tbShippingAddress` 送货地址.
 */
class m160831_061833_create_SCM_tbShippingAddress extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //        送货地址
        $this->createTable('SCM_tbShippingAddress', [
            'fiId'=>'VARCHAR(30)	NOT NULL',
            'fsAddress' => 'VARCHAR(250)	NOT NULL',//地址
            'fsAddressExplain' => 'VARCHAR(250)	NOT NULL',//说明
            'fiDefault'=>$this->smallInteger(4).' DEFAULT 1',//是否默认,1默认 2否认
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常9禁用13删除
            'fsDataAttribute' => 'VARCHAR(4)	NOT NULL',//	--数据属性;user用户级,sys系统级
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbShippingAddress PRIMARY KEY("fiId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbShippingAddress','fiId','主键');
        $this->addCommentOnColumn('SCM_tbShippingAddress','fsAddress','地址');
        $this->addCommentOnColumn('SCM_tbShippingAddress','fsAddressExplain','说明');
        $this->addCommentOnColumn('SCM_tbShippingAddress','fiDefault','是否默认,1默认 2否认');
        $this->addCommentOnColumn('SCM_tbShippingAddress','fiStatus','状态： 1正常9禁用13删除');
        $this->addCommentOnColumn('SCM_tbShippingAddress','fsDataAttribute','数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbShippingAddress','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbShippingAddress','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbShippingAddress','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbShippingAddress','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbShippingAddress','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbShippingAddress','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbShippingAddress','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbShippingAddress','地址');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbShippingAddress');
    }
}
