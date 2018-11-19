<?php
namespace app\modules\config\port\ui\controllers;

use app\common\web\Controller;

/**
 * Class WorkflowController
 *
 *
 * @author Dzhamal Tayibov
 */
class WorkflowController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id = null)
    {
        return $this->render('view', ['workflowId' => $id]);
    }
}
