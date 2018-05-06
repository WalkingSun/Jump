<?php

use yii\db\Migration;

class m160926_061409_create_SCM_tbSalesHistory extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //        销售历史
        $this->createTable('SCM_tbSalesHistory', [
            'fsMaterialId' => 'VARCHAR(30)	NOT NULL',//物料代码
            'fdSalePrice'=>'NUMERIC(18,6)',//销售单价
            'fsSaleDate'=>'VARCHAR(20)',//销售日期
            'fsCustId' => 'VARCHAR(30)	NOT NULL',//客户代码
            'fsShopGUID' => 'VARCHAR(80) NOT NULL'
        ]);
        $this->addCommentOnColumn('SCM_tbSalesHistory','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbSalesHistory','fdSalePrice','销售单价');
        $this->addCommentOnColumn('SCM_tbSalesHistory','fsSaleDate','销售日期');
        $this->addCommentOnColumn('SCM_tbSalesHistory','fsCustId','客户代码');
        $this->addCommentOnColumn('SCM_tbSalesHistory','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbSalesHistory','销售历史');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbSalesHistory');
    }
}
