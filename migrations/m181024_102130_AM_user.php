<?php

use yii\db\Migration;

class m181024_102130_AM_user extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('AM_user','password','varchar(64) ');
    }

    public function safeDown()
    {
        echo "m181024_102130_AM_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181024_102130_AM_user cannot be reverted.\n";

        return false;
    }
    */
}
