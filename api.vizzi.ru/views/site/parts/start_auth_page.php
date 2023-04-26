<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\modules\materials\models\Materials;

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$email_confirm = Yii::$app->user->identity->email_confirm;
$active = Yii::$app->user->identity->active;
$name = Yii::$app->user->identity->name;
$typeuser = Yii::$app->user->identity->typeuser;
}
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">`

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="page-header">
<h4 class="page-title">Каталог недвижимости</h4>
</div>

				<div class="card">
                  <ul class="list-group card-list-group">

<?php
$query = Materials::find()->orderBy('id DESC');

$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'parts/_material',
	'summary' => '',
    'emptyText' => 'Раздел временно не доступен',
    'emptyTextOptions' => [
        'tag' => 'p',
		'class' => 'text-center'
    ],
    'itemOptions' => [
        'tag' => 'li',
        'class' => 'list-group-item py-5'
    ],	
]);
?>
				
                  </ul>
                </div>

</div>

</div>
</div>


<?php
$script = <<< JS
$('#faqchange').click(function() {
	$('#faq').hide();
	$('#faqchange').hide();
	$('#faqopen').show();
	localStorage.setItem('faq',1);
});
$('#faqopen').click(function() {
	localStorage.removeItem('faq');
	$('#faq').show();
	$('#faqopen').hide();
	$('#faqchange').show();
});

$(document).ready(function() {
if (localStorage.getItem('faq')) {
	$('#faq').hide();
	$('#faqchange').hide();
	$('#faqopen').show();	
}
else {
	$('#faq').show();
	$('#faqopen').hide();
	$('#faqchange').show();
}
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>