<?php

namespace justcoded\yii2\swaggerviewer\assets;

class SwaggerAssetBundle extends \yii\web\AssetBundle
{
	/**
	 * @inheritdoc
	 * @var string
	 */
	public $sourcePath = '@vendor/swagger-api/swagger-ui/dist';

	/**
	 * @inheritdoc
	 * @var array
	 */
	public $css = [
		'swagger-ui.css',
	];

	/**
	 * @inheritdoc
	 * @var array
	 */
	public $js = [
		'swagger-ui-bundle.js',
		'swagger-ui-standalone-preset.js',
	];
}
