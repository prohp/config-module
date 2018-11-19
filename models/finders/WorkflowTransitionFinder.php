<?php
namespace app\modules\config\models\finders;

use app\common\base\Model;
use app\common\validators\ForeignKeyValidator;

/**
 * Class WorkflowTransitionFinder
 * 
 *
 * @author Dzhamal Tayibov
 */
class WorkflowTransitionFinder extends Model
{
    public $updatedAt;
    public $workflowId;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ ['workflowId',], ForeignKeyValidator::class, ],
//            [ ['workflowId'], 'integer', 'on' => 'search' ],
            [ ['updated_at'], 'string', 'on' => 'search' ]
        ];
    }
}
