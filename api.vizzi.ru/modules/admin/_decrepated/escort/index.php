<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сопровождение';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin/?']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); // start pjax (ajax) ?> 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--p>
        <?= Html::a('Добавить бриф', ['create'], ['class' => 'btn btn-success']) ?>
    </p-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>


<style>
.grid-view .table {
	background:#fff;
}
.grid-view .table th {
	text-transform:none;
    font-size: 12px;
}
.grid-view .table td {
	text-transform:none;
    font-size: 12px;
}

.grid-view .table tr td a:nth-child(2) {
	display:none;
}
</style>