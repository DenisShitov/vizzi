<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

use app\models\ReportErrors;

if (Yii::$app->user->identity) {
$user_email = Yii::$app->user->identity->email;
$user_name = Yii::$app->user->identity->name;
}

$prepage = isset($_GET['pp']) ? $_GET['pp'] : null;
if ($prepage == '') {
	$prepage = '\report';
}

$this->title = 'Сообщить об ошибке';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb40">
	<div class="container">
	
	<h2>Репорт</h2>

    <?php if (Yii::$app->session->hasFlash('reportFormSubmitted')) { ?>

        <div class="alert alert-success">
            <? echo $user_name; ?>, спасибо за Ваше сообщение!
        </div>

    <?php } else { ?>

        <p>
		Благодарим Вас за содействие. Вы делаете доброе дело.<br/>Пожалуйста, опишите замеченную Вами ошибку, мы постараемся все исправить в ближайшее время. Спасибо!
		</p>


    <?php $form = ActiveForm::begin([
        'id' => 'report-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
			'template' => '<div class="form-group"><label class="form-label">{label}</label>{input}<div class="col-lg-12">{error}</div></div>',
            'labelOptions' => ['class' => 'form-label'],
        ],
    ]); ?>
				<div class="col-lg-12 col-md-12">
					<?= $form->field($model, 'page')->label(false)->hiddenInput(['value' => $prepage]); ?>
					<?= $form->field($model, 'text')->textarea(['rows' => 6, 'autofocus' => true])->label('Описание ошибки') ?>
				</div>
				<div class="col-lg-6 col-md-6">
					<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
						'template' => '<div class="col-lg-4" title="Кликните чтобы обновить">{image}</div><div class="col-lg-4 captcha_input">{input}</div>',
						'captchaAction' => Url::to('app/captcha') //'/app/captcha'
					])->label("Введите проверочный код") ?>
				</div>
				<div class="col-lg-12 col-md-12 text-center">
				<?= Html::submitButton('Отправить репорт', ['class' => 'btn btn-primary', 'name' => 'report-button']) ?>
				<button class="btn btn-default" type="button" onclick="history.back();">Вернуться назад</button>
				</div>
                <?php ActiveForm::end(); ?>

<?php } ?>

</div>
</div>