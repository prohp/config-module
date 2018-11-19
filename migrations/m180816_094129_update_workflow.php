<?php

use app\common\db\Migration;

/**
 * Class m180816_094129_update_workflow
 * @author Dzhamal Tayibov
 */
class m180816_094129_update_workflow extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createBothTables('{{%workflow_entity}}', [
            'workflow_id' => $this->foreignKeyId(),
            'entity_id' => $this->foreignKeyId(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropBothTables('{{%workflow_entity}}');
    }
}
