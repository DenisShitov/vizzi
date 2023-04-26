<?php
$pathinfo = Yii::$app->request->pathInfo; 
?>

<section id="block_head" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 <?php if ($pathinfo != '') { echo'block-head__alt'; } ?>">
<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 head-icons">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gen-partner animate__animated animate__fadeInLeft">
	<a href="/" style="font-size:30px;">BOOKING</a>
</div>

</div>
</div>



					<?php /*
					echo 
					Html::beginForm(['/app/logout'], 'post')
					. Html::submitButton(
					'<i class="dropdown-icon fe fe-log-out"></i> Выход',
					['class' => 'dropdown-item']
					)
					. Html::endForm(); */
					?>


<div class="navbar navbar-inverse animate__animated animate__fadeIn animate__delay-1s" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-act="0" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar ib1"></span>
            <span class="icon-bar ib2"></span>
            <span class="icon-bar ib3"></span>
          </button>
        </div>

<!-- Каталог лагерей  О нас  Как купить  Контакты -->
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav animate__animated animate__fadeIn" style="float:right;">
            <li class="alt"><a href="/user/">Личный кабинет</a></li>
          </ul>
        </div>
      </div>
</div>

<?php
if ($pathinfo == '') {
	include(Yii::getAlias('@app/views/layouts/parts/filter_main.php')); 
}
?>
</section>