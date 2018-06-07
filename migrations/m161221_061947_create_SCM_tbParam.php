<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class SCM_tbParam 参数主表
 */
class m161221_061947_create_SCM_tbParam extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('SCM_tbParam', [
            'fsParamId' => 'VARCHAR(30) NOT NULL', // 参数代码
            'fsParamName' => 'VARCHAR(50) NOT NULL', // 参数名称
            'fsNote' => 'VARCHAR(10)', // 备注
            'fiParamCls'=>$this->smallInteger(4), // 参数类型;0=整体/1=点菜/2=收银/3=打印服务/10=采购/11=库存/12=结算/13=生产/14=助手
            'fsFoodTradeList'=>$this->smallInteger(4), // 餐饮业态号;1=中式快餐 / 2=中式正餐
            'fsUpdateTime' => $this->dateTime(),   // 修改日期时间
            'CONSTRAINT SCM_tbParam PRIMARY KEY("fsParamId")'
        ]);
        $this->addCommentOnColumn('SCM_tbParam', 'fsParamId', '参数代码');
        $this->addCommentOnColumn('SCM_tbParam', 'fsParamName', '参数名称');
        $this->addCommentOnColumn('SCM_tbParam', 'fsNote', '备注');
        $this->addCommentOnColumn('SCM_tbParam', 'fiParamCls', '参数类型;0=整体/1=点菜/2=收银/3=打印服务/10=采购/11=库存/12=结算/13=生产/14=助手');
        $this->addCommentOnColumn('SCM_tbParam', 'fsFoodTradeList', '餐饮业态号;1=中式快餐 / 2=中式正餐 ');
        $this->addCommentOnColumn('SCM_tbParam', 'fsUpdateTime', '修改日期时间');

        $this->addCommentOnTable('SCM_tbParam', '参数主表');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('SCM_tbParam');
    }
}
