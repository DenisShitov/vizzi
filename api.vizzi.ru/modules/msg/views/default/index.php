<?
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\modules\msg\models\Messages;
use app\modules\blogers\models\Coop;
//use yii\db\Query;

$this->title = 'Мессенджер';
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$name = Yii::$app->user->identity->name;
$keyq = Yii::$app->user->identity->keyq;
$user_type = Yii::$app->user->identity->typeuser;
$user_active = Yii::$app->user->identity->active;
}
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">

<div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
<h2>Сообщения</h2>
<?
$subquery = Messages::find()->where(['to_id' => $user_id])->groupBy('from_id');
$dataProvider = new ActiveDataProvider([
    'query' => $subquery->orderBy('id DESC'), // query order by id DESC
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_post',
	'summary' => '',
    'emptyText' => 'Здесь будут отображаться Ваши диалоги.',
    'emptyTextOptions' => [
        'tag' => 'div',
		'class' => 'mt50 text-center'
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12 mt20 animated fadeInLeft'
    ],	
]);
?>
</div>

<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
<h2>Сотрудничество</h2>

<?
$subquery = Coop::find()->where(['pr_id' => $user_id])->orWhere(['bloger_id' => $user_id]);
$dataProvider = new ActiveDataProvider([
    'query' => $subquery->orderBy('id DESC'), // query order by id DESC
    'pagination' => [
        'pageSize' => 20,
    ],
]);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_coop_cart',
	'summary' => '',
    'emptyText' => 'У Вас еще нет предложений',
    'emptyTextOptions' => [
        'tag' => 'div',
		'class' => 'mt50 text-center'
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12 mt20 animated fadeInRight delay-0_5s'
    ],	
]);
?>

</div>


</div>
</div>


<!-- Modal -->
<div class="msg-write dn">
<div class="form-group">
<label class="form-label"><span></span>, новое сообщение:</label>
<textarea id="msg_text" class="form-control" rows="4" placeholder="Введите Ваше сообщение здесь"></textarea>
</div>
<div class="">
<button class="btn btn-info fff" id="msg_send">Отправить</button> <button class="btn btn-danger fff" data-target="msgrhide">Закрыть</button>
</div>
</div>

<?
$csrfq = Yii::$app->request->getCsrfToken();
$script02 = <<<JS
var data_to = 0;
var data_to_name = '';
var message = '';

$('[data-target="newmsg"]').click(function() {
$('.msg-write').fadeIn();
data_to = $(this).attr('data-to');
data_to_name = $(this).attr('data-to-name');
$('.msg-write textarea').focus();
$('.msg-write .form-label span').text(data_to_name);
});

$('#msg_send').click(function() {
message = $('#msg_text').val();
  $.ajax({
       url: '/msg/default/addmsg/',
       type: 'post',
       data: {
                 to: data_to,
                 key: '$keyq',
				 to_name: data_to_name,
				 msg: message,
                 _csrf : '$csrfq'
       },
       success: function (data) {
			if (data == "Success") {
				$('.msg-write div').hide();
				$('#msg_text').val('');
				$('.msg-write').append('<p class="animated fadeIn text-success">Сообщение успешно отправлено!</p>');
				setTimeout(function() {
					$('.msg-write p').remove();
					$('.msg-write div').fadeIn();
				},3000);
			} else {
				$('.msg-write div').hide();
				$('.msg-write').append('<p class="animated fadeIn text-danger">Ошибка при отправке сообщения.</p>');
				setTimeout(function() {
					$('.msg-write p').remove();
					$('.msg-write div').fadeIn();
				},3000);
			}
       },
	   error: function() {
		   $('.loading').hide();
		   console.log('Error');
	   }
  });	
});

$('[data-target="msgrhide"]').click(function() {
$('.msg-write').fadeOut();	
});
JS;
$this->registerJs($script02, yii\web\View::POS_READY);
?>

<style>
.contact-block {
    padding: 10px;
    background: #fff;
    border: 1px solid #ccc;
	margin-bottom: 10px;
}
.msg-block {
	background: #fff;
    padding: 20px;
    border: 1px solid #ccc;
}
.msg-write {
    position: fixed;
    right: 80px;
    bottom: 80px;
    width: 400px;
    background: #fff;
    padding: 20px;
    border: 5px solid #ccc;
	z-index:9000;
}
</style>