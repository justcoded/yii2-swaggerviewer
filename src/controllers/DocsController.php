<?php

namespace app\modules\swagger\controllers;

use app\controllers\Controller;

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
	 */
	public function actionSpecs()
	{
		
		return $this->render('yaml');
	}
}