<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbMaterialCostDtl 物料收发明细表
 */
class m170324_102024_create_SCM_tbMaterialCostDtl extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbMaterialCostDtl', [
            'fsYYMM' =>'VARCHAR(20) NOT NULL',//年月
            'fsMaterialId' => 'VARCHAR(30)	NOT NULL',//物料代码
            'fsMaterialName' => 'VARCHAR(50)	NOT NULL',//物料名称
            'fsModelno'=>'VARCHAR(250)',//规格型号
            'fsUnitId'=>'VARCHAR(20)',//单位
            'fsStorageId'=>'VARCHAR(20)',//仓库代码
            'fsBillTime'=>"VARCHAR(20)",//单据日期
            'fsBillNo'=>"VARCHAR(40) NOT NULL",//单据编码
            'fsBillType'=>"VARCHAR(20)",//单据类型 单据类型 采购入库单 Stock_I 采购出库单Stock_O  领料单Picking_O 退料单Picking_I 调入单Transfer_I 调出单Transfer_O 盘盈单Gain 盘亏单Loss 产品入库单ProductIn 销售出库单SaleOut_O 销售退货单SaleOut_I 半成品入库单 Process_I  半成品出库单  Process_O
            'fiEntryNumber'=>$this->smallInteger(4),//分录号
            'fdNumber'=>'NUMERIC(18,6)',//数量
            'fdPrice'=>'NUMERIC(18,6)',//--单价
            'fdCostPrice'=>'NUMERIC(18,6)',//--成本价
            'fiIOproperty' => $this->smallInteger(4) .' DEFAULT 0',//IO性质 ：（0：出库  1：入库）
            'fdBeginQty'=>'NUMERIC(18,6)',//--期初数量
            'fdEndQty'=>'NUMERIC(18,6)',//--期末数量
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbMaterialCostDtl PRIMARY KEY("fsBillNo","fiEntryNumber","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fsYYMM','年月');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fsMaterialName','物料名称');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fsModelno','规格型号');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fsUnitId','单位');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fsStorageId','仓库代码');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fsBillTime','单据日期');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fsBillNo','单据编码');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fsBillType','单据类型 采购入库单 Stock_I 采购出库单Stock_O  领料单Picking_O 退料单Picking_I 调入单Transfer_I 调出单Transfer_O 盘盈单Gain 盘亏单Loss 产品入库单ProductIn 销售出库单SaleOut_O 销售退货单SaleOut_I 半成品入库单 Process_I  半成品出库单  Process_O');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fiEntryNumber','分录号');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fdNumber','数量');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fdPrice','单价');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fdCostPrice','成本价');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fiIOproperty','IO性质 ：（0：出库  1：入库）');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fdBeginQty','期初数量');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fdEndQty','期末数量');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbMaterialCostDtl','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbMaterialCostDtl', '物料进出成本明细表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbMaterialCostDtl');
    }
}
