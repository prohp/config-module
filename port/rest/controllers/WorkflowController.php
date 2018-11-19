<?php
namespace app\modules\config\port\rest\controllers;

use app\common\filters\QueryParamAuth;
use app\common\rest\Controller;
use app\common\widgets\ActiveForm;
use app\modules\config\application\WorkflowServiceInterface;
use app\modules\config\models\form\Workflow as WorkflowForm;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * Class WorkflowController
 * 
 */
class WorkflowController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'authenticator' => [
                'class' => QueryParamAuth::class,
                'isSession' => false,
                'optional' => [
                    '*',
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function () {
                    throw new ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
                }
            ],
        ]);
    }

    /**
     * @var WorkflowServiceInterface
     */
    public $workflowService;

    public function __construct($id, $module, WorkflowServiceInterface $workflowManager, array $config = [])
    {
        $this->workflowService = $workflowManager;
        parent::__construct($id, $module, $config);
    }

    public function actionValidateCreate()
    {
        $workflowForm = new WorkflowForm([
            'scenario' => 'create'
        ]);
        $workflowForm->load(\Yii::$app->getRequest()->getBodyParams());
        return $this->asJson(ActiveForm::validate($workflowForm));
    }

    public function actionCreate()
    {
        $workflowForm = new WorkflowForm([
            'scenario' => 'create',
        ]);
        $workflowForm->load(\Yii::$app->getRequest()->getBodyParams());
        return $this->asJson($this->workflowService->createWorkflow($workflowForm));
    }

    public function actionValidateUpdate($id)
    {
        $workflowForm = new WorkflowForm([
            'scenario' => 'update'
        ]);
        $workflowForm->load(\Yii::$app->getRequest()->getBodyParams());
        $workflowForm->id = $id;
        return $this->asJson(ActiveForm::validate($workflowForm));
    }

    public function actionUpdate($id)
    {
        $workflowForm = new WorkflowForm([
            'scenario' => 'create',
        ]);
        $workflowForm->load(\Yii::$app->getRequest()->getBodyParams());
        $workflowForm->id = $id;
        return $this->asJson($this->workflowService->updateWorkflow($workflowForm));
    }
}
