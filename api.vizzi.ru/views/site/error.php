<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\models\Verify;

if (Yii::$app->user->identity) {
$user_active = Yii::$app->user->identity->active;
$email_confirm = Yii::$app->user->identity->email_confirm;
$user_id = Yii::$app->user->identity->id;
}



if ($user_active == 0 || $email_confirm == 0 || $user_active == 2) {

if ($user_active == 2) {

$scripter2 = <<<JS
$('#headerMenuCollapse').remove();
$('.dropdown-menu-right').html('<p class="text-danger text-center">Аккаунт заблокирован</p>');
$('#coins').attr('href','#');

JS;
$this->registerJs($scripter2, yii\web\View::POS_READY);	
	
$this->title = 'Ваш аккаунт заблокирован'; ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
	<h2>Ваш аккаунт заблокирован</h2>
	<p class="text-danger">Обнаружены подозрительные действия в работе с Вашим аккаунтом.</p>
	<p>Более подробную информацию Вы можете узнать написав на e-mail: <a href="mailto:spartansoft@ya.ru">spartansoft@ya.ru</a></p>
	</div>
</div>
<? }

if ($user_active == 0 && $email_confirm == 1) {
$this->title = 'Введите информацию';
	Yii::$app->response->redirect(['/user/?act=start']);
}

if ($email_confirm == 0 && $user_active == 0 || $email_confirm == 0 && $user_active == 1) {

$scripter3 = <<<JS
$('#headerMenuCollapse').remove();
$('#alerts_exit').html('<p class="text-danger text-center">Требуется<br/>подтверждение</p>');
$('.dropdown-menu-right a.dropdown-item').remove();
$('.dropdown-menu-right .dropdown-divider').remove();
$('#coins').attr('href','#');

JS;
$this->registerJs($scripter3, yii\web\View::POS_READY);		
	
$this->title = 'Подтвердите Ваш E-mail';
	/*
		$verify_count = Verify::find()->where(['uid'=>Yii::$app->user->identity->id])->count();
		if ($verify_count < 1) {
		$tokenus = Yii::$app->security->generateRandomString();
		
		$verify = new Verify();
		$verify->uid = Yii::$app->user->identity->id;
		$verify->token = $tokenus;
		$verify->save();
		
		$email = Yii::$app->user->identity->email;

		$email_body = '<div style="font-family:Calibri;font-size:14px;border: 5px solid #ccc;padding:15px;"><h2>Здравствуйте!</h2><p>Подтвердите Ваш E-mail для продолжения работы с сервисом "Firestarter".</p><p>Перейдите по ссылке ниже:<br><a href="http://vela.blog/app/verify?token='.$tokenus.'" style="color:#467fcf;">http://vela.blog/app/verify?token='.$tokenus.'</a></p><p><br>Спасибо!<br>Команда <b>Firestarter</b></p></div>';
		
		
		Yii::$app->mailer->compose()
		->setTo($email)
		->setFrom(['qfirestarter@ya.ru'])
		->setSubject('[Firestarter] Подтверждение E-mail')
		->setTextBody($email_body)
		->send();
		}
	*/
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
	<h2>На Ваш E-mail выслано письмо для подтверждения</h2>
	<p>Подтвердите Ваш аккаунт для продолжения работы с сервисом</p>
	</div>
</div>
<?
} } else {
$this->title = 'Ошибка';	
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
	<h2>Ошибка</h2>
    <div class="alert alert-warning">
	<?
	switch ($exception->statusCode) {
		case 429: $msg_status = 'Слишком много запросов. Повторите позже.'; break;
		case 403: $msg_status = 'Нет доступа к данной странице. Выберите <a href="/coins/">план</a>, либо обратитесь к <a href="/manager/">менеджеру</a>.'; break;
		case 404: $msg_status = 'Страница не найдена. Проверьте правильность url.'; break;
		default: $msg_status = nl2br(Html::encode($message)); break;
	}
	?>
	
        <? echo $msg_status ?><br/>
    </div>
	<p>
	<a href="/" class="btn btn-default">На главную</a> <a href="/site/contact/" data-toggle="tooltip" data-original-title="Сообщить об ошибке" class="btn btn-primary">Поддержка</a>
	</p>
    <p>
        Ошибка возникла в результате обращения к веб-серверу.
    </p>
	
	</div>
</div>

<? } ?>
