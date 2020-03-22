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
class AdminAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        //Google Fonts
        ['https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext','type'=>'text/css'],
        ['https://fonts.googleapis.com/icon?family=Material+Icons','type'=>'text/css'],
        //Bootstrap Core Css
        //'admin_assets/plugins/bootstrap/css/bootstrap.css',
        //Waves Effect Css
        'admin_assets/plugins/node-waves/waves.css',
        //Animation Css
        'admin_assets/plugins/animate-css/animate.css',
        //Morris Chart Css
        'admin_assets/plugins/morrisjs/morris.css',
        //Custom Css
        'admin_assets/css/style.css',
        //AdminBSB Themes. You can choose a theme from css/themes instead of get all themes
        'admin_assets/css/themes/all-themes.css',
        ['template_assets/batgfavicon.png', 'rel' => 'shortcut icon'],

    ];
    public $js = [
        'admin_assets/plugins/bootstrap/js/bootstrap.js',
        //Slimscroll Plugin Js
        'admin_assets/plugins/jquery-slimscroll/jquery.slimscroll.js',
        //Waves Effect Plugin Js
        'admin_assets/plugins/node-waves/waves.js',
        //Jquery CountTo Plugin Js
        'admin_assets/plugins/jquery-countto/jquery.countTo.js',
        //Morris Plugin Js
        'admin_assets/plugins/raphael/raphael.min.js',
        'admin_assets/plugins/morrisjs/morris.js',
        //ChartJs
        'admin_assets/plugins/chartjs/Chart.bundle.js',
        //Flot Charts Plugin Js
        'admin_assets/plugins/flot-charts/jquery.flot.js',
        'admin_assets/plugins/flot-charts/jquery.flot.resize.js',
        'admin_assets/plugins/flot-charts/jquery.flot.pie.js',
        'admin_assets/plugins/flot-charts/jquery.flot.categories.js',
        'admin_assets/plugins/flot-charts/jquery.flot.time.js',
        //Sparkline Chart Plugin Js
        'admin_assets/plugins/jquery-sparkline/jquery.sparkline.js',
        //Custom Js
        'admin_assets/js/admin.js',
        'admin_assets/js/pages/index.js',
        //Demo Js
        'admin_assets/js/demo.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'marcelodeandrade\material\BootstrapMaterialDesignInitAsset'
    ];
}
