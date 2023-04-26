<?
use app\models\User;
	
if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
}

$blogeruser_id = User::Find()->where(['id' => $model->from_id])->one();
?>

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<b><? echo $model->from_name; ?></b><br/>
<span class="text-muted">блогер</span>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pt10">
<a href="/msg/default/dialog/<? echo $model->from_id; ?>" class="btn btn-info btn-sm fff">Диалог</a> 
<a href="/blogers/default/profile/<? echo $blogeruser_id->cart_id; ?>" class="btn btn-info btn-sm fff">Профиль</a>
</div>