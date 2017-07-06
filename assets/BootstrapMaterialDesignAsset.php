<?php

namespace app\assets;

use yii\web\AssetBundle;

class BootstrapMaterialDesignAsset extends AssetBundle
{
    public $sourcePath = '@npm/bootstrap-material-design/dist';

	public $css = [
		'css/bootstrap-material-design.min.css',
		'css/ripples.min.css'
	];
	public $js = [	
        'js/material.min.js',
		'js/ripples.min.js'
	];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
    ];

}