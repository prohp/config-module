<?php
namespace app\modules\config\application;

use app\common\data\ActiveDataProvider;
use app\common\helpers\ArrayHelper;
use app\common\helpers\Json;
use app\common\service\ApplicationService;
use app\common\service\exception\AccessApplicationServiceException;
use app\common\service\exception\ApplicationServiceException;
use app\modules\config\models\orm\WorkflowStatus;
use app\modules\config\models\finders\WorkflowStatusFinder;
use app\modules\config\models\form\WorkflowStatus as WorkflowStatusForm;

/**
 * Class WorkflowStatusService
 * 
 *
 * @author Dzhamal Tayibov
 */
class WorkflowStatusService extends ApplicationService implements WorkflowStatusServiceInterface
{
    public function createWorkflowStatus(WorkflowStatusForm $form)
    {
        $workflowStatus = new WorkflowStatus([
            'scenario' => 'create',
        ]);
        $workflowStatus->loadForm($form);
        if (!$workflowStatus->save()) {
            throw new ApplicationServiceException('Не удалось создать workflow status ' . Json::encode($workflowStatus->getErrors()));
        }
        return $workflowStatus;
    }

    public function updateWorkflowStatus(WorkflowStatusForm $form)
    {
        $workflowStatus = WorkflowStatus::findOneEx($form->id);
        $workflowStatus->setScenario('update');
        $workflowStatus->loadForm($form);
        if (!$workflowStatus->save()) {
            throw new ApplicationServiceException('Не удалось обновить workflow.');
        }
        return $workflowStatus;
    }

    public function getWorkflowStatusForm($raw)
    {
        $workflow = WorkflowStatus::ensureWeak($raw);
        $workflowForm = new WorkflowStatusForm();
        $workflowForm->loadAr($workflow);
        $workflowForm->id = $workflow->id;
        return $workflowForm;
    }

    public function getWorkflowStatusList(WorkflowStatusFinder $form)
    {
        if (!$this->isAllowed('getWorkflowStatusList')) {
            throw new AccessApplicationServiceException('Доступ к списку workflow status недоступен.');
        }
        $query = WorkflowStatus::find();
        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    /**
     * Не use case
     * @inheritdoc
     */
    public function getWorkflowStatusesByEntity($ormModule, $ormClass)
    {
        $records = WorkflowStatus::find()
            ->where([
                'orm_module' => $ormModule,
                'orm_class' => $ormClass,
                'status' => WorkflowStatus::STATUS_ACTIVE,
                'state_attribute' => WorkflowStatus::STATE_ATTRIBUTE_DEFAULT,
            ])
            ->notDeleted()
            ->all();
        return ArrayHelper::map($records, 'state_value', 'state_alias');
    }

    /**
     * Не use case
     * @inheritdoc
     */
    public function getStartStatusByEntity($ormModule, $ormClass)
    {
        $record = WorkflowStatus::find()
            ->where([
                'orm_module' => $ormModule,
                'orm_class' => $ormClass,
                'status' => WorkflowStatus::STATUS_ACTIVE,
                'is_start' => true,
                'state_attribute' => WorkflowStatus::STATE_ATTRIBUTE_DEFAULT,
            ])
            ->notDeleted()
            ->one();
        if (!isset($record)) {
            return null;
        }
        return $record->state_value;
    }

    /**
     * @inheritdoc
     */
    public function getPrivileges()
    {
        return [
            'getWorkflowStatusList' => 'Список статусов workflow',
        ];
    }

    /**
     * @inheritdoc
     */
    public function aclAlias()
    {
        return 'Статусы workflow';
    }
}
