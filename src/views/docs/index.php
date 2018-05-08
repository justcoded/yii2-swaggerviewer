<?php
/**
 * @var \yii\web\View $this
 */

use justcoded\yii2\swaggerviewer\assets\SwaggerAssetBundle;
use yii\helpers\Html;
use yii\helpers\Url;

$this->context->layout = false;
$this->title  = 'Swagger Viewer';

$swaggerAssets = SwaggerAssetBundle::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Source+Code+Pro:300,600|Titillium+Web:400,600,700" rel="stylesheet">

	<?php $this->head(); ?>
	
	<style>
		html
		{
			box-sizing: border-box;
			overflow: -moz-scrollbars-vertical;
			overflow-y: scroll;
		}

		*,
		*:before,
		*:after
		{
			box-sizing: inherit;
		}

		body
		{
			margin:0;
			background: #fafafa;
		}
	</style>
</head>

<body>
<?php $this->beginBody() ?>
<div id="swagger-ui"></div>

<script>
  window.onload = function() {

    // Build a system
    const ui = SwaggerUIBundle({
      url: "<?php echo Url::to(['docs/specs'], true); ?>",
      dom_id: '#swagger-ui'
    })

    window.ui = ui
  }
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>