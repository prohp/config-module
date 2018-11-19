<?php
namespace app\modules\config\models\form;

use app\common\base\Model;
use app\modules\config\models\orm\Workflow as WorkflowORM;
use yii\db\ActiveQueryInterface;

/**
 * Class Workflow
 * 
 *
 * @author Dzhamal Tayibov
 */
class Workflow extends Model
{
    public $id;
    public $orm_module;
    public $orm_class;
    public $name;
    public $type;
    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ ['orm_module', 'orm_class', 'name', 'status'], 'required' ],
            [ ['orm_module', 'orm_class'], 'string' ],
            [ 'name', 'string', 'max' => 255 ],
            [ ['type', 'status'], 'integer' ],
            [ 'type', 'default', 'value' => WorkflowORM::TYPE_COMMON ],
            [ 'status', 'default', 'value' => WorkflowORM::STATUS_UPDATING ],
            [ ['orm_class'],
                'unique',
                'targetClass' => WorkflowORM::class,
                'targetAttribute' => ['orm_module', 'orm_class', 'status'],
                'filter' => function (ActiveQueryInterface $query) {
                    return $query
                        ->andWhere([
                            '<>',
                            'status',
                            WorkflowORM::STATUS_ARCHIVE, // смотрим unique только у активных воркфлоу
                        ])
                        ->andFilterWhere([
                            '<>',
                            'id',
                            $this->id
                        ])
                        ->notDeleted();
                }, ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orm_module' => 'Модуль',
            'orm_class' => 'ORM',
            'name' => 'Имя',
            'type' => 'Тип',
            'status' => 'Статус',
        ];
    }
}
