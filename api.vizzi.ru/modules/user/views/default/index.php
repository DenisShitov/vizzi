<?
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Личный кабинет';

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;	
$email = Yii::$app->user->identity->email;
$typeuser = Yii::$app->user->identity->typeuser;
}

$act = isset($_GET['act']) ? $_GET['act'] : null;
//brand_name
//brand_desc
//brand_site
?>

<style>
.upload-ava {
	vertical-align:top;
}
.upload-ava button {
    vertical-align: top;
    margin-top: 32px;	
}
.field-uploadfile-image {
	display:inline-block;
}
.field-uploadfile-image input[type="file"] {
	border:1px solid #ccc;
	border-radius:5px;
	padding:5px;
	display:none;
}

.ava_preview {
    width: 100px;
    height: 100px;
	display:inline-block;
	position: relative;
    border: 1px solid #e0e5ec;
    background-size: cover !important;
	transition:1s all;
	text-align:center;
    background-position: center !important;
}

.has-success .ava_preview {
    background: #75d66f !important;
    position: relative;
	color: #75d66f !important;
}
.ava_preview:hover {
	opacity:0.8;
	transition:1s all;
}
.ava_preview:hover:before {
	content:"\e9ed";
	transition:1s all;
    font-family: 'feather' !important;
    speak: none;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    font-size: 30px;
    color: #fff;
    text-shadow: 0 0 10px rgba(0,0,0,0.9);	
    top: 30px;
    position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    -webkit-font-smoothing: antialiased;	
}

.field-uploadfile-image .btn {
	visibility:hidden;
}
.field-uploadfile-image.has-success  .btn {
	visibility:visible;
}


.has-success .ava_preview:before {
	content: "\e92a";
    font-family: 'feather' !important;
    speak: none;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    font-size: 30px;
    color: #fff;
    top: 30px;
    position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    -webkit-font-smoothing: antialiased;	
}

.field-uploadfile-image .help-block {
    font-size: 12px;
    max-width: 200px;	
}
</style>

<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-title">
	<h3>Личный кабинет</h3> 
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">Информация</a></li>
    <li role="presentation"><a href="#favorites" aria-controls="favorites" role="tab" data-toggle="tab">Избранное</a></li>
  </ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="general">
			<p><u>Ваш email:</u> <?php echo $email; ?></p>
			<p><button class="btn btn-default btn-sm" disabled title="В данный момент не доступно.">Изменить email</button> <button class="btn btn-default btn-sm" disabled title="В данный момент не доступно.">Изменить пароль</button></p>
					<?php
					echo 
					Html::beginForm(['/app/logout'], 'post')
					. Html::submitButton(
					'Выход',
					['class' => 'btn btn-danger']
					)
					. Html::endForm();
					?>
		</div>
		<div role="tabpanel" class="tab-pane" id="favorites">
			<p>В избранное ничего не добавлено.</p>
			
		</div>
	</div>	
		
</div>
</div>


<?
$script0 = <<< JS

JS;
$this->registerJs($script0, yii\web\View::POS_READY);
?>