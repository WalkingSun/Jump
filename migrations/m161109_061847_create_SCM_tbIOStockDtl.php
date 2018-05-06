<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m161109_061945_create_SCM_tbIOStockDtl 入出库明细表
 */
class m161109_061847_create_SCM_tbIOStockDtl extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbIOStockDtl', [
            'fsBillNo'=>"VARCHAR(40) NOT NULL",//单据编码
            'fiEntryNumber'=>$this->smallInteger(4),//分录号
            'fsPkNo'=>'VARCHAR(40)',//唯一标示
            'fsMaterialId' => 'VARCHAR(30)	NOT NULL',//物料代码
            'fsMaterialName' => 'VARCHAR(50)	NOT NULL',//物料名称
            'fsModelno'=>'VARCHAR(250)',//规格型号
            'fsUnitId'=>'VARCHAR(20)',//单位
            'fdQtyMust'=>'NUMERIC(18,6)',//应收数量/帐存数量
            'fdNumber'=>'NUMERIC(18,6)',//数量, 盘盈|盘亏|调拨
            'fdPrice'=>'NUMERIC(18,6)',//--单价
            'fdTaxPrice'=>'NUMERIC(18,6)',//含税单价
            'fdMoney'=>'NUMERIC(18,6)',//金额
            'fdValueAddRate'=>'NUMERIC(18,6)',//--增值税率%
            'fdTax'=>'NUMERIC(18,6)',//税额
            'fdTotalTax'=>'NUMERIC(18,6)',//价税合计
            'fdQtyActual'=>'NUMERIC(18,6)',//实存数量
            'fsManufactureDate'=>'VARCHAR(20)',//生产日期
            'fsWarrantyDate'=>'VARCHAR(20)',//保质日期
            'fiWarrantyDateAfg'=>$this->smallInteger(2),//保质日期提醒标示
            'fsDetailedNotes'=>'VARCHAR(255)',//明细备注
            'fsApplicationUnitName' => 'VARCHAR(40)',//申请单位名称
            'fsStorageId_I'=>'VARCHAR(20)',//入库仓
            'fsStorageId_O'=>'VARCHAR(20)',//出库仓
            'fsSingleSourceNumber'=>'VARCHAR(50)',//源单单号
            'fsSourceEntryNumber'=>$this->integer(12),//源单流水号
            'fdMaterialNumber'=>'NUMERIC(18,6)',//领料关联数量
            'fdReturnNumber'=>'NUMERIC(18,6)',//退货关联数量
            'fdReturnMaterialNumber'=>'NUMERIC(18,6)',//退料取用数量
            'fdInvoiceNumber'=>'NUMERIC(18,6)',//发票取用数量
            'fdRefundNumber'=>'NUMERIC(18,6)',//销售退库取用数量
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常13删除
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'fiIOproperty' => $this->smallInteger(4) .' DEFAULT 0',//IO性质 ：（0：出库  1：入库）
            'fiCostCheck' => $this->smallInteger(4) .' DEFAULT 0',//成本计算标记（0：未计算  1：已计算）
            'fdCostPrice'=>'NUMERIC(18,6)',//即时成本单价
            'fdOriginPrice'=>'NUMERIC(18,6)  DEFAULT 0',//原含税单价
            'fdGross_profit'=>'NUMERIC(18,6)  DEFAULT 0',//毛利
            'CONSTRAINT SCM_tbIOStockDtl PRIMARY KEY("fsBillNo","fiEntryNumber","fsPkNo"，"fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsBillNo','单据编号');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fiEntryNumber','分录号');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsPkNo','唯一标示');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsMaterialId','物料代码');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsMaterialName','物料名称');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsModelno','规格型号');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsUnitId','计量单位代码');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdQtyMust','应收数量/帐存数量');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdNumber','数量 盘盈|盘亏|调拨');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdPrice','单价');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdTaxPrice','含税单价');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdMoney','金额');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdValueAddRate','增值税率%');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdTax','税额');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdTotalTax','价税合计');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdQtyActual','实存数量');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsManufactureDate','生产日期');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsWarrantyDate','保质日期');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fiWarrantyDateAfg','保质日期标示');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsDetailedNotes','明细备注');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsApplicationUnitName','申请单位名称');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsStorageId_I','入库仓');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsStorageId_O','出库仓');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsSingleSourceNumber','源单单号');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsSourceEntryNumber','源单流水号');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdMaterialNumber','领料关联数量');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdReturnNumber','退货关联数量');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdReturnMaterialNumber','退料取用数量');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdInvoiceNumber','发票取用数量');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdRefundNumber','销售退库取用数量');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fiStatus','状态：1正常13删除');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fsShopGUID','门店代码');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fiIOproperty','IO性质 ：（0：出库  1：入库）');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fiCostCheck','成本计算标记（0：未计算  1：已计算）');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdCostPrice','即时成本单价');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdOriginPrice','原含税单价');
        $this->addCommentOnColumn('SCM_tbIOStockDtl','fdGross_profit','毛利');
        $this->addCommentOnTable('SCM_tbIOStockDtl','出入库单据明细');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbIOStockDtl');
    }
}
