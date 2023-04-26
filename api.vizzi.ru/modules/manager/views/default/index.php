<?php
use app\models\User;

$this->title = 'Личный менеджер';
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$name = Yii::$app->user->identity->name;
$keyq = Yii::$app->user->identity->keyq;
$user_manager = Yii::$app->user->identity->manager;
}
if ($user_manager == '') {
	$user_manager = 2;
}

$manager = User::find()->where(['id' => $user_manager])->one();

if ($manager->ava != '') {
	$ava = 'background-image: url('.$manager->ava.');';	
}
else {
	$ava = 'background-image: url(/img/support.png);background-size:70% 70%;';
}
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">
<h2>Личный менеджер</h2>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt20 msg-block">
<div class="row">

<div class="col-lg-4 col-md-6">
<div class="card"> <div class="card-body"> <div class="media"> <span class="avatar avatar-xxl mr-5" style="<?php echo $ava; ?>"></span> <div class="media-body"> <h4 class="m-0"><?php echo $manager->name; ?></h4> <p class="text-muted mb-0">Ваш менеджер</p><br/><div><a href="/app/contact?act=manager" class="btn btn-primary btn-sm fff">Написать</a> <button type="button" id="select_star" class="btn btn-warning btn-sm fff">Оценить</button></div></div> </div> </div> </div>

<div class="card"><div class="card-body"> 
<p>Менеджер доступен по будням, с 09:00 до 16:00 по МСК.</p>
<p class="manager-btns"><a href="/app/contact?act=faq" class="btn btn-info btn-sm">FAQ</a> <a href="/app/contact/" class="btn btn-info btn-sm">Техническая поддержка</a></p>
</div></div>

</div>

<div class="col-lg-8 col-md-6">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptb30 bgw">
<div class="container">

<div class="col-lg-8 col-md-8 col-ms-12 col-xs-12">
<div class="dynamic_content">
<div data-show="1" class="w100 animated fadeIn">
<b>Мы открыты к сотрудничеству.</b><br/><br/>Если у Вас есть интересное предложение, напишите нам. Можете сообщить об этом менеджеру либо на e-mail: <a href="mailto:info@velablog.ru">info@velablog.ru</a><br/><br/>
</div>
<div data-show="2" class="w100 dn animated fadeIn">
<b>Система рейтинга позволяет узнать статус и опыт участника.</b><br/><br/>
Рейтинг формируется при проверке аккаунта (у блогера) или при успешном сотрудничестве и хороших оценках (блогеры и рекламодатели).
</div>
<div data-show="3" class="w100 dn animated fadeIn">
<b>Промокоды позволяют получить новые "коины"!</b><br/><br/>
Получайте промокоды у наших партнеров, либо выполняя задания (список заданий можно получить у менеджера).
</div>

</div>
</div>
<div class="col-lg-4 col-md-4 col-ms-12 col-xs-12  color-black">
<ul class="dynamic_content_btns">
<li class="active" data-content="1"><i class="fe fe-toggle-right"></i>&nbsp; <a href="#">Сотрудничество</a></li>
<li data-content="2"><i class="fe fe-bar-chart"></i>&nbsp; <a href="#">Рейтинг</a></li>
<li data-content="3"><i class="fe fe-award"></i>&nbsp; <a href="#">Промокоды</a></li>
</ul>
</div>

</div>
</div>

</div>

</div>
</div>



</div>
</div>

<style>
.fff {
	color:#fff !important;
}
.manager-btns .btn {
	color:#fff;
}

.dynamic_content {
	min-height:auto;
    padding: 10px;
    border: none;
    box-shadow: none;	
}
</style>

<?php
$script = <<<JS
$('#select_star').click(function() {
	$('#select_star').parent().append('<div class="dib" style="padding-left:10px;" id="select_star2"><span class="star st1"><i class="fa fa-star"></i></span> <span class="star st2"><i class="fa fa-star"></i></span> <span class="star st3"><i class="fa fa-star"></i></span> <span class="star st4"><i class="fa fa-star"></i></span> <span class="star st5"><i class="fa fa-star"></i></span> </div>');
	$(this).remove();
	star2hovered();
});

$('body').on('click','#select_star2 .star', function() {
	$('#select_star2').html('<span class="text-success">Спасибо!</span>');
	localStorage.setItem('selectstar',1);
});

function star2hovered() {
$('#select_star2 .st2').on('mouseover', function() {
	$('#select_star2 .st1').addClass('goldstar');
});
$('#select_star2 .st3').on('mouseover', function() {
	$('#select_star2 .st1').addClass('goldstar');
	$('#select_star2 .st2').addClass('goldstar');
});
$('#select_star2 .st4').on('mouseover', function() {
	$('#select_star2 .st1').addClass('goldstar');
	$('#select_star2 .st2').addClass('goldstar');
	$('#select_star2 .st3').addClass('goldstar');
});
$('#select_star2 .st5').on('mouseover', function() {
	$('#select_star2 .st1').addClass('goldstar');
	$('#select_star2 .st2').addClass('goldstar');
	$('#select_star2 .st3').addClass('goldstar');
	$('#select_star2 .st4').addClass('goldstar');
});

$('#select_star2 .st2').on('mouseout', function() {
	$('#select_star2 .st1').removeClass('goldstar');
});
$('#select_star2 .st3').on('mouseout', function() {
	$('#select_star2 .st1').removeClass('goldstar');
	$('#select_star2 .st2').removeClass('goldstar');
});
$('#select_star2 .st4').on('mouseout', function() {
	$('#select_star2 .st1').removeClass('goldstar');
	$('#select_star2 .st2').removeClass('goldstar');
	$('#select_star2 .st3').removeClass('goldstar');
});
$('#select_star2 .st5').on('mouseout', function() {
	$('#select_star2 .st1').removeClass('goldstar');
	$('#select_star2 .st2').removeClass('goldstar');
	$('#select_star2 .st3').removeClass('goldstar');
	$('#select_star2 .st4').removeClass('goldstar');
});	
}

$(document).ready(function() {
if (localStorage.getItem('selectstar')) {
	$('#select_star').remove();
}
});

JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>

<style>
#select_star2 .star {
	opacity:0.8;
	tranisition:0.5s all;
}
#select_star2 {
	user-select:none;
}
#select_star2 .star:hover {
	color:#e9e210;
	opacity:1;
	cursor:pointer;
	tranisition:0.5s all;
}

.goldstar {
	color:#e9e210;
	opacity:1;
	tranisition:0.5s all;
}
</style>