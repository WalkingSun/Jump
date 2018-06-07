<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class tbfoodtrade 餐饮业态表
 */
class m161221_061947_create_tbfoodtrade extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbfoodtrade', [
            'fsFoodTradeId' => 'VARCHAR(20) NOT NULL', // 餐饮业态代号
            'fsFoodTradeName'=>'VARCHAR(50) NOT NULL', // 餐饮业态名称
            'fiStatus' => 'VARCHAR(20) NOT NULL',  // 状态;1正常、9禁用、13删除
            'fsUpdateTime'=>'VARCHAR(50) NOT NULL',   // 修改日期时间
            'fsUpdateUserId'=>'VARCHAR(20) NOT NULL', // 修改用户代码
            'fsUpdateUserName'=>'VARCHAR(50) NOT NULL', // 修改用户名称
            'CONSTRAINT tbfoodtrade_pk PRIMARY KEY("fsFoodTradeId")'
        ]);

        $this->addCommentOnColumn('tbfoodtrade', 'fsFoodTradeId', '餐饮业态代号');
        $this->addCommentOnColumn('tbfoodtrade', 'fsFoodTradeName', '餐饮业态名称');
        $this->addCommentOnColumn('tbfoodtrade', 'fiStatus', '状态;1正常、9禁用、13删除');
        $this->addCommentOnColumn('tbfoodtrade', 'fsUpdateTime', '修改日期时间');
        $this->addCommentOnColumn('tbfoodtrade', 'fsUpdateUserId', '修改用户代码');
        $this->addCommentOnColumn('tbfoodtrade', 'fsUpdateUserName', '修改用户名称');

        $this->addCommentOnTable('tbfoodtrade', '餐饮业态表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbfoodtrade');
    }
}
