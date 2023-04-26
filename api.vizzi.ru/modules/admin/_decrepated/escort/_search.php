<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AdvertSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advert-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'geo') ?>

    <?= $form->field($model, 'target') ?>

    <?= $form->field($model, 'goodservice') ?>

    <?= $form->field($model, 'cost_pr') ?>

    <?php // echo $form->field($model, 'net_pr') ?>

    <?php // echo $form->field($model, 'concurent') ?>

    <?php // echo $form->field($model, 'auditory') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
