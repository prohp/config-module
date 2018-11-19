<?php
namespace app\modules\config\models\orm;

use app\common\db\ActiveRecord;
use app\common\validators\ForeignKeyValidator;
use yii\db\ActiveQueryInterface;

/**
 * Class WorkflowTransition
 *
 *
 * @author Dzhamal Tayibov
 */
class WorkflowTransition extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ ['middleware'], 'boolean' ],
            [ ['workflow_id', 'from_id', 'to_id'], ForeignKeyValidator::class, ],
            [ ['from_id', 'to_id', 'workflow_id'], 'default', 'value' => null, ], // fix for DB exc INTEGER value
            [ ['name', 'workflow_id', 'from_id', 'to_id'], 'required', ],
//            [ ['workflow_id', 'from_id', 'to_id'], 'integer' ],
            [ ['name', 'handler_type', 'handler_method'], 'string' ],
            [ [ 'from_id', 'to_id' ],
                'unique',
                'targetAttribute' => ['workflow_id', 'from_id', 'to_id'],
                'filter' => function (ActiveQueryInterface $query) {
                    return $query
                        ->notDeleted();
                },]
        ];
    }

    public function getStatusFrom()
    {
        return $this->hasOne(WorkflowStatus::class, ['id' => 'from_id']);
    }

    public function getWorkflow()
    {
        return $this->hasOne(Workflow::class, ['id' => 'workflow_id']);
    }
    public function getStatusTo()
    {
        return $this->hasOne(WorkflowStatus::class, ['id' => 'to_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workflow_id' => 'ЖЦ',
            'name' => 'Наименование перехода',
            'from_id' => 'Начальный статус',
            'to_id' => 'Конечный статус',
            'handler_type' => 'Тип',
            'handler_method' => 'Функция',
            'middleware' => 'Middleware',
        ];
    }
}
