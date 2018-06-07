<?php

use yii\db\Migration;

/**
 * Handles the creation for table `SCM_tbUpYunImg`.
 */
class m160830_061715_create_SCM_tbUpYunImg extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //又拍云图片记录
        $this->createTable('SCM_tbUpYunImg', [
            'fsImgId'=>'VARCHAR(50) NOT NULL',//图片id
            'fsImgName'=>'VARCHAR(150) NOT NULL',//名称
            'fsImgUrl'=>'VARCHAR(150) NOT NULL',//路径
            'fsPageId' =>'VARCHAR(50)	NOT NULL',//页面代码
            'fsCode'=>'VARCHAR(20)',//代码
            'fiStatus'=>$this->smallInteger(4) .' NOT NULL',
            'fsCreateTime' => $this->dateTime(),//创建时间
            'fsCreateUserId' => 'VARCHAR(20)',//创建用户ID
            'fsCreateUserName' => 'VARCHAR(30)',//创建用户名
            'fsUpdateTime' => $this->dateTime(),//更新时间
            'fsUpdateUserId'=>'VARCHAR(20)',
            'fsUpdateUserName'=>'VARCHAR(30)',
            'fsShopGUID' => 'VARCHAR(80) NOT NULL',
            'CONSTRAINT SCM_tbUpYunImg PRIMARY KEY("fsImgId","fsShopGUID")'
        ]);
        $this->addCommentOnColumn('SCM_tbUpYunImg','fsImgId','图片id');
        $this->addCommentOnColumn('SCM_tbUpYunImg','fsImgName','图片名称');
        $this->addCommentOnColumn('SCM_tbUpYunImg','fsImgUrl','图片路由');
        $this->addCommentOnColumn('SCM_tbUpYunImg','fsPageId','页面代码');
        $this->addCommentOnColumn('SCM_tbUpYunImg','fsCode','代码');
        $this->addCommentOnColumn('SCM_tbUpYunImg','fiStatus','状态： 1正常9禁用13删除');
        $this->addCommentOnColumn('SCM_tbUpYunImg','fsCreateTime','创建时间');
        $this->addCommentOnColumn('SCM_tbUpYunImg','fsCreateUserId','创建用户uid');
        $this->addCommentOnColumn('SCM_tbUpYunImg','fsCreateUserName','创建用户名称');
        $this->addCommentOnColumn('SCM_tbUpYunImg','fsUpdateTime','更新时间');
        $this->addCommentOnColumn('SCM_tbUpYunImg','fsUpdateUserId','更新用户uid');
        $this->addCommentOnColumn('SCM_tbUpYunImg','fsUpdateUserName','更新用户名称');
        $this->addCommentOnColumn('SCM_tbUpYunImg','fsShopGUID','门店代码');
        $this->addCommentOnTable('SCM_tbUpYunImg','又拍云图片记录');
    }
 
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbUpYunImg');
    }
}
