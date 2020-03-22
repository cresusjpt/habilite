<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jeanpaul Tossou
 * Date: 11/08/2019
 * Time: 03:18
 */
namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'https://fonts.googleapis.com/icon?family=Material+Icons',
        'css/materialIcon.css',
        'md_assets/full/assets/css/preload.min.css',
        'md_assets/full/assets/css/plugins.min.css',
        'md_assets/full/assets/css/style.light-blue-500.min.css',
        ['md_assets/full/assets/css/width-boxed.min.css','id'=>'ms-boxed','disabled'=>''],
        ['template_assets/batgfavicon.png', 'rel' => 'shortcut icon'],
    ];
    public $js = [
        //'md_assets/full/assets/js/plugins.min.js',
        'md_assets/full/assets/js/app.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'marcelodeandrade\material\BootstrapMaterialDesignInitAsset'
    ];
}

