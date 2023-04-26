<?
use app\models\User;

use app\modules\blogers\models\BlogersCart;
	
if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$user_type = Yii::$app->user->identity->typeuser;
}

$bgclass = '';
$iconclass = '';

if ($user_type == 1) {
	$bloger_cnt = User::Find()->where(['id' => $model->bloger_id])->count();
	if ($bloger_cnt > 0) {
	$touser_id = User::Find()->where(['id' => $model->bloger_id])->one();
	$date_class = 'text-white';
	$netbloger_cnt = BlogersCart::find()->where(['user_id'=>$touser_id->id])->count();
	if ($netbloger_cnt > 0) {
	$netbloger = BlogersCart::find()->where(['user_id'=>$touser_id->id])->one();
	switch ($netbloger->net) { // 1 - yt, 2 - in, 3 - vk
		case 1: $bgclass = 'bg-youtube'; $iconclass = '<i class="fa fa-youtube" data-toggle="tooltip" data-original-title="Youtube"></i>&nbsp;&nbsp;'; break;
		case 2: $bgclass = 'bg-instagram'; $iconclass = '<i class="fa fa-instagram" data-toggle="tooltip" data-original-title="Instagram"></i>&nbsp;&nbsp;'; break;
		case 3: $bgclass = 'bg-vk'; $iconclass = '<i class="fa fa-vk" data-toggle="tooltip" data-original-title="ВКонтакте"></i>&nbsp;&nbsp;';  break;
		default: $bgclass = ''; $iconclass = ''; break; 
	}
	}	
}
} else {
	$touser_id = User::Find()->where(['id' => $model->pr_id])->one();
	$bgclass = ''; $iconclass = ''; $date_class = '';
}
?>
<div class="row">
<div class="card<? echo ' '.$bgclass; ?>">
<div class="card-header">
<h3 class="card-title"><b><? echo $iconclass; ?><? echo $touser_id->name; ?></b></h3><br/>
</div>
<div class="card-body">
<a href="/msg/default/coop/<? echo $touser_id->id; ?>" class="btn btn-danger btn-sm fff">Предложение</a>
<a href="/msg/default/dialog/<? echo $touser_id->id; ?>" class="btn btn-info btn-sm fff">Диалог</a>
<? if ($user_type == 1) { ?>
<a href="/blogers/default/profile/<? echo $touser_id->cart_id; ?>" class="btn btn-info btn-sm fff">Профиль</a>
<? } ?>

<div class="full-right"><span class="small text-muted <? echo $date_class; ?>"><? echo $model->date_create; ?></span></div>
</div>
</div>
</div>
