<?php

namespace justcoded\yii2\swaggerviewer\controllers;

use app\controllers\Controller;
use JustCoded\SwaggerTools\Formatter;
use JustCoded\SwaggerTools\YamlReader;
use yii\helpers\Url;

class DocsController extends Controller
{
	/**
	 * Displays dashboard with some statistics.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 * Load specs, parse and render yaml specs.
	 *
	 * @return string
	 * @throws \JustCoded\SwaggerTools\Exceptions\InvalidFileException
	 */
	public function actionSpecs()
	{
		$filename = \Yii::getAlias($this->module->docsPath);

		$reader = new YamlReader();
		if ($this->module->multiDoc) {
			$yaml = $reader->parseMultiFile($filename);
		} else {
			$content  = file_get_contents($filename);
			$yaml = $reader->parse($content);
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
		$filename = \Yii::getAlias($this->module->docsPath);

		$reader = new YamlReader();
		$yaml = $reader->parseMultiFile($filename);
		$yaml = Formatter::definitionsFakeEnums($yaml, $this->module->fakerNum);
		$yaml = Formatter::definitionsRequired($yaml);

		$yaml = $reader->dump($yaml);
		
		return $this->render('yaml', [
			'yaml' => $yaml,
		]);
	}
}
