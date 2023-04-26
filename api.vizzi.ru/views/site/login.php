<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Console;
use yii\captcha\Captcha;

$this->title = 'Авторизация';
//$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="container">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => '<div class="form-group">
			<label class="form-label">{label}</label>
			{input}</div><div class="col-lg-12">{error}</div>',
			'labelOptions' => ['class' => ''],
        ],
    ]); ?>
				<div class="card">
                <div class="card-body p-6">
                  <h3>Для входа введите данные:</h3><br/>
		<?= $form->field($model, 'email')->textInput(['autofocus' => true])->label("E-mail") ?>
		<?= $form->field($model, 'password')->passwordInput()->label("Пароль") ?>
		
		<?php /*= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="col-lg-6" title="Кликните для обновления кода">{image}</div><div class="col-lg-6 captcha_input">{input}</div>',
			'captchaAction' => 'app/captcha'
        ])->label("Введите код с картинки:") */ ?>
		
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => '<div class="form-group">
			<label class="custom-control custom-checkbox">{input}
			<span class="custom-control-label">{label}</span></label>
			</div><div class="col-lg-12">{error}</div>',
			'class' => 'custom-control-input'
        ])->label("Запомнить меня") ?>
                  <div class="form-footer">
				  <?= Html::submitButton('Войти', ['class' => 'btn btn-success btn-block', 'name' => 'login-button']) ?>
                  </div>
                </div>
				</div>
		<?php ActiveForm::end(); ?>
              <?php /* <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt20 text-center text-muted">
                <p>Не зарегистрированы? <a href="/site/signup">Регистрация</a></p>
              </div> */ ?>
            </div>
            </div>