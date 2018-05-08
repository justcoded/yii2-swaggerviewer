<?php

namespace justcoded\yii2\swaggerviewer;


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
	 * @inheritdoc
	 * @var string
	 */
	public $defaultRoute = 'docs/index';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
	}

}
