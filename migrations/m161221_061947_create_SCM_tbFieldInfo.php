<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbFieldInfo 数据表栏位字典
 */
class m161221_061947_create_SCM_tbFieldInfo extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbFieldInfo', [
            'fsFieldId' => 'VARCHAR(30) NOT NULL', //    栏位代码
            'fsFieldName'=>'VARCHAR(30) NOT NULL', //    栏位名称
            'CONSTRAINT SCM_tbFieldInfo PRIMARY KEY("fsFieldId")'
        ]);
        $this->addCommentOnColumn('SCM_tbFieldInfo', 'fsFieldId', '栏位代码');
        $this->addCommentOnColumn('SCM_tbFieldInfo', 'fsFieldName', '栏位名称');

        $this->addCommentOnTable('SCM_tbFieldInfo', '数据表栏位字典');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbFieldInfo');
    }
}
