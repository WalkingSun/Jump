<?php

use yii\db\Migration;

class m190509_031702_inventory extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB COMMENT="菜单表"';
        }

        $this->createTable('Ms_inventory', [
            'id' => $this->primaryKey(),
            'goods'=>$this->string(16)->notNull(),
            'num' => $this->integer(11)->defaultValue(0)
        ],$tableOptions);

    }

    public function safeDown()
    {
        return $this->dropTable('Ms_inventory');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190509_031702_inventory cannot be reverted.\n";

        return false;
    }
    */
}
