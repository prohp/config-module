<?php
namespace app\modules\config\entities;

/**
 * Class DirectoryEntity
 *
 *
 * 
 */
class DirectoryEntity
{
    /**
     * @param string $key
     * @return array
     */
    public function findDirectory($key = null)
    {
        $config = \Yii::$app->configManager->findOne('directories');
        if (empty($config) || empty($config['value'])) {
            return null;
        }
        if (empty($key)) {
            return $config['value'];
        }
        foreach ($config['value'] as $row) {
            if (isset($row['key']) && $row['key'] === $key) {
                return $row;
            }
        }

        return null;
    }
}
