<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

use app\models\Requests;

$this->title = 'Заявки';

include(Yii::getAlias('@app/modules/admin/views/_parts/fadmin.php'));
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">
<a href="/admin/" class="btn btn-default mt30">← Назад</a><br/>
<h2>Заявки</h2>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt20 admin-panels">

<?php
$query = Requests::find()->orderBy('id DESC');
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_req',
	'summary' => '',
    'emptyText' => 'Заявок не найдено',
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
</div>




<style>
.panel-header {
	padding:15px;
	border-bottom:1px solid #ccc;
}

.admin-panels .btn {
	min-width:49%;
}
.admin-panels .btn-inline {
	min-width:auto;
}
.admin-panels .panel-body {
	min-height:120px;
}
</style>