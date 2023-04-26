<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Advert */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Сопровождение', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?//= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данную запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'links:ntext',
            'concurent:ntext',
			[
			'attribute' => 'auditory',
			'value' => function($data){
			switch ($data->auditory) {
				case 0: return 'Все'; break;
				case 1: return 'Женщины'; break;
				case 2: return 'Мужчины'; break;
			}
			}
			],			
			[
			'attribute' => 'age',
			'value' => function($data){
			switch ($data->age) {
				case 0: return 'Все'; break;
				case 1: return '0-6'; break;
				case 2: return '7-12'; break;
				case 3: return '13-17'; break;
				case 4: return '18-25'; break;
				case 5: return '26-34'; break;
				case 6: return 'от 35'; break;				
			}
			}
			],
            'comment:ntext',
        ],
    ]) ?>

</div>
</div>


<style>
.detail-view {
	background:#fff;
}
.table th {
    color: #9aa0ac;
    text-transform: none !important;
}	
</style>