<?php
namespace app\modules\config\port\ui\controllers;

use app\common\web\Controller;

/**
 * Class WorkflowStatusController
 * 
 *
 * @author Dzhamal Tayibov
 */
class WorkflowStatusController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
