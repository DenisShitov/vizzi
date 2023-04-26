<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\SystemSettings;


AppAsset::register($this);

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$name = Yii::$app->user->identity->name;
$user_type = Yii::$app->user->identity->typeuser;
$user_active = Yii::$app->user->identity->active;
} 

$booster = Yii::$app->request->pathInfo;
//echo $booster;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" href="/assets0/slick.css" />
	<link rel="stylesheet" href="/assets0/slick-theme.css" />
	<link rel="stylesheet" href="/assets0/animate.css" />
	<link rel="stylesheet" href="/assets0/lightbox.min.css" />
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
</head>
<body>

<?php include(Yii::getAlias('@app/views/layouts/parts/section_block_head.php')); ?>
<?php include(Yii::getAlias('@app/views/layouts/parts/modals.php')); ?>

<?php $this->beginBody() ?>


			<?php if (Yii::$app->user->isGuest) { } ?>

                  
			<?= $content ?>


<section id="footer" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer">
<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer-item text-right">
	<p>© 2022 BOOKING</p>
</div>



</div>
</section>

<?php $this->endBody() ?>
<link rel="stylesheet" href="/assets0/default.css" />
<script src="/assets0/slick.min.js"></script>
<script src="/assets0/lightbox.min.js"></script>
<script src="/assets0/bootstrap.js"></script>
<script src="/assets0/resizable.min.js"></script>
<script src="/assets0/default.js"></script>
</body>
</html>
<?php $this->endPage() ?>
