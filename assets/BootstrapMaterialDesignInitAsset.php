<?php

namespace app\assets;

use yii\web\AssetBundle;

class BootstrapMaterialDesignInitAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

	public $css = [];

	public $js = [	
		'js/material.init.js'
	];

    public $depends = [
        'app\assets\BootstrapMaterialDesignAsset'
    ];

}