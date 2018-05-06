<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbTransferMaterial 店内调拨明细单
 */
class m170328_102026_create_SCM_tbTransferMaterial extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbTransferMaterial', [
            'fsTransferOrderId'=>"VARCHAR(40) NOT NULL",//单号
            'fiEntryNumber'=>$this->smallInteger(4),//分录号
            'fsPkNo'=>'VARCHAR(40)',//唯一标示
            'fsMaterialId' => 'VARCHAR(30)	NOT NULL',//物料代码
            'fsMaterialName' => 'VARCHAR(50)	NOT NULL',//物料名称
            'fsModelno'=>'VARCHAR(250)',//规格型号
            'fsUnitId'=>'VARCHAR(20)',//计量单位代码
            'fdNumber'=>'NUMERIC(18,6)',//数量
            'fsDetailedNotes'=>'VARCHAR(255)',//明细备注
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbTransferMaterial PRIMARY KEY("fsTransferOrderId","fiEntryNumber","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbTransferMaterial', 'fsTransferOrderId', '单号');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fiEntryNumber','分录号');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsPkNo','唯一标示');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsMaterialName','物料名称');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsModelno','规格型号');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsUnitId','计量单位代码');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fdNumber','数量');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsDetailedNotes','明细备注');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbTransferMaterial','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbTransferMaterial', '店内调拨明细单');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbTransferMaterial');
    }
}
