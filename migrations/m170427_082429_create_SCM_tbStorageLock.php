<?php

use yii\db\Migration;

class m170427_082429_create_SCM_tbStorageLock extends Migration
{
    public function up()
    {
        $this->createTable('SCM_tbStorageLock', [
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',//店铺GUID;（必须是总店）
            'fsMaterialId' => 'VARCHAR(20) NOT NULL',//物料代码
            'fsUnitId' => 'VARCHAR(80) NOT NULL',//计量单位代码
            'fdQty'=>'NUMERIC(18,6)	NOT NULL',//锁定数量
            'fsCreateTime'=> $this->dateTime(),//创建日期时间
            'fsUpdateTime'=> $this->dateTime(),//更新日期时间
            'CONSTRAINT SCM_tbStorageLock PRIMARY KEY("fsShopGUID","fsMaterialId")'
        ]);
        $this->addCommentOnColumn('SCM_tbStorageLock', 'fsShopGUID', '店铺GUID');
        $this->addCommentOnColumn('SCM_tbStorageLock', 'fsMaterialId', '物料代码');
        $this->addCommentOnColumn('SCM_tbStorageLock', 'fsUnitId', '计量单位代码');
        $this->addCommentOnColumn('SCM_tbStorageLock', 'fdQty', '锁定数量');
        $this->addCommentOnColumn('SCM_tbStorageLock', 'fsCreateTime', '创建日期时间');
        $this->addCommentOnColumn('SCM_tbStorageLock', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnTable('SCM_tbStorageLock', '半成品BOM配方表');
    }

    public function down()
    {
        $this->dropTable('SCM_tbStorageLock');
    }
}
