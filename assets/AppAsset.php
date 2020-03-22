<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        ['template_assets/batgfavicon.png', 'rel' => 'shortcut icon'],
    ];
    public $js = [
        'js/popper.min.js',
        //['https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', 'integrity'=>'sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl', 'crossorigin'=>'anonymous'],
        'js/bootstrap.min.js',
        'template_assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js',
        'template_assets/plugins/blockUI/jquery.blockUI.js',
        'template_assets/plugins/bootbox/bootbox.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'marcelodeandrade\material\BootstrapMaterialDesignInitAsset'
    ];
}
