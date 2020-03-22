<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 14/10/2018
 * Time: 15:50
 */

namespace app\assets;


use yii\web\AssetBundle;

class NiveauValidAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/materialIcon.css',
        'md_assets/full/assets/css/preload.min.css',
        'md_assets/full/assets/css/plugins.min.css',
        'md_assets/full/assets/css/style.light-blue-500.min.css',
        ['md_assets/full/assets/css/width-boxed.min.css','id'=>'ms-boxed','disabled'=>''],
        //['https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', 'integrity'=>'sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm','crossorigin'=>'anonymous'],
        'css/fontawesome.min.css',
        'css/prettify.min.css',
        'pdfjsf/styles.css',
        'pdfjsf/pdfannotate.css',
        ['template_assets/batgfavicon.png', 'rel' => 'shortcut icon'],
    ];
    public $js = [

        'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js',
        'js/popper.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.328/pdf.min.js',
        'js/fabric.min.js',
        'jsPDF/dist/jspdf.debug.js',
        'js/run_prettify.js',
        'js/prettify.min.js',
        'pdfjsf/arrow.fabric.js',

    ];
    public $depends = [
        //'yii\web\YiiAsset',
        'app\assets\AppAsset'
    ];
}