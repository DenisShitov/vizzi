<?
use app\models\User;

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$name = Yii::$app->user->identity->name;
$keyq = Yii::$app->user->identity->keyq;
$user_type = Yii::$app->user->identity->typeuser;
$user_active = Yii::$app->user->identity->active;
}

$user_from = User::find()->where(['id'=>$user_id])->one();
?>

<div class="row">
<div class="card">
<div class="card-header">
<h3 class="card-title"><b><? if ($user_type == 1) { echo 'Ваше предложение'; } else { echo 'Предложение для Вас'; } ?></b></h3>
</div>
<div class="card-body">
<p><? echo $model->msg; ?>
<div class="text-muted mt20"><b>Ссылки:</b> <span class="text-black"><? echo $model->links; ?></span></div>
</p>
</div>
<div class="card-footer">
<? if ($model->tech_concept == 1) { ?>
<div class="text-muted mt20"><b>Есть концепт/тех.задание</b></div>
<? }
switch ($model->priority) {
case 1: $priority_msg = 'Средний приоритет'; break;
case 2: $priority_msg = 'Высокий приоритет'; break;
case 3: $priority_msg = 'Важный приоритет'; break;
default: $priority_msg = 'Средний приоритет'; break;
}
?>
<div class="text-muted"><b><? echo $priority_msg; ?></b></div><br/>

<? if ($user_type == 1) { ?>
<a href="/msg/default/dialog/<? echo $model->bloger_id; ?>" class="btn btn-danger btn-sm fff">Перейти к диалогу</a>
<? } else { ?>
<a href="/msg/default/dialog/<? echo $model->pr_id; ?>" class="btn btn-danger btn-sm fff">Перейти к диалогу</a>
<? } ?>

<div class="full-right"><span class="small text-muted"><? echo $model->date_create; ?></span></div>
</div>
</div>
</div>

