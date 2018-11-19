<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `notification`.
 */
class m181002_113601_create_notification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createBothTables('{{%notification}}', [
            'type' => $this->smallInteger(),
            'status' => $this->smallInteger(),
            'to' => $this->string(),
            'message' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropBothTables('{{%notification}}');
    }
}
