<?php
namespace app\modules\config\models\orm;

use app\common\db\ActiveRecord;

/**
 * Class WorkflowEntity
 * 
 *
 * @author Dzhamal Tayibov
 */
class WorkflowEntity extends ActiveRecord
{
    public function getWorkflow()
    {
        return $this->hasOne(Workflow::class, ['id' => 'workflow_id']);
    }
}
