<?php

namespace app\modules\swagger\assets;

class SwaggerAssetBundle extends \yii\web\AssetBundle
{
	public $sourcePath = '@vendor/swagger-api/swagger-ui/dist';
	
	public $css = [
		'swagger-ui.css',
	];
	
	public $js = [
		'swagger-ui-bundle.js',
		'swagger-ui-standalone-preset.js',
	];
}
