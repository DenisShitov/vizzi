<?
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\modules\blogers\models\Coop;

use app\models\User;

$this->title = 'Предложение';
$this->params['breadcrumbs'][] = ['label' => 'Сообщения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$name = Yii::$app->user->identity->name;
$keyq = Yii::$app->user->identity->keyq;
$user_type = Yii::$app->user->identity->typeuser;
$user_active = Yii::$app->user->identity->active;
}

$from = isset($_GET['id']) ? $_GET['id'] : null;

if ($from == 0) {
$coop_count = 0;	
}
else {
$coop_count = Coop::find()->where(['pr_id' => $user_id])->orWhere(['bloger_id' => $user_id])->count();
}

if ($coop_count > 0) {
$user_from = User::find()->where(['id'=>$from])->one()
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">
<h2><? echo $user_from->name; ?></h2>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<?
$dataProvider = new ActiveDataProvider([
    'query' => Coop::find()->where(['pr_id' => $user_id])->orWhere(['bloger_id' => $user_id])->orderBy('id DESC'),
    //'pagination' => [
    //    'pageSize' => 20,
    //],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_coop_enter',
	'summary' => '',
    'emptyText' => 'Список пуст',
    'emptyTextOptions' => [
        'tag' => 'p',
		'class' => 'text-danger'
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12 mt20 animated fadeIn'
    ],	
]);
?>


</div>


</div>
</div>


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
<p class="text-danger">Предложений не найдено</p>
</div></div>
<? } ?>