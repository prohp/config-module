<?php

use app\common\db\Migration;

/**
 * Class m181018_065324_workflow_transition_confirm
 */
class m181018_065324_workflow_transition_confirm extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addBothColumns('{{%workflow_transition}}', 'middleware', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropBothColumns('{{%workflow_transition}}', 'middleware');
    }
}
