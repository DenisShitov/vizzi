<?
use app\models\User;

if ($model->admin_link == '' && $model->type == 0) {
	
if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
}

	$iconother = '<i class="fe fe-arrow-right-circle text-warning" data-toggle="tooltip" data-original-title="Входящее"></i>';
	$answer = '<i class="fe fe-mail"></i> <a href="/msg/default/dialog/'.$model->from_id.'">Диалог</a> &nbsp;&nbsp;&nbsp;<i class="fe fe-corner-up-right" data-toggle="tooltip" data-original-title=""></i> <a href="#" data-to="'.$model->from_id.'" data-to-name="'.$model->from_name.'" data-target="newmsg">Ответить</a>';

if ($model->from_id == $user_id) {
	$iconother = '<i class="fe fe-arrow-left-circle text-success" data-toggle="tooltip" data-original-title="Исходящее"></i>';
	$answer = '';
	$toname = '<i class="fe fe-arrow-right-circle" data-toggle="tooltip" data-original-title="Получатель"></i> '.$model->to_name;
}
else {
	$iconother = '<i class="fe fe-arrow-right-circle text-warning" data-toggle="tooltip" data-original-title="Входящее"></i>';
	$answer = '<i class="fe fe-corner-up-right" data-toggle="tooltip" data-original-title=""></i> <a href="#" data-to="'.$model->from_id.'" data-to-name="'.$model->from_name.'" data-target="newmsg">Ответить</a>';
	$toname = '';
}

?>

<div class="row">
<div class="card">
<div class="card-header">
<h3 class="card-title"><b><? echo $iconother; ?> <? echo $model->from_name; ?></b></h3>
</div>
<div class="card-body">
<p><? echo strip_tags($model->text); ?></p>
</div>
<div class="card-footer">
<? echo $answer; ?>
<div class="full-right"><span class="small text-muted"><? echo $model->date; ?></span></div>
</div>
</div>
</div>

<? } else { ?>


<div class="row">
<div class="card">
<div class="card-header">
<h3 class="card-title"><b><? echo $model->from_name; ?></b></h3>
</div>
<div class="card-body">
<p><? echo ($model->text); ?></p>
</div>
<div class="card-footer">
<div class="full-right"><span class="small text-muted"><? echo $model->date; ?></span></div>
</div>
</div>
</div>

<? } ?>