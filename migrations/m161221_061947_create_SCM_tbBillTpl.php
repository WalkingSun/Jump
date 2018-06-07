<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbBillTpl 单据模板
 */
class m161221_061947_create_SCM_tbBillTpl extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbBillTpl', [
            'fsBillTplId' =>'VARCHAR(20) NOT NULL', // 模板代码
            'fsBillTplName'=>'VARCHAR(30) NOT NULL',// 模板名称
            'fsApplicationUnitId' => 'VARCHAR(20)', // 申请单位代码
            'fsBillTplType'=>'VARCHAR(20)',// 模板类型 PORequest=申请单 POOrder=采购订单 Picking=领料单 Check=盘点单
            'fsRemark'=>'VARCHAR(255)', // 备注
            'fsPreset'=> $this->smallInteger(4),  // 预设
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',// 1正常/9=禁用/13删除
            'fsCreateTime' => $this->dateTime(), //创建日期时间
            'fsCreateUserId' => 'VARCHAR(20)',   //创建人ID
            'fsCreateUserName' => 'VARCHAR(30)', //创建人用户名
            'fsUpdateTime' => $this->dateTime(), //更新日期时间
            'fsUpdateUserId' => 'VARCHAR(20)',  //更新人ID
            'fsUpdateUserName' => 'VARCHAR(30)',//更新人用户名
            'fsShopGUID' => 'VARCHAR(80) NOT NULL', // 店铺GUID
            'CONSTRAINT SCM_tbBillTpl PRIMARY KEY("fsBillTplId","fsShopGUID")'
        ]);

        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsBillTplId', '模板代码');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsBillTplName', '模板名称');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsApplicationUnitId', '申请单位代码');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsBillTplType', '模板类型 PORequest=申请单 POOrder=采购订单 Picking=领料单 Check=盘点单');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsRemark', '备注');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsPreset', '预设');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fiStatus', '数据状态 1正常/9=禁用/13删除');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsCreateTime', '创建日期时间');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsCreateUserId', '创建人ID');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsCreateUserName', '创建人用户名');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsUpdateTime', '更新日期时间');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsUpdateUserId', '更新人ID');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsUpdateUserName', '更新人用户名');
        $this->addCommentOnColumn('SCM_tbBillTpl', 'fsShopGUID', '店铺GUID');

        $this->addCommentOnTable('SCM_tbBillTpl', '单据模板');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbBalance');
    }
}
