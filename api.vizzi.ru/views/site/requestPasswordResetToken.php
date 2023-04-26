<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 
$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
 
<div class="site-request-password-reset">
    <p>Пожалуйста, введите Ваш e-mail. На него будет отправлена инструкция по сбросу Вашего пароля.</p>
    <div class="row">
 
    <?php $form = ActiveForm::begin([
        'id' => 'request-password-reset-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>			
			
                <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('E-mail') ?>
                <div class="form-group">
				<div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Готово', ['class' => 'btn btn-default']) ?>
                </div>
				</div>
            <?php ActiveForm::end(); ?>

    </div>
</div>