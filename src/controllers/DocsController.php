<?php

namespace justcoded\yii2\swaggerviewer\controllers;

use app\controllers\Controller;
use JustCoded\SwaggerTools\Formatter;
use JustCoded\SwaggerTools\YamlReader;
use justcoded\yii2\swaggerviewer\assets\YamlAssetBundle;
use justcoded\yii2\swaggerviewer\Module;
use yii\helpers\Url;

class DocsController extends Controller
{
	const CACHE_KEY = 'justcoded_yii2_swaggerviewer_parsed_file';

	/**
	 * @var Module
	 */
	public $module;
	
	/**
	 * Displays dashboard with some statistics.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		// TODO: make this check more smart, because we do multiple load 2 times for check and for docs load.
		$yamlUrl  = Url::to(['docs/specs'], true);
		$filename = \Yii::getAlias($this->module->docsPath);
		$reader   = new YamlReader();
		try {
			$yaml = $reader->parseMultiFile($filename);
			\Yii::$app->cache->set(self::CACHE_KEY, $yaml);
		} catch (\Exception $e) {
			$assets = YamlAssetBundle::register(\Yii::$app->view);
			$yamlUrl = $assets->baseUrl . '/' . basename($filename);
		}

		return $this->render('index', [
			'yamlUrl' => $yamlUrl,
		]);
	}

	/**
	 * Load specs, parse and render yaml specs.
	 *
	 * @return string
	 * @throws \JustCoded\SwaggerTools\Exceptions\InvalidFileException
	 */
	public function actionSpecs()
	{
		$reader   = new YamlReader();
		$filename = \Yii::getAlias($this->module->docsPath);

		if (! $yaml = \Yii::$app->cache->get(self::CACHE_KEY)) {
			if ($this->module->multiDoc) {
				$yaml = $reader->parseMultiFile($filename);
			} else {
				$content  = file_get_contents($filename);
				$yaml = $reader->parse($content);
			}
		}

		if ($this->module->fakerCopy) {
			$yaml['externalDocs'] = [
				'description' => 'Preprocessed Yaml with faker/formatter',
				'url' => Url::to(['docs/formatted'], true),
			];
		}

		$yaml = $reader->dump($yaml);

		return $this->render('yaml', [
			'yaml' => $yaml,
		]);
	}

	/**
	 * Load specs, parse and render yaml specs.
	 *
	 * @return string
	 * @throws \JustCoded\SwaggerTools\Exceptions\InvalidFileException
	 * @throws \JustCoded\SwaggerTools\Exceptions\InvalidConfigException
	 */
	public function actionFormatted()
	{
		$reader   = new YamlReader();
		$filename = \Yii::getAlias($this->module->docsPath);

		if (! $yaml = \Yii::$app->cache->get(self::CACHE_KEY)) {
			$yaml   = $reader->parseMultiFile($filename);
		}
		$yaml = Formatter::definitionsFakeEnums($yaml, $this->module->fakerNum, $this->module->fakerCleanup);
		$yaml = Formatter::definitionsRequired($yaml);

		$yaml = $reader->dump($yaml);

		return $this->render('yaml', [
			'yaml' => $yaml,
		]);
	}
}
