<?php
namespace app\modules\config\assets;

use app\common\web\AssetBundle;

/**
 * Class DirectoryAsset
 * 
 *
 * @author Dzhamal Tayibov
 */
class ConfigAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/config/resources';
    public $js = [
        'js/directory.js',
        'js/workflow.js',
    ];
    public $css = [
        'css/directory.css',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
