<?
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\modules\msg\models\Messages;

use app\models\User;

$this->title = 'Диалоги';
$this->params['breadcrumbs'][] = ['label' => 'Сообщения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$name = Yii::$app->user->identity->name;
$keyq = Yii::$app->user->identity->keyq;
$user_type = Yii::$app->user->identity->typeuser;
$user_active = Yii::$app->user->identity->active;
}

$from = isset($_GET['from']) ? $_GET['from'] : null;

if ($from == 0) {
$msg_count = 0;	
}
else {
$msg_count = Messages::find()->where(['to_id' => $user_id,'from_id' => $from])->orWhere(['to_id' => $from,'from_id' => $user_id])->count();
}

if ($msg_count > 0) {

$user_from = User::find()->where(['id'=>$from])->one();
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">
<h2><? echo $user_from->name; ?></h2>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<?
Messages::updateAll(['reader' => 1], ['to_id' => $user_id, 'from_id' => $from, 'reader' => 0]);

$dataProvider = new ActiveDataProvider([
    'query' => Messages::find()->where(['to_id' => $user_id,'from_id' => $from])->orWhere(['to_id' => $from,'from_id' => $user_id])->orderBy('id DESC'), // ->orWhere(['from_id' => $user_id]) // andWhere(['from_id' => $user_id])
    //'pagination' => [
    //    'pageSize' => 20,
    //],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_post_dialog',
	'summary' => '',
    'emptyText' => 'Список пуст',
    'emptyTextOptions' => [
        'tag' => 'p',
		'class' => 'text-danger'
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12 mt5 animated fadeIn'
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
<button class="btn btn-info fff" id="msg_send" disabled="">Отправить</button> <!--button class="btn btn-danger fff" data-target="msgrhide">Закрыть</button-->
</div>
</div>


<?
$csrfq = Yii::$app->request->getCsrfToken();
$script02 = <<<JS
var message = '';

$('#msg_text').keyup(function() {
	if ($(this).val().length > 1) {
		$('#msg_send').removeAttr('disabled');
	}
	else {
		$('#msg_send').attr('disabled','disabled');
	}
});

$(document).ready(function() {
$('.msg-write').fadeIn();
$('.msg-write textarea').focus();
$('.msg-write .form-label span').text('$user_from->name');
});

$('[data-target="newmsg"]').click(function() {
$('.msg-write').fadeIn();
var data_to_name = $(this).attr('data-to-name');
$('.msg-write textarea').focus();
$('.msg-write .form-label span').text(data_to_name);
});

$('#msg_send').click(function() {
message = $('#msg_text').val();

  $.ajax({
       url: '/msg/default/addmsg/',
       type: 'post',
       data: {
                 to: $from,
                 key: '$keyq',
				 to_name: '$user_from->name',
				 msg: message,
                 _csrf : '$csrfq'
       },
       success: function (data) {
				$('.msg-write div').hide();
				$('#msg_text').val('');
				$('.msg-write').append('<p class="animated fadeIn text-success">Сообщение успешно отправлено!</p>');
				setTimeout(function() {
					$('.msg-write p').remove();
					$('.msg-write div').fadeIn();
				},3000);
       },
	   error: function() {
		   $('.loading').hide();
				$('.msg-write div').hide();
				$('.msg-write').append('<p class="animated fadeIn text-danger">Ошибка при отправке сообщения.</p>');
				setTimeout(function() {
					$('.msg-write p').remove();
					$('.msg-write div').fadeIn();
				},3000);
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

<? } else { ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">
<p class="text-danger">Диалога не найдено</p>
</div></div>
<? } ?>