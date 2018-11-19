<?php

use app\common\db\Migration;

/**
 * Class m170417_094358_config
 * 
*/
class m170417_094358_config extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createBothTables('{{%config}}', [
            'key' => $this->string(255)->notNull(),
            'value' => $this->text()->notNull(),
            'entity' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropBothTables('{{%config}}');
    }
}
