<?php
//http://vh526442.eurodir.ru/api/camps/
use yii\helpers\Url;

$act = isset($_GET['act']) ? $GET_['act']:null;

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
}

if (Yii::$app->user->identity) {
	Yii::$app->response->redirect(['/admin/']);
} else {
	Yii::$app->response->redirect(['/site/login/']);
}

//include(Yii::getAlias('@app/web/app/index.php'));
?>