<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Handles the creation for table `SCM_tbCust` 客户表.
 */
class m160906_061013_create_SCM_tbCust extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
//        客户表
        $this->createTable('SCM_tbCust', [
            'fsCustId' => 'VARCHAR(30)	NOT NULL',//代码
            'fsCustName' => 'VARCHAR(50)	NOT NULL',//名称
            'fsCustShortName' => 'VARCHAR(30)',//简称
            'fsHelpCode'=>'VARCHAR(20) ',//助记码
            'fdNodeCd'=>'NUMERIC(18)	NOT NULL',//分类代码
            'fsCustTypeId'=>'VARCHAR(20)',//客户类别代码
            'fsRegionId'=>'VARCHAR(20)',//区域代码
            'fsBank'=>'VARCHAR(100)',//开户银行
            'fsAccount'=>'VARCHAR(100)',//银行账号
            'fsTaxNum'=>'VARCHAR(100)',//税务登记号
            'fdValueAddRate'=>'NUMERIC(18,6)',//--增值税率%
            'fsSaleId'=>'VARCHAR(30)',//销售方式代码
            'fdDiscountRate'=>'NUMERIC(18,6)',//折扣率
            'fsPriceLvlId'=>'VARCHAR(20)',//价格级别代码
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
            'fsCustLvlId'=>'VARCHAR(20)',//客户等级
            'fsTradeId'=>'VARCHAR(20)',//行业代码
            'fsRemark'=>'VARCHAR(255)',//备注
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
            'fsGUId' => 'VARCHAR(80) ',
            'CONSTRAINT SCM_tbCust PRIMARY KEY("fsCustId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbCust','fsCustId','客户代码');
        $this->addCommentOnColumn('SCM_tbCust','fsCustName','客户名称');
        $this->addCommentOnColumn('SCM_tbCust','fsCustShortName','简称');
        $this->addCommentOnColumn('SCM_tbCust','fsHelpCode','助记码');
        $this->addCommentOnColumn('SCM_tbCust','fdNodeCd','分类代码');
        $this->addCommentOnColumn('SCM_tbCust','fsCustTypeId','客户类别代码');
        $this->addCommentOnColumn('SCM_tbCust','fsRegionId','区域diam');
        $this->addCommentOnColumn('SCM_tbCust','fsBank','开户银行');
        $this->addCommentOnColumn('SCM_tbCust','fsAccount','银行账户');
        $this->addCommentOnColumn('SCM_tbCust','fsTaxNum','税务登记号');
        $this->addCommentOnColumn('SCM_tbCust','fdValueAddRate','增值税率%');
        $this->addCommentOnColumn('SCM_tbCust','fsSaleId','销售方式代码');
        $this->addCommentOnColumn('SCM_tbCust','fdDiscountRate','折扣率');
        $this->addCommentOnColumn('SCM_tbCust','fsPriceLvlId','价格级别代码');
        $this->addCommentOnColumn('SCM_tbCust','fiPurseType','钱包类型 1微信支付 2支付宝支付  3applePay');
        $this->addCommentOnColumn('SCM_tbCust','fsWalletAccount','钱包账户');
        $this->addCommentOnColumn('SCM_tbCust','fsTelCp','电话');
        $this->addCommentOnColumn('SCM_tbCust','fsFaxCp','传真');
        $this->addCommentOnColumn('SCM_tbCust','fsEmailCp','邮箱');
        $this->addCommentOnColumn('SCM_tbCust','fsAddressCp','地址');
        $this->addCommentOnColumn('SCM_tbCust','fsPostalCodeCp','邮编');
        $this->addCommentOnColumn('SCM_tbCust','fsContact','联系人');
        $this->addCommentOnColumn('SCM_tbCust','fsCellphoneCt','联系人电话');
        $this->addCommentOnColumn('SCM_tbCust','fsPreside','法人');
        $this->addCommentOnColumn('SCM_tbCust','fsCellphonePe','法人电话');
        $this->addCommentOnColumn('SCM_tbCust','fsCustLvlId','客户等级代码');
        $this->addCommentOnColumn('SCM_tbCust','fsTradeId','行业代码');
        $this->addCommentOnColumn('SCM_tbCust','fsRemark','备注');
        $this->addCommentOnColumn('SCM_tbCust','fsNodeCode','树节点编码');
        $this->addCommentOnColumn('SCM_tbCust','fsNodeText','树节点名称');
        $this->addCommentOnColumn('SCM_tbCust','fsNodeFullText','树节点全称');
        $this->addCommentOnColumn('SCM_tbCust','fsNodeFullCode','代码全名');
        $this->addCommentOnColumn('SCM_tbCust','fiStatus','状态： 1正常9禁用13删除');
        $this->addCommentOnColumn('SCM_tbCust','fsDataAttribute','数据属性;user用户级,sys系统级');
        $this->addCommentOnColumn('SCM_tbCust','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbCust','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbCust','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbCust','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbCust','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbCust','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbCust','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbCust','客户');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbCust');
    }
}
