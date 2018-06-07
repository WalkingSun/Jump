<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class tbaddr 地址用;省/市/区
 */
class m161221_061947_create_tbaddr extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbaddr', [
            'id' => $this->integer(11) . ' NOT NULL', // id
            'areaname' => 'VARCHAR(50)' . ' NOT NULL', // 名称
            'parentid' => $this->integer(11)  . ' NOT NULL', // 父id
            'shortname'=> 'VARCHAR(50)', // 简称
            'lng' => 'VARCHAR(50)', // 经度
            'lat' => 'VARCHAR(50)', // 纬度
            'level' => $this->smallInteger(4) . ' NOT NULL', // 等级 1-省 2-市 3-区
            'position' => 'VARCHAR(50)' . ' NOT NULL', // id全名
            'sort'=>$this->integer(11), // 排序
            'CONSTRAINT tbaddr_pk PRIMARY KEY("id")'
        ]);
        $this->addCommentOnColumn('tbaddr', 'id', 'id');
        $this->addCommentOnColumn('tbaddr', 'areaname', '名称');
        $this->addCommentOnColumn('tbaddr', 'parentid', '父id');
        $this->addCommentOnColumn('tbaddr', 'shortname', '简称');
        $this->addCommentOnColumn('tbaddr', 'lng', '经度');
        $this->addCommentOnColumn('tbaddr', 'lat', '纬度');
        $this->addCommentOnColumn('tbaddr', 'level', '等级 1-省 2-市 3-区');
        $this->addCommentOnColumn('tbaddr', 'position', 'id全名');
        $this->addCommentOnColumn('tbaddr', 'sort', '排序');

        $this->addCommentOnTable('tbaddr', '地址用;省/市/区');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbaddr');
    }
}
