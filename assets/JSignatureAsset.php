<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 14/10/2018
 * Time: 15:50
 */

namespace app\assets;


use yii\web\AssetBundle;

class JSignatureAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        ['template_assets/batgfavicon.png', 'rel' => 'shortcut icon'],
    ];
    public $js = [
        'signaturef/libs/modernizr.js',
        'signaturef/libs/jSignature.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AppAsset'
    ];
}