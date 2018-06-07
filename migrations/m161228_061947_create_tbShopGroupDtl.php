<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class tbShopGroupDtl 门店分组明细表
 */
class m161228_061947_create_tbShopGroupDtl extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbShopGroupDtl', [
            'fiShopGroupId' => $this->integer(16) .' NOT NULL', // 分组代号；流水号
            'fsShopGUID'=>'VARCHAR(80) NOT NULL', // 门店Guid
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsCompanyGUID' => 'VARCHAR(80) NOT NULL',//公司Guid;=ShopGUID
            'CONSTRAINT tbShopGroupDtl PRIMARY KEY("fiShopGroupId","fsShopGUID","fsCompanyGUID")'
        ]);

        $this->addCommentOnColumn('tbShopGroupDtl', 'fiShopGroupId', '分组代号；流水号');
        $this->addCommentOnColumn('tbShopGroupDtl', 'fsShopGUID', '门店Guid');
        $this->addCommentOnColumn('tbShopGroupDtl','fiStatus','状态： 1正常13删除');
        $this->addCommentOnColumn('tbShopGroupDtl','fsCreateTime','创建时间');
        $this->addCommentOnColumn('tbShopGroupDtl','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('tbShopGroupDtl','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('tbShopGroupDtl','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('tbShopGroupDtl','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('tbShopGroupDtl','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('tbShopGroupDtl','fsCompanyGUID','公司Guid;=ShopGUID');

        $this->addCommentOnTable('tbShopGroupDtl', '门店分组明细表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbShopGroupDtl');
    }
}
