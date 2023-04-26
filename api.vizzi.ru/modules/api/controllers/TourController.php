<?php
namespace app\modules\api\controllers;
use app\models\Tags;
use yii\rest\ActiveController;
use app\models\Tour;

use Yii;

class TourController extends ActiveController {

  public $modelClass = 'app\models\Tour';

    public static function allowedDomains() {
      return [
        '*',
        'http://localhost:3000/',
        'http://localhost:3001/',
        'http://localhost:3002/',
      ];
    }

    public function behaviors() {
    $behaviors = parent::behaviors();
    $behaviors['corsFilter'] = [
      'class' => \yii\filters\Cors::className(),
      'cors' => [                   // restrict access to domains:
        'Origin' => ['*'],
        'Access-Control-Request-Method' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
        'Access-Control-Request-Headers' => ['*'],
        'Access-Control-Allow-Credentials' => false,
        'Access-Control-Max-Age' => 3600,
        'Access-Control-Expose-Headers' => [],
      ],
    ];
    $behaviors['contentNegotiator'] = [
      'class' => \yii\filters\ContentNegotiator::className(),
      'formats' => [
        'application/json' => \yii\web\Response::FORMAT_JSON,
      ]
    ];

    return $behaviors;
    }

    public function actionGetTourById() {
      $data = Yii::$app->request->post();
      $tour = Tour::find()->where(['id' => $data['id']])->one();
      return $tour;
    }

    public function actionGetToursByCampId() {
      $data = Yii::$app->request->post();
      $tour = Tour::find()->where(['id_camp' => $data['id']])->one();
      return $tour;
    }
}