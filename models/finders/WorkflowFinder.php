<?php
namespace app\modules\config\models\finders;

use app\common\base\Model;

/**
 * Class WorkflowFinder
 * 
 */
class WorkflowFinder extends Model
{
    public $ormClass;
    public $name;
    public $type;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ ['ormClass', 'name'], 'string' ],
            [ ['type'], 'integer' ]
        ];
    }
}
