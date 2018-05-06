<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `SCM_tbParam `
 */
class m160908_061141_create_SCM_tbParamValue extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //        参数值表
        $this->createTable('SCM_tbParamValue', [
            'fsParamId' => 'VARCHAR(20) NOT NULL',//参数代码值
            'fsParamValue' => 'VARCHAR(250)',
            'fsStr1' => 'VARCHAR(255)',//—备用字串1
            'fsStr2' => 'VARCHAR(255)',//—备用字串2
            'fsStr3' => 'VARCHAR(255)',//—备用字串3
            'fsStr4' => 'VARCHAR(255)',//—备用字串4
            'fsStr5' => 'VARCHAR(255)',//—备用字串5
            'fiInt1' => $this->smallInteger(4),//—备用数值1
            'fiInt2' => $this->smallInteger(4),//—备用数值2
            'fiInt3' => $this->smallInteger(4),//—备用数值3
            'fiInt4' => $this->smallInteger(4),//—备用数值4
            'fiInt5' => $this->smallInteger(4),//—备用数值5
            'fiStatus' => $this->smallInteger(4) .' NOT NULL',//1正常9禁用13删除
            'fsCreateTime' => $this->dateTime(),
            'fsCreateUserId' => 'VARCHAR(20)',
            'fsCreateUserName' => 'VARCHAR(30)',
            'fsUpdateTime' => $this->dateTime(),
            'fsUpdateUserId' => 'VARCHAR(20)',
            'fsUpdateUserName' => 'VARCHAR(30)',
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
        ]);
        $this->addCommentOnColumn('SCM_tbParamValue','fsParamId','参数代码值');
        $this->addCommentOnColumn('SCM_tbParamValue','fsParamValue','参数值');
        $this->addCommentOnColumn('SCM_tbParamValue','fsStr1','备用字串1');
        $this->addCommentOnColumn('SCM_tbParamValue','fsStr2','备用字串2');
        $this->addCommentOnColumn('SCM_tbParamValue','fsStr3','备用字串3');
        $this->addCommentOnColumn('SCM_tbParamValue','fsStr4','备用字串4');
        $this->addCommentOnColumn('SCM_tbParamValue','fsStr5','备用字串5');
        $this->addCommentOnColumn('SCM_tbParamValue','fiInt1','备用数值1');
        $this->addCommentOnColumn('SCM_tbParamValue','fiInt2','备用数值2');
        $this->addCommentOnColumn('SCM_tbParamValue','fiInt3','备用数值3');
        $this->addCommentOnColumn('SCM_tbParamValue','fiInt4','备用数值4');
        $this->addCommentOnColumn('SCM_tbParamValue','fiInt5','备用数值5');
        $this->addCommentOnColumn('SCM_tbParamValue','fiStatus','状态： 1正常9禁用13删除');
        $this->addCommentOnColumn('SCM_tbParamValue','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbParamValue','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbParamValue','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbParamValue','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbParamValue','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbParamValue','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbParamValue','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbParamValue','参数结果');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbParamValue');
    }
}
