<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class tbProj 专案/模块;sys
 */
class m161221_061947_create_tbproj extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbproj', [
            'fsProjId' => 'VARCHAR(20) NOT NULL', // 专案代码
            'fsProjName'=>'VARCHAR(50) NOT NULL', // 专案名称
            'fsUpdateTime'=>'VARCHAR(50) NOT NULL',   // 修改日期时间
            'fsUpdateUserId'=>'VARCHAR(20) NOT NULL', // 修改用户代码
            'fsUpdateUserName'=>'VARCHAR(50) NOT NULL', // 修改用户名称
            'CONSTRAINT tbproj_pk PRIMARY KEY("fsProjId")'
        ]);

        $this->addCommentOnColumn('tbproj', 'fsProjId', '专案代码');
        $this->addCommentOnColumn('tbproj', 'fsProjName', '专案名称');
        $this->addCommentOnColumn('tbproj', 'fsUpdateTime', '修改日期时间');
        $this->addCommentOnColumn('tbproj', 'fsUpdateUserId', '修改用户代码');
        $this->addCommentOnColumn('tbproj', 'fsUpdateUserName', '修改用户名称');

        $this->addCommentOnTable('tbproj', '专案/模块;sys');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbproj');
    }
}
