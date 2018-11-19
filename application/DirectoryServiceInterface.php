<?php
namespace app\modules\config\application;

use yii\data\DataProviderInterface;

/**
 * Class DirectoryServiceInterface
 * 
 */
interface DirectoryServiceInterface
{
    /**
     * @return DataProviderInterface
     */
    public function getDirectoryList();
}
