<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

use app\models\User;
use app\models\Camps;

$this->title = 'Объекты';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin/?']];
$this->params['breadcrumbs'][] = $this->title;

$act = isset($_GET['act']) ? $_GET['act'] : null;

include(Yii::getAlias('@app/modules/admin/views/_parts/fadmin.php'));
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">
<a href="/admin/" class="btn btn-default mt30">← Назад</a> <a href="/admin/objects/add/" class="btn btn-success mt30">Добавить новый объект</a><br/>
<h1><?php echo $this->title; ?></h1><br/>

<div class="col-lg-12 col-md-12" style="margin-bottom:30px;">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#cobj1" aria-controls="cobj1" role="tab" data-toggle="tab">Активные</a></li>
    <li role="presentation"><a href="#cobj2" aria-controls="cobj2" role="tab" data-toggle="tab">Не активные</a></li>
  </ul>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="cobj1">
<?php
$query = Camps::find()->where(['active'=>1])->orderBy('id DESC');
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_obj',
	'summary' => '',
    'emptyText' => 'Объектов не найдено',
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
    <div role="tabpanel" class="tab-pane" id="cobj2">
<?php
$query = Camps::find()->where(['active'=>0])->orderBy('id DESC');
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_obj',
	'summary' => '',
    'emptyText' => 'Объектов не найдено',
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

.panel-header {
	padding:15px;
	border-bottom:1px solid #ccc;
}
.panel-body {
    height: 120px;
    overflow: auto;	
}
.panel-footer {
	min-height:55px;
}
</style>