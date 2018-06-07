<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbTableInfo 数据表字典
 */
class m161221_061947_create_SCM_tbTableInfo extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbTableInfo', [
            'fsTableId' => 'VARCHAR(30) NOT NULL', // 表格代码
            'fsTableName'=>'VARCHAR(30) NOT NULL', // 表格名称
            'fsKind' => 'VARCHAR(10)',  // 类型 1=餐饮模板下发/ 2=数据导入导出
            'fiSortOrder'=>$this->smallInteger(4),   // 顺序
            'fsFoodTradeList'=>'VARCHAR(30)', // 餐饮业态号;1=中式快餐 / 2=中式正餐
            'CONSTRAINT SCM_tbTableInfo PRIMARY KEY("fsTableId")'
        ]);
        $this->addCommentOnColumn('SCM_tbTableInfo', 'fsTableId', '表格代码');
        $this->addCommentOnColumn('SCM_tbTableInfo', 'fsTableName', '表格名称');
        $this->addCommentOnColumn('SCM_tbTableInfo', 'fsKind', '类型; 1=餐饮模板下发 / 2=数据导入导出');
        $this->addCommentOnColumn('SCM_tbTableInfo', 'fiSortOrder', '顺序');
        $this->addCommentOnColumn('SCM_tbTableInfo', 'fsFoodTradeList', '餐饮业态号; 1=中式快餐 / 2=中式正餐');
        $this->addCommentOnTable('SCM_tbTableInfo', '单据模板');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbTableInfo');
    }
}
