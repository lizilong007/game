<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="text/css">
	.content {

	}
	.blod-font {
		font-weight: bold;
		font-size: 110%;
	}
	.normal-font {
		/*color: #565555;*/
	}
	.row-group {
		margin: 3rem 0;
	}
	.row {
		margin: 1rem;
	}
	.group-font {
		
	}
	.group-font-left {
		margin-right: 5px;
	}
	.group-font-right {

	}
	.match-detail {
		margin-bottom: 5rem;
	}
	.success-font {
		color: rgb(0, 204, 153);
	}
	.fail-font {
		color: rgb(204, 0, 51);
	}
</style>
</head>
<body>
<?php $this->beginBody() ?>


<div class="wrap">
    <div class="container">
        <?= $content ?>
    </div>
</div>


<?php $this->endBody() ?>
<script src="/js/jquery.json-viewer/json-viewer/jquery.json-viewer.js"></script>
</body>
</html>
<?php $this->endPage() ?>
