<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Каталог';
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$type = isset($_GET['type']) ? $_GET['type'] : null;

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$keyq = Yii::$app->user->identity->keyq;
}
?>



<section id="catalog_service" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service animate__animated animate__fadeInDown animate__delay-0_5s">
<div class="container">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-title">
	<p>В данный момент нет доступных предложений</p>
</div>

</div>
</section>



<style>
#catalog_service {
    min-height:400px;
}
</style>

<?php
$script01 = <<< JS

	
JS;
$this->registerJs($script01, yii\web\View::POS_READY);
?>