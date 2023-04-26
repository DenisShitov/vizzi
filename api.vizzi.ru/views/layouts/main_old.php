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
$ava = Yii::$app->user->identity->ava;
$coins = Yii::$app->user->identity->coins;
$rating = Yii::$app->user->identity->rating;
$user_type = Yii::$app->user->identity->typeuser;
$user_active = Yii::$app->user->identity->active;
} else {
	$ava = '';
}


if ($ava == '') {
	$ava = 'https://via.placeholder.com/250';
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
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:300,400,700&amp;subset=cyrillic" rel="stylesheet" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/assets/css/dashboard.css" rel="stylesheet" />
    <link href="/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
	<script src="/assets/plugins/charts-c3/js/d3.v3.min.js"></script>
	<script src="/assets/plugins/charts-c3/js/c3.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
    <link href="/assets/css/animate.min.css" rel="stylesheet" />
</head>
<body>

<?php $this->beginBody() ?>

<div class="loading">
<div class="loading-cnt"><div class="loading-text"></div>
<div class="loader"></div></div>
</div>

    <div class="page">
      <div class="page-main">
        <div class="<? if (Yii::$app->user->isGuest) { echo 'header'; } else { echo 'header-standart'; } ?> py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="/">
                <i class="fa fa-rocket rockets" style="transform:rotate(-45deg);font-size:14px;"></i> Firestarter
              </a>
			  <?php 
			  if (Yii::$app->user->isGuest) { ?>
              <div class="d-flex order-lg-2 ml-auto">
                <div class="nav-item d-none d-md-flex">
                </div>
                <div class="dropdown d-none d-md-flex">
				  <a class="nav-link btn btn-default" href="/app/login">
                    Вход
                  </a>&nbsp;
				  <a class="nav-link btn btn-primary" href="/app/signup">
                    Регистрация
                  </a>
				</div>
				</div>
				  
			  <? } else { ?>
              <div class="d-flex order-lg-2 ml-auto">
                <div class="nav-item d-none d-md-flex">
                </div>
                <div class="dropdown d-none d-md-flex">
				  <a class="nav-link icon" id="coins" href="/coins/" title="Коины">
                    <span><? echo $coins; ?></span>&nbsp;<i class="fe fe-disc"></i>
                  </a>
                  <a class="nav-link icon" title="Уведомления" data-toggle="dropdown">
                    <i class="fe fe-bell"></i>
                    <span class="nav-unread dn"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" id="alerts_exit">
					<? include(Yii::getAlias('@app/views/layouts/parts/alerts.php')); ?>
<?
$script01 = <<< JS
	var msg_len = $('#alerts_exit .alert-block').length;
	console.log(msg_len);
	if (msg_len > 0) {
		$('.nav-unread').fadeIn();
	}
JS;
$this->registerJs($script01, yii\web\View::POS_READY);
?>
                  </div>
                </div>
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url(<? echo $ava; ?>)"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default"><? echo $name; ?></span>
                      <small class="text-muted d-block mt-1">
					  <? if ($user_type == 1) { echo 'Рекламодатель'; } ?>
					  <? if ($user_type == 2) { echo 'Блогер'; } ?>
					  </small>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
				<? if ($user_type == 2) { ?>
                    <a class="dropdown-item" href="/rating/">
                      <i class="dropdown-icon fe fe-arrow-up-right"></i> Ваш рейтинг: <? echo $rating; ?>
                    </a>
				<? } ?>
                    <a class="dropdown-item" href="/user/">
                      <i class="dropdown-icon fe fe-settings"></i> Настройки
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/app/contact">
                      <i class="dropdown-icon fe fe-help-circle"></i> Поддержка
                    </a>					
					<?
					echo 
					Html::beginForm(['/app/logout'], 'post')
					. Html::submitButton(
					'<i class="dropdown-icon fe fe-log-out"></i> Выход',
					['class' => 'dropdown-item']
					)
					. Html::endForm();
					?>
                  </div>
                </div>
              </div>
			  <? } ?>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>

<?php
if (Yii::$app->user->isGuest) {
				  
}
else {

if ($user_type == 1) {
include(Yii::getAlias('@app/views/layouts/parts/prmenu.php'));
}
if ($user_type == 2) {
include(Yii::getAlias('@app/views/layouts/parts/blogermenu.php'));
}

}
?>

<!-- main_content -->		
	<div class="my-3 my-md-5 page-content mb0 <? if($booster == '' && Yii::$app->user->isGuest) { echo 'mt0'; } ?>">
	<div class="container">
	<?= 
	Breadcrumbs::widget([
      'homeLink' => [ 
                      'label' => Yii::t('yii', 'Главная'),
                      'url' => Yii::$app->homeUrl,
                 ],
      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) 
	?>
	</div>
            <div class="row">
			<?= $content ?>
			</div>
	</div>
<!-- main_content -->		
		

      <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
              <div class="row align-items-center">
                <div class="col-auto">
                  <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a href="#">Политика конфиденциальности</a></li>
                    <li class="list-inline-item"><a href="#">Пользовательское соглашение</a></li>
                  </ul>
                </div>
                <div class="col-auto">
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              © 2018-2019 <a href=".">VelaBlog</a>
            </div>
          </div>
        </div>
      </footer>
    </div>	

<?php $this->endBody() ?>
<script src="/assets/js/vendors/bootstrap.bundle.min.js"></script>
<script src="/assets/js/vendors/selectize.min.js"></script>
<script src="/assets/js/pace.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/moment.js"></script>
<script src="/assets/js/vendors/popup.js"></script>
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>
<?php $this->endPage() ?>
