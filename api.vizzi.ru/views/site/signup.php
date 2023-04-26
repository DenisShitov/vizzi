<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
 
$this->title = 'Регистрация';
//$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="container">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <?php $form = ActiveForm::begin([
        'id' => 'form-signup',
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
                <h3>Для регистрации введите данные:</h3><br/>
                <?php //= $form->field($model, 'username')->textInput(['autofocus' => true])->label("Логин") ?>			
                <?= $form->field($model, 'email')->label("E-mail") ?>
				<?= $form->field($model, 'name')->label("Имя") ?>

                <?= $form->field($model, 'password')->passwordInput()->label("Пароль") ?>
				
				

		<?php /*= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="col-lg-7" title="Кликните чтобы обновить">{image}</div><div class="col-lg-5 captcha_input">{input}</div>',
			'captchaAction' => 'app/captcha'
        ])->label("Введите проверочный код") */ ?>
				
                <div class="form-footer">
                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-success btn-block', 'name' => 'signup-button']) ?>
				</div>
				</div>
				</div>

            <?php ActiveForm::end(); ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt20 text-center text-muted">
                Уже зарегистрированы? <a href="/site/login">Войдите</a>
              </div>
            </div>
            </div>