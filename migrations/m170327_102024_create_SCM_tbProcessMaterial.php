<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbProcessMaterial 加工单明细表
 */
class m170327_102024_create_SCM_tbProcessMaterial extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbProcessMaterial', [
            'fsProcessOrderId' =>" VARCHAR(40) NOT NULL",//单号
            'fiEntryNumber'=>$this->smallInteger(4),//分录号
            'fsPkNo'=>'VARCHAR(40)',//唯一标示
            'fsMaterialId' => 'VARCHAR(30)	NOT NULL',//物料代码
            'fsMaterialName' => 'VARCHAR(50)	NOT NULL',//物料名称
            'fsModelno'=>'VARCHAR(250)',//规格型号
            'fsUnitId'=>'VARCHAR(20)',//单位
            'fdNumber'=>'NUMERIC(18,6)',//数量
            'fdPrice'=>'NUMERIC(18,6)',//--单价
            'fdMoney'=>'NUMERIC(18,6)',//金额
            'fsStorageId'=>'VARCHAR(20)',//仓库代码
            'fsDetailedNotes'=>'VARCHAR(255)',//明细备注
            'fiIOproperty' => $this->smallInteger(4) .' DEFAULT 0',//IO性质 ：（0：出库  1：入库）
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'fsOrderUnit'=>'VARCHAR(20)',//采购计量单位
            'CONSTRAINT SCM_tbProcessMaterial PRIMARY KEY("fsProcessOrderId","fiEntryNumber","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbProcessMaterial', 'fsProcessOrderId', '单号');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fiEntryNumber','分录号');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsPkNo','唯一标示');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsMaterialName','物料名称');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsModelno','规格型号');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsUnitId','单位');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fdNumber','数量');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fdPrice','单价');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fdMoney','金额');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsStorageId','仓库代码');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsDetailedNotes','明细备注');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fiIOproperty','IO性质 ：（0：出库  1：入库）');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsShopGUID','门店代码');
        $this->addCommentOnColumn('SCM_tbProcessMaterial','fsOrderUnit','采购计量单位');
        $this->addCommentOnTable('SCM_tbProcessMaterial', '加工单明细表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbProcessMaterial');
    }
}
