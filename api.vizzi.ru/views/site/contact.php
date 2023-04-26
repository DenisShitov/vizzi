<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

use app\models\Contact;

if (Yii::$app->user->identity) {
$user_email = Yii::$app->user->identity->email;
$typeuser = Yii::$app->user->identity->typeuser;
$user_name = Yii::$app->user->identity->name;
}

$act = isset($_GET['act']) ? $_GET['act'] : null;

if ($act == 'faq') {
$this->title = 'FAQ';
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">
<?php
if ($typeuser == 1) {
	include(Yii::getAlias('@app/views/app/parts/FAQ.php'));
}
if ($typeuser == 2) {
	include(Yii::getAlias('@app/views/app/parts/FAQ2.php'));
}
?>
</div>
</div>

<?php } else {
$this->title = 'Поддержка';
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) { ?>

        <div class="alert alert-success">
            Спасибо за Ваше обращение! Скоро мы с Вами свяжемся.<br/><br/>
			<a href="/app/contact?act=faq" class="btn btn-default">FAQ</a> <a href="/" class="btn btn-default">Главная</a>
        </div>

    <?php } else { ?>

        <p>
		Если у Вас возникли вопросы или затруднения, пожалуйста напишите нам.<br>Специалист технической поддержки свяжется с Вами при первой возможности.
		</p>


    <?php
	// ActiveForm is begin
	$form = ActiveForm::begin([
        'id' => 'contact-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
			'template' => '<div class="form-group"><label class="form-label">{label}</label>{input}<div class="col-lg-12">{error}</div></div>',
            'labelOptions' => ['class' => 'form-label'],
        ],
		]);
	?>
				<div class="col-lg-6 col-md-6">
					<?php if ($act == 'manager') { ?>
					<div class="form-group"><label class="form-label">Тема обращения</label>
					<input type="text" class="form-control" value="Сообщение менеджеру" disabled="">
					</div>
					<?= $form->field($model, 'theme')->label(false)->hiddenInput(['value' => 'manager']); ?>
					<?= $form->field($model, 'msg')->textarea(['rows' => 6, 'autofocus' => true])->label('Ваше сообщение') ?>
					<?php } else { ?>
                    <?= $form->field($model, 'theme')->textInput(['autofocus' => true])->label('Тема обращения') ?>
					<?= $form->field($model, 'msg')->textarea(['rows' => 6])->label('Ваше сообщение') ?>
					<?php } ?>
						<?php
						/*
						=$form->field($model, 'theme')
							->dropDownList([
							'0' => 'Ошибка в работе сервиса',
							'1' => 'Жалоба на пользователя',
							'2' => 'Восстановление доступа',
							'3' => 'Другой вопрос',	
							])->label('Тема обращения');
							*/
						?>					
				

				<div class="col-lg-6 col-md-6">
					<div id="auth_data">
					<?= $form->field($model, 'name')->label('Ваше имя') ?>
                    <?= $form->field($model, 'email')->label('Контактный e-mail') ?>
					</div>
					<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
						'template' => '<div class="col-lg-6" title="Кликните чтобы обновить">{image}</div><div class="col-lg-6 captcha_input">{input}</div>',
						'captchaAction' => Url::to('app/captcha') //'/app/captcha'
					])->label("Введите проверочный код") ?>
				

				<?= Html::submitButton('Отправить сообщение', ['class' => 'btn btn-primary mb40', 'name' => 'contact-button']) ?>

				</div></div>
				
				<div class="col-lg-6 col-md-6">
					<?php
					if ($typeuser == 1) {
						include(Yii::getAlias('@app/views/app/parts/FAQ.php'));
					}
					if ($typeuser == 2) {
						include(Yii::getAlias('@app/views/app/parts/FAQ2.php'));
					}
					?>
				</div>				

                <?php ActiveForm::end(); ?>
<?php
// Yii::$app->user->
if (!Yii::$app->user->isGuest) {
$script088 = <<< JS
$('#contact-email').val('$user_email');
$('#contact-name').val('$user_name');
$('#auth_data').hide();

//$('.field-contact-name').hide();
//$('.field-contact-email').hide();
JS;
$this->registerJs($script088, yii\web\View::POS_READY);
}
?>

<?php } ?>

</div>
</div>

<?php
} 
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.mb40 {
	margin-bottom:40px;
}
</style>