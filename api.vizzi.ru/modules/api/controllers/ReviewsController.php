<?php
namespace app\modules\api\controllers;
use Yii;
use yii\web\Controller;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;

use app\models\Camps;
use app\models\Reviews;

class ReviewsController extends ActiveController
{

public $modelClass = 'app\models\Reviews';
public $defaultAction = 'all';

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

    public function actionAll(){
		$reviews_list = $this->modelClass::find()->where(['r_moderate'=>1])->all();
		return $reviews_list;
    }

    public function actionList(){
        $reviews_count = $this->modelClass::find()->where(['uid'=>Yii::$app->user->identity->id])->count();
		if ($reviews_count > 0) {
			$reviews_list = $this->modelClass::find()->where(['uid'=>Yii::$app->user->identity->id])->all();
			return $reviews_list;
		} else {
			return '';
		}
    }
    public function actionUploadReview(){
	if (Yii::$app->request->post()) {
		$data = Yii::$app->request->post();
		$camp_id = $data['r_camp_id'];
		$r_date = date("Y-m-d");
		if ($camp_id != '') {
			$new_obj = new $this->modelClass;
			$new_obj->r_user_name = $data['r_user_name'];
			$new_obj->r_text = $data['r_text'];
      $new_obj->r_user_id = $data['r_user_id'];
			$new_obj->r_camp_id = $data['r_camp_id'];
			$new_obj->r_tour_id = $data['r_tour_id'];
			$new_obj->r_moderate = 0;
			$new_obj->r_date = $r_date;
			$new_obj->rating_1 = floatval($data['rating_1']);
			$new_obj->rating_2 = floatval($data['rating_2']);
			$new_obj->rating_3 = floatval($data['rating_3']);
			$new_obj->rating_4 = floatval($data['rating_4']);
			$new_obj->save();
//      $camp = Camps::find()->where(['id' => $camp_id])->one();
//      if ($camp){
//          $reviews = Reviews::find()->where(['r_camp_id' => $camp_id])->all();
//          if ($reviews){
//            for($i = 1; $i < 5; $i++) {
//              $count = [];
//              $unit_name = 'rating_'.$i;
//              $unit_name_c = 'c_rating_'.$i;
//              foreach ($reviews as $review) {
//                $count[] = $review->{$unit_name};
//              }
//              $camp->{$unit_name_c} = array_sum($count)/count($count);
//              $camp->save();
//            }
//          }
//      }

			return $new_obj->id;
		} else { return 'no camp id'; }
	} else {
		return '';
	}
    }
//    public function actionAdd(){
//	if (Yii::$app->request->post()) {
//		$data = Yii::$app->request->post();
//		$text = $data['text'];
//		$camp_id = $data['camp_id'];
//		$r_date = date("Y-m-d");
//		if ($camp_id != '' && $text != '') {
//			$new_obj = new $this->modelClass;
//			$new_obj->uid = Yii::$app->user->identity->id;
//			$new_obj->r_text = $text;
//			$new_obj->r_camp_id = $camp_id;
//			$new_obj->r_moderate = 0;
//			$new_obj->r_date = $r_date;
//			$new_obj->rating = isset($data['rating']) ? $data['rating'] : 0;
//			$new_obj->save();
//
//            $camps = Camps::find()->where(['id' => $camp_id])->one();
//            if ($camps){
//                $reviews = Reviews::find()->where(['r_camp_id' => $camp_id])->all();
//                if ($reviews){
//                    $count = [];
//                    foreach ($reviews as $review) {
//                        $count[] = $review->rating;
//                    }
//                    $camps->c_rating = array_sum($count)/count($count);
//                    $camps->save();
//                }
//            }
//
//			return 'Success';
//		} else { return ''; }
//	} else {
//		return '';
//	}
//    }
    public function actionRemove(){
	if (Yii::$app->request->post()) {
		$data = Yii::$app->request->post();
		$rev_id = $data['id'];
		$obj_count = $this->modelClass::find()->where(['uid'=>Yii::$app->user->identity->id,'id'=>$rev_id,'r_moderate'=>0])->count();
		if ($obj_count > 0) {
			$new_obj = $this->modelClass::find()->where(['uid'=>Yii::$app->user->identity->id,'id'=>$rev_id,'r_moderate'=>0])->one();
			$new_obj->delete();
			return 'Success';
		} else { return ''; }
	} else {
		return '';
	}
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

}