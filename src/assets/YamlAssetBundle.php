<?php

namespace justcoded\yii2\swaggerviewer\assets;


class YamlAssetBundle extends \yii\web\AssetBundle
{
	public function init()
	{
		parent::init();
		$this->sourcePath = dirname(\Yii::getAlias(\Yii::$app->controller->module->docsPath));
	}
}