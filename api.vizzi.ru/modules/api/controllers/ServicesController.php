<?php
namespace app\modules\api\controllers;
use yii\rest\ActiveController;
use app\models\Service;
use Yii;

class ServicesController extends ActiveController
{

  public $modelClass = 'app\models\Service';

  public static function allowedDomains()
  {
    return [
      '*'
    ];
  }

  public function behaviors()
  {
    $behaviors = parent::behaviors();
    $behaviors['corsFilter'] = [
      'class' => \yii\filters\Cors::className(),
      'cors' => [                   // restrict access to domains:
        'Origin' => ['*'],
        'Access-Control-Request-Method' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
        'Access-Control-Request-Headers' => ['*'],
        'Access-Control-Allow-Credentials' => null,
        'Access-Control-Max-Age' => 86400,
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

  public function actions()
  {
    $actions = parent::actions();
    $actions['index']['dataFilter'] = [
      'class' => \yii\data\ActiveDataFilter::class,
      'searchModel' => $this->modelClass,
    ];
    return $actions;
  }


//  public function actionOrder(){
//    if (Yii::$app->request->post()) {
//      $data = Yii::$app->request->post();
//      $date_create = date("Y-m-d H:i:s");
//
//      $type_client = $data['type_client'];
//      $type_camp = $data['type_camp'];
//
//      $fio_client = $data['fio_client'];
//      $uid = $data['uid'];
//      $camp_name = $data['camp_name'];
//      $camp_id = $data['camp_id'];
//      $count_seats = $data['count_seats'];
//      $cost = $data['cost'];
//      $season = $data['season'];
//      $accommodation = $data['accommodation'];
//      $nutrition = $data['nutrition'];
//      $claim_status = $data['claim_status'];
//      $pay_status = $data['pay_status'];
//      $tour = $data['tour_num'];
//      $comment = $data['comment'];
//
//      if ($type_client != '' && $type_camp != '' && $count_seats != '' && $season != '') {
//        $obj_upd  = new Claims();
//        $obj_upd->date_create = $date_create;
//        $obj_upd->date_update = $date_create;
//
//        // пишем новое имя или id юзера
//        if ($type_client == 0 && $fio_client != '') {
//          $obj_upd->fio_client = $fio_client;
//        }
//        if ($type_client == 1 && $uid != '') {
//          $obj_upd->uid = $uid;
//        }
//
//        // пишем новый лагерь или id лагеря
//        if ($type_camp == 0 && $camp_name != '') {
//          $obj_upd->camp_name = $camp_name;
//        }
//        if ($type_camp == 1 && $camp_id != '') {
//          $obj_upd->camp_id = $camp_id;
//        }
//
//        $obj_upd->count_seats = $count_seats;
//        $obj_upd->cost = $cost;
//        $obj_upd->season = $season;
//        $obj_upd->accommodation = $accommodation;
//        $obj_upd->nutrition = $nutrition;
//        $obj_upd->claim_status = $claim_status;
//        $obj_upd->pay_status = $pay_status;
//        $obj_upd->tour_num = $tour;
//        $obj_upd->comment = $comment;
//        $obj_upd->save();
//        if ($obj_upd->save()){
//          return $obj_upd->primaryKey;
//        }else{
//          return $obj_upd->getErrors();
//        }
//      }
//    }
//    return 'Error';
//  }

}