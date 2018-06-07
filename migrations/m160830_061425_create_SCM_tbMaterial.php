<?php

use yii\db\Migration;

/**
 * Handles the creation for table `SCM_tbMaterial` 物料.
 */
class m160830_061425_create_SCM_tbMaterial extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //        物料
        $this->createTable('SCM_tbMaterial', [
            'fsMaterialId' => 'VARCHAR(30)	NOT NULL',//代码
            'fsMaterialName' => 'VARCHAR(50)	NOT NULL',//名称
            'fsMaterialAnotherName' => 'VARCHAR(30)',//别名
            'fsHelpCode'=>'VARCHAR(20) ',//助记码
            'fdNodeCd'=>'NUMERIC(18)	NOT NULL',//分类代码
            'fsMaterialEnglishName'=>'VARCHAR(50)',//英语名称
            'fsModelno'=>'VARCHAR(250)',//规格型号
            'fsFactory'=>'VARCHAR(255)',//厂牌
            'fsOriginPlace'=>'VARCHAR(255)',//产地
            'fsAttribute'=>'VARCHAR(250)',//标签属性
            'fsUnitId' => 'VARCHAR(20)',//基本计量单位
            'fsOrderUnit'=>'VARCHAR(20)',//采购计量单位
            'fdOrderUnitRate'=>'NUMERIC(18,6)',//采购单位换算率
            'fsSkUnit'=>'VARCHAR(20)',//库存计量单位
            'fdSkUnitRate'=>'NUMERIC(18,6)',//库存计量单位换算率
            'fsPdUnit'=>'VARCHAR(20)',//--生产单位
            'fdPdUnitRate'=>'NUMERIC(18,6)',//--生产单位换算率
            'fsSaleUnit'=>'VARCHAR(20)',//--销售单位
            'fdSaleUnitRate'=>'NUMERIC(18,6)',//--銷售单位换算率
            'fsSecUnit'=>'VARCHAR(20)',//--辅助单位
            'fsSupplierId' => 'VARCHAR(30)',//供货来源，供应商代码
            'fdOrderPrice'=>'NUMERIC(18,6)',//--采购单价
            'fdCost'=>'NUMERIC(18,6)',//成本单价
            'fdSalePrice'=>'NUMERIC(18,6)',//销售单价
            'fsSaleCode'=>'VARCHAR(30)',//销售代码
            'fdIncomeRate'=>'NUMERIC(18,6)',//进项税率
            'fdOutputRate'=>'NUMERIC(18,6)',//销项税率
            'fiCalcPriceId' => $this->smallInteger(4),//计价方法 1加权平均法,2先进先出去,3移动加权平均法
            'fdSafeInvQty'=>'NUMERIC(18,6)',//安荃库存量
            'fiSafeInvQtyAfg'=>$this->smallInteger(4),//安全库存提醒 0=否/1=是
            'fiBatchManager'=>$this->smallInteger(4),//是否采用批次管理 0=否/1=是
            'fdKFPeriodDays'=>'NUMERIC(18,6)',//保质天数
            'fsMaterialTypeId'=>'VARCHAR(20)',//物料类别代码
            'fiIsInv'=>$this->smallInteger(4),//是否为仓库存活 0=否/1=是
            'fsStockPlaceId'=>'VARCHAR(20)',//默认仓库
            'fsImgUrl'=>'VARCHAR(150)',//图片地址
            'fsBarcode'=>'VARCHAR(50)',//条码
            'fsRemark'=>'VARCHAR(250)',//备注
            'fsNodeCode'=>'VARCHAR(30)',//树节点编码
            'fsNodeText'=>'VARCHAR(30)',//树节点名称
            'fsNodeFullText'=>'VARCHAR(255)',//全名
            'fsNodeFullCode' => 'VARCHAR(250)',//代码全名
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常9禁用13删除
            'fsDataAttribute' => 'VARCHAR(4)	NOT NULL',//	--数据属性;user用户级,sys系统级
            'fsCreateTime' => $this->dateTime(),
            'fsCreateUserId' => 'VARCHAR(20)',
            'fsCreateUserName' => 'VARCHAR(30)',
            'fsUpdateTime' => $this->dateTime(),
            'fsUpdateUserId' => 'VARCHAR(20)',
            'fsUpdateUserName' => 'VARCHAR(30)',
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'fdAccounPrice'=>'NUMERIC(18,6)',//核算单价
            'fdAmount'=>'NUMERIC(18,6)',//库存数量
            'CONSTRAINT SCM_tbMaterial PRIMARY KEY("fsMaterialId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsMaterialId', '代码');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsMaterialName', '名称');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsMaterialAnotherName', '别名');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsHelpCode', '助记码');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fdNodeCd', '分类代码');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsMaterialEnglishName', '英语名称');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsModelno', '规格型号');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsFactory', '厂牌');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsOriginPlace', '产地');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsAttribute', '标签属性');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsUnitId', '基本计量单位');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsOrderUnit', '采购计量单位');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fdOrderUnitRate', '采购单位换算率');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsSkUnit', '库存计量单位');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fdSkUnitRate', '库存计量单位换算率');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsPdUnit', '生产单位');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fdPdUnitRate', '生产单位换算率');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsSaleUnit', '销售单位');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fdSaleUnitRate', '銷售单位换算率');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsSecUnit', '辅助单位');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsSupplierId', '供应商代码');
        $this->addCommentOnColumn('SCM_tbMaterial','fdOrderPrice','采购单价');
        $this->addCommentOnColumn('SCM_tbMaterial','fdCost','成本单价');
        $this->addCommentOnColumn('SCM_tbMaterial','fdSalePrice','销售单价');
        $this->addCommentOnColumn('SCM_tbMaterial','fsSaleCode','销售代码');
        $this->addCommentOnColumn('SCM_tbMaterial','fdIncomeRate','进项税率');
        $this->addCommentOnColumn('SCM_tbMaterial','fdOutputRate','销项税率');
        $this->addCommentOnColumn('SCM_tbMaterial','fiCalcPriceId','计价方法 1加权平均法,2先进先出去,3移动加权平均法');
        $this->addCommentOnColumn('SCM_tbMaterial','fdSafeInvQty','安荃库存量');
        $this->addCommentOnColumn('SCM_tbMaterial','fiSafeInvQtyAfg','安全库存提醒 0=否/1=是');
        $this->addCommentOnColumn('SCM_tbMaterial','fiBatchManager','是否采用批次管理 0=否/1=是');
        $this->addCommentOnColumn('SCM_tbMaterial','fdKFPeriodDays','保质天数');
        $this->addCommentOnColumn('SCM_tbMaterial','fsMaterialTypeId','物料类别代码');
        $this->addCommentOnColumn('SCM_tbMaterial','fiIsInv','是否为仓库存活 0=否/1=是');
        $this->addCommentOnColumn('SCM_tbMaterial','fsStockPlaceId','默认仓库');
        $this->addCommentOnColumn('SCM_tbMaterial','fsImgUrl','图片地址');
        $this->addCommentOnColumn('SCM_tbMaterial','fsBarcode','条码');
        $this->addCommentOnColumn('SCM_tbMaterial','fsRemark','备注');
        $this->addCommentOnColumn('SCM_tbMaterial','fsNodeCode','树节点编码');
        $this->addCommentOnColumn('SCM_tbMaterial','fsNodeText','树节点名称');
        $this->addCommentOnColumn('SCM_tbMaterial','fsNodeFullText','树节点全称');
        $this->addCommentOnColumn('SCM_tbMaterial','fsNodeFullCode','代码全名');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsDataAttribute', '数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsCreateTime', '创建日期时间');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsCreateUserId', '创建人ID');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsCreateUserName', '创建人用户名');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsUpdateUserId', '更新人ID');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsUpdateUserName', '更新人用户名');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fdAccounPrice', '核算单价');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fdAmount', '库存数量');
        $this->addCommentOnColumn('SCM_tbMaterial', 'fsShopGUID', '店铺GUID');

        $this->addCommentOnTable('SCM_tbMaterial', '物料');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbMaterial');
    }
}
