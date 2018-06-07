<?php

use yii\db\Migration;

class m170427_082322_create_SCM_tbProcessBOM extends Migration
{
    public function up()
    {
        $this->createTable('SCM_tbProcessBOM',[
            'fsShopGUID'=>'VARCHAR(80) NOT NULL',//店铺GUID（必须是总店）
            'fsDesMaterialId'=>'VARCHAR(30) NOT NULL',//产出物料代码
            'fsMaterialId'=>'VARCHAR(30) NOT NULL',//原料物料代码
            'fsDesUnitId'=>'VARCHAR(20) NOT NULL',//产出计量单位
            'fsUnitId'=>'VARCHAR(20) NOT NULL',//原料计量单位
            'fdNumber'=>'NUMERIC(18,6)	NOT NULL',//所需原料数量
            'fiEntryNumber'=>$this->smallInteger()->notNull(),//分录号（原料的显示次序)
            'fiStatus'=>$this->smallInteger()->notNull(),//数据状态:1=正常/13=删除
            'fsRemark'=>'VARCHAR(255)',//备注
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId' => 'VARCHAR(20)',//更新用户ＩＤ
            'fsUpdateUserName' => 'VARCHAR(30)',//更新用户名
            'fiUpdateMode' =>$this->smallInteger(),//生成方式 （ 0：BOM 1：单据转化-- 单据号存在系统备注里）
            'fsSysRemark' =>'VARCHAR(255)',//系统备注（生成方式 1：单据转化-- 单据号存在系统备注里）
            'CONSTRAINT SCM_tbProcessBOM PRIMARY KEY("fsShopGUID","fsDesMaterialId","fsMaterialId")'
        ]);
        $this->addCommentOnColumn('SCM_tbProcessBOM', 'fsShopGUID', '店铺GUID');
        $this->addCommentOnColumn('SCM_tbProcessBOM', 'fsDesMaterialId', '产出物料代码');
        $this->addCommentOnColumn('SCM_tbProcessBOM', 'fsMaterialId', '原料物料代码');
        $this->addCommentOnColumn('SCM_tbProcessBOM', 'fsDesUnitId', '产出计量单位');
        $this->addCommentOnColumn('SCM_tbProcessBOM', 'fsUnitId', '原料计量单位');
        $this->addCommentOnColumn('SCM_tbProcessBOM', 'fdNumber', '所需原料数量');
        $this->addCommentOnColumn('SCM_tbProcessBOM', 'fiEntryNumber', '分录号（原料的显示次序）');
        $this->addCommentOnColumn('SCM_tbProcessBOM', 'fiStatus', '状态:1=正常/13=删除;');
        $this->addCommentOnColumn('SCM_tbProcessBOM', 'fsRemark', '备注');
        $this->addCommentOnColumn('SCM_tbProcessBOM','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbProcessBOM','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbProcessBOM','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbProcessBOM','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbProcessBOM','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbProcessBOM','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbProcessBOM','fiUpdateMode','生成方式 （ 0：BOM 1：单据转化-- 单据号存在系统备注里）');
        $this->addCommentOnColumn('SCM_tbProcessBOM','fsSysRemark','系统备注（生成方式 1：单据转化-- 单据号存在系统备注里）');
        $this->addCommentOnTable('SCM_tbProcessBOM', '半成品BOM配方表');
    }

    public function down()
    {
        $this->dropTable('SCM_tbProcessBOM');
    }

}
