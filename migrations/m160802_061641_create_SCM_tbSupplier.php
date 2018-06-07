<?php

use yii\db\Migration;

/**
 * Handles the creation for table `SCM_tbSupplier `.
 */
class m160802_061641_create_SCM_tbSupplier extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // 供应商表
        $this->createTable('SCM_tbSupplier', [
            'fsSupplierId' => 'VARCHAR(30)	NOT NULL',//代码
            'fsSupplierName' => 'VARCHAR(50)	NOT NULL',//名称
            'fsSupplierShortName' => 'VARCHAR(30)',//简称
            'fsHelpCode'=>'VARCHAR(20) ',//助记码
            'fdNodeCd'=>'NUMERIC(18)	NOT NULL',//分类代码
            'fsRegionId' => 'VARCHAR(20)',//区域代码
            'fsTaxNum'=>'VARCHAR(100)',//税务登记号
            'fsBank'=>'VARCHAR(100)',//开户银行
            'fsAccount'=>'VARCHAR(100)',//银行账号
            'fdValueAddRate'=>'NUMERIC(18,6)',//--增值税率%
            'fiIsTax'=>$this->smallInteger(4),//单价是否含税//1含税0不含税
            'fdPeriodAccount'=>'NUMERIC(18,6)',//账期天数
            'fiPurseType'=>$this->smallInteger(4),//钱包类型 1微信支付 2支付宝支付  3applePay
            'fsWalletAccount'=>'VARCHAR(100)',//钱包账户
            'fsTelCp'=>'VARCHAR(50)',//电话
            'fsFaxCp'=>'VARCHAR(50)',//传真
            'fsEmailCp'=>'VARCHAR(50)',//邮箱
            'fsAddressCp'=>'VARCHAR(250)',//公司地址
            'fsPostalCodeCp'=>'VARCHAR(20)',//邮编
            'fsContact'=>'VARCHAR(50)',//联系人
            'fsCellphoneCt'=>'VARCHAR(50)',//联系人电话
            'fsPreside'=>'VARCHAR(20)',//法人
            'fsCellphonePe'=>'VARCHAR(50)',//法人电话
            'fsAddressFa'=>'VARCHAR(250)',//--工厂地址
            'fsPostalCodeFa'=>'VARCHAR(10)',//--工厂邮编
            'fsSupplierTypeId'=>'VARCHAR(20)',//供应商类别
            'fsTradeId'=>'VARCHAR(20)',//行业代码
            'fsSupplierLvlId' => 'VARCHAR(20)',//供应商评级代码
            'fsRemark'=>'VARCHAR(255)',//备注
            'fsNodeCode'=>'VARCHAR(30)',//树节点编码
            'fsNodeText'=>'VARCHAR(30)',//树节点名称
            'fsNodeFullText'=>'VARCHAR(255)',//全名
            'fsNodeFullCode' => 'VARCHAR(250)',//代码全名
            'fsDataAttribute' => 'VARCHAR(4)	NOT NULL',//	--数据属性;user用户级,sys系统级
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常9禁用13删除
            'fsCreateTime' => $this->dateTime(),
            'fsCreateUserId' => 'VARCHAR(20)',
            'fsCreateUserName' => 'VARCHAR(30)',
            'fsUpdateTime' => $this->dateTime(),
            'fsUpdateUserId' => 'VARCHAR(20)',
            'fsUpdateUserName' => 'VARCHAR(30)',
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'fsGUId' => 'VARCHAR(80)',
            'CONSTRAINT SCM_tbSupplier PRIMARY KEY("fsSupplierId","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbSupplier', 'fsSupplierId', '代码');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsSupplierName', '名称');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsSupplierShortName', '简称');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsHelpCode', '助记码');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fdNodeCd', '分类代码');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsRegionId', '区域代码');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsTaxNum', '税务登记号');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsBank', '开户银行');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsAccount', '银行账号');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fdValueAddRate', '增值税率%');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fiIsTax', '单价是否含税 0=不含税 1=含税');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fdPeriodAccount', '账期天数');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fiPurseType', '钱包类型 1=微信支付 2=支付宝支付 3=applePay');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsWalletAccount', '钱包账户');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsTelCp', '电话');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsFaxCp', '传真');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsEmailCp', '邮箱');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsAddressCp', '公司地址');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsPostalCodeCp', '邮编');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsContact', '联系人');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsCellphoneCt', '联系人电话');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsPreside', '法人');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsCellphonePe', '法人电话');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsAddressFa', '工厂地址');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsPostalCodeFa', '工厂邮编');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsSupplierTypeId', '供应商类别代码');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsTradeId', '行业类别代码');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsSupplierLvlId', '供应商评级代码');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsRemark', '备注');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsNodeCode', '树节点编码');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsNodeText', '树节点名称');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsNodeFullText', '全名');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsNodeFullCode', '代码全名');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsDataAttribute', '数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsCreateTime', '创建日期时间');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsCreateUserId', '创建人ID');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsCreateUserName', '创建人用户名');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsUpdateUserId', '更新人ID');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsUpdateUserName', '更新人用户名');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsShopGUID', '店铺GUID');
        $this->addCommentOnColumn('SCM_tbSupplier', 'fsGUId', '平台GUID');

        $this->addCommentOnTable('SCM_tbSupplier', '供应商表');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbSupplier');
    }
}
