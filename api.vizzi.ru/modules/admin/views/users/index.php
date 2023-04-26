<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

use app\models\User;

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin/?']];
$this->params['breadcrumbs'][] = $this->title;

$act = isset($_GET['act']) ? $_GET['act'] : null;

$blogclass = '';
$prclass = '';
$allclass = '';

	$query = User::find()->orderBy('id DESC');
	$allclass = 'btn-primary';
	
include(Yii::getAlias('@app/modules/admin/views/_parts/fadmin.php'));
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 admin-block">
<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<a href="/admin/" class="btn btn-default mt30">← Назад</a><br/>
	<h3>Пользователи</h3><br/>
</div>

<?php

$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_task',
	'summary' => '',
    'emptyText' => 'Пользователей не найдено',
    'emptyTextOptions' => [
        'tag' => 'p',
		'class' => 'text-center'
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'col-lg-4 col-md-6 col-sm-12 col-xs-12'
    ],	
]);
?>

</div>
</div>


<style>
.bg-danger, .bg-warning, .bg-success {
	color:#fff;
}
.square {
    width: 10px;
    height: 10px;
    display: inline-block;
    vertical-align: middle;
}

.email-block {
	font-size: 12px;
    display: block;	
}
</style>