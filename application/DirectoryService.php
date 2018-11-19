<?php
namespace app\modules\config\application;

use app\common\service\ApplicationService;
use app\common\service\exception\AccessApplicationServiceException;
use app\modules\config\entities\DirectoryEntity;
use yii\data\ArrayDataProvider;
use yii\base\Model;

/**
 * Class DirectoryService
 * 
 */
class DirectoryService extends ApplicationService implements DirectoryServiceInterface
{
    /**
     * @inheritdoc
     */
    public function aclAlias()
    {
        return 'Справочник';
    }

    /**
     * @inheritdoc
     */
    public function getPrivileges()
    {
        return [
            'getDirectoryList' => 'Список справочников',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getDirectoryList()
    {
        if (!$this->isAllowed('getDirectoryList')) {
            throw new AccessApplicationServiceException('Доступ к списку справочников запрещен.');
        }
        $entity = new DirectoryEntity();
        $directories = $entity->findDirectory();
        $models = [];
        if (!empty($directories)) {
            foreach ($directories as $directory) {
                $row = [];
                /**
                 * @var Model $directory
                 */
                $freshRecord = ($directory['ormClass'])::find()->orderBy('updated_at DESC')->one();
                $row['label'] = $directory['label'];
                $row['key'] = $directory['key'];
                $row['ormClass'] = $directory['ormClass'];
                $row['updated_at'] = ($freshRecord && $freshRecord instanceof Model && isset($freshRecord->updated_at)) ? $freshRecord->updated_at : null;
                array_push($models, $row);
            }
        }
        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10 // TODO CONST pageSize
            ]
        ]);
    }
}
