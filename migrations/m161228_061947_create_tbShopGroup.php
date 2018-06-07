<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class tbShopGroup 门店分组
 */
class m161228_061947_create_tbShopGroup extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbShopGroup', [
            'fiShopGroupId' => $this->integer(16) .' NOT NULL',// 分组代号；流水号
            'fsShopGroupName'=>'VARCHAR(50) NOT NULL', // 分组名称
            'fsShopGroupKind'=>'VARCHAR(80)',//分组类型;ex:地区/城市/市辖区
            'fiSortOrder'=>$this->smallInteger(4),//顺序
            'fsNote'=>'VARCHAR(250)',//备注
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsCompanyGUID' => 'VARCHAR(80) NOT NULL',//公司Guid;=ShopGUID
            'CONSTRAINT tbShopGroup PRIMARY KEY("fiShopGroupId","fsCompanyGUID")'
        ]);

        $this->addCommentOnColumn('tbShopGroup', 'fiShopGroupId', '分组代号；流水号');
        $this->addCommentOnColumn('tbShopGroup', 'fsShopGroupName', '分组名称');
        $this->addCommentOnColumn('tbShopGroup', 'fsShopGroupKind', '分组类型;ex:地区/城市/市辖区');
        $this->addCommentOnColumn('tbShopGroup', 'fiSortOrder', '顺序');
        $this->addCommentOnColumn('tbShopGroup', 'fsNote', '备注');
        $this->addCommentOnColumn('tbShopGroup','fiStatus','状态： 1正常13删除');
        $this->addCommentOnColumn('tbShopGroup','fsCreateTime','创建时间');
        $this->addCommentOnColumn('tbShopGroup','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('tbShopGroup','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('tbShopGroup','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('tbShopGroup','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('tbShopGroup','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('tbShopGroup','fsCompanyGUID','公司Guid;=ShopGUID');

        $this->addCommentOnTable('tbShopGroup', '门店分组');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbShopGroup');
    }
}
