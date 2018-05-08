<?php

namespace justcoded\yii2\swaggerviewer;


use yii\base\InvalidConfigException;

class Module extends \yii\base\Module
{
	/**
	 * Path/Alias to yaml files location
	 *
	 * @var string
	 */
	public $docsPath;

	/**
	 * API docs are broken into several yaml files
	 *
	 * @var bool
	 */
	public $multiDoc = true;

	/**
	 * Provide as a yaml copy with faker-generated models data as external docs.
	 *
	 * @var bool
	 */
	public $fakerCopy = true;

	/**
	 * Number of faked items to generate.
	 *
	 * @var int
	 */
	public $fakerNum = 10;

	/**
	 * @inheritdoc
	 * @var string
	 */
	public $defaultRoute = 'docs/index';

	/**
	 * @inheritdoc
	 * @throws InvalidConfigException Bad docsPath property configuration.
	 */
	public function init()
	{
		parent::init();

		$filename = \Yii::getAlias($this->docsPath);
		if (! is_file($filename)) {
			throw new InvalidConfigException("SwaggerViewer Module configuration is wrong. Api doc file is invalid: $filename");
		}
	}

}
