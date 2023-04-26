<?php
namespace app\modules\api\controllers;
use Yii;
use yii\web\Controller;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;

use app\models\User;
use app\models\Orders;
use app\models\Camps;
use app\models\Tour;


class OrderController extends ActiveController
{
  public $modelClass = 'app\models\UserInfo';
  public $defaultAction = 'info';

  public function behaviors()
  {
    $behaviors = parent::behaviors();
    $behaviors['corsFilter'] = [
      'class' => \yii\filters\Cors::className(),
      'cors' => [
        'Origin' => ['*'],
        'Access-Control-Request-Method' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
        'Access-Control-Request-Headers' => ['*'],
        'Access-Control-Allow-Credentials' => null,
        'Access-Control-Max-Age' => 86400,
        'Access-Control-Expose-Headers' => [],
      ],
    ];
    $behaviors['authenticator'] = [
      'class' => QueryParamAuth::className(),
      'except' => ['login','signup'],
    ];
    $behaviors['contentNegotiator'] = [
      'class' => \yii\filters\ContentNegotiator::className(),
      'formats' => [
        'application/json' => \yii\web\Response::FORMAT_JSON,
      ]
    ];

    return $behaviors;
  }

  public function actionCreateOrder()
  {
    $data = Yii::$app->request->post();
    $obj = new Orders();
    $obj->camp_id = $data['camp_id'];
    $obj->user_id = $data['user_id'];
    $obj->tour_id = $data['tour_id'];
    $obj->created_at = time();
    $obj->save();
    if ($obj->save()) {
      return $obj->primaryKey;
    } else {
      return $obj->getErrors();
    }
  }

  public function actionUpdateOrder()
  {
    $data = Yii::$app->request->post();
    $obj = Orders::find()->where(['id' => $data['id']])->one();
    $obj->camp_id = $data['camp_id'];
    $obj->child_id = $data['child_id'];
    $obj->user_id = $data['user_id'];
    $obj->tour_id = $data['tour_id'];
    $obj->status = $data['status'];
    $obj->stage = $data['stage'];
    $obj->updated_at = time();
    $obj->save();
    if ($obj->save()) {
      return $obj->primaryKey;
    } else {
      return $obj->getErrors();
    }
  }

  public function actionGetOrders()
  {
    $data = Yii::$app->request->post();
    $orders = Orders::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
    if (count($orders)>0) {
      return $orders;
    }
    return 0;
  }


}