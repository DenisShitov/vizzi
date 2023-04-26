<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

use app\modules\admin\models\UploadImg1;
use app\modules\admin\models\UploadPic;
use app\modules\admin\models\UploadFile;
use app\models\User;
use app\models\Claims;

class ClaimsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','add','update','remove'],
                'rules' => [
                    [
                        'actions' => ['index','view','add','update','remove'],
                        'allow' => true,
						'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->superuser == 1;
						},
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }
	
    public function actionGetlistreviews() {
	if (Yii::$app->request->isAjax) {
    $data = Yii::$app->request->post();
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			$reviews_data = Claims::find()->orderBy('id DESC')->all();
			return $reviews_data;
	} else {
			return "System Error";
	}
    }
	
	public function actionRemove() {
	if (Yii::$app->request->isAjax) {
    $data = Yii::$app->request->post();
    $id = $data['id'];
	$obj_count = Claims::find()->where(['id'=>$id])->count();
	if ($obj_count > 0) {
		$obj_upd  = Claims::find()->where(['id'=>$id])->one();
		$obj_upd->delete();
		return "Success";
	} else {
			return "Error";
	}
	} else {
			return "Error";
	}
	}
	
	public function actionAdd() {
	if (Yii::$app->request->isAjax) {
    $data = Yii::$app->request->post();
	$date_create = date("Y-m-d H:i:s");

    $type_client = $data['type_client'];
    $type_camp = $data['type_camp'];
	
    $fio_client = $data['fio_client'];
    $uid = $data['uid'];
    $camp_name = $data['camp_name'];
    $camp_id = $data['camp_id'];
    $count_seats = $data['count_seats'];
    $cost = $data['cost'];
    $season = $data['season'];
    $accommodation = $data['accommodation'];
    $nutrition = $data['nutrition'];
    $claim_status = $data['claim_status'];
    $pay_status = $data['pay_status'];
    $comment = $data['comment'];
	
	if ($type_client != '' && $type_camp != '' && $count_seats != '' && $season != '') {
		$obj_upd  = new Claims();
		$obj_upd->date_create = $date_create;
		$obj_upd->date_update = $date_create;
		
		// пишем новое имя или id юзера
		if ($type_client == 0 && $fio_client != '') { 
			$obj_upd->fio_client = $fio_client; 
		} 
		if ($type_client == 1 && $uid != '') { 
			$obj_upd->uid = $uid; 
		}
		
		// пишем новый лагерь или id лагеря
		if ($type_camp == 0 && $camp_name != '') { 
			$obj_upd->camp_name = $camp_name; 
		} 
		if ($type_camp == 1 && $camp_id != '') { 
			$obj_upd->camp_id = $camp_id; 
		}

		$obj_upd->count_seats = $count_seats;
		$obj_upd->cost = $cost;
		$obj_upd->season = $season;
		$obj_upd->accommodation = $accommodation;
		$obj_upd->nutrition = $nutrition;
		$obj_upd->claim_status = $claim_status;
		$obj_upd->pay_status = $pay_status;
		$obj_upd->comment = $comment;
		$obj_upd->save();
		
		
		return $obj_upd->primaryKey;
	} else { return "System Error"; }

	} else {
			return "System Error";
	}
	}
	
	public function actionUpdate() {
	if (Yii::$app->request->isAjax) {
    $data = Yii::$app->request->post();
	$date_update = date("Y-m-d H:i:s");
	$claim_id = $data['claim_id'];

    $type_client = $data['type_client'];
    $type_camp = $data['type_camp'];
	
    $fio_client = $data['fio_client'];
    $uid = $data['uid'];
    $camp_name = $data['camp_name'];
    $camp_id = $data['camp_id'];
    $count_seats = $data['count_seats'];
    $cost = $data['cost'];
    $season = $data['season'];
    $accommodation = $data['accommodation'];
    $nutrition = $data['nutrition'];
    $claim_status = $data['claim_status'];
    $pay_status = $data['pay_status'];
    $comment = $data['comment'];
	
	$claim_count = Claims::find()->where(['id'=>$claim_id])->count();
	if ($claim_count > 0) {
		$obj_upd = Claims::find()->where(['id'=>$claim_id])->one();
		$obj_upd->date_update = $date_update;
		
		// пишем новое имя или id юзера
		if ($type_client == 0 && $fio_client != '') { 
			$obj_upd->fio_client = $fio_client;
			$obj_upd->uid = '';
			
			$return_client_arr1 = ['client_id'=>''];
			$return_client_arr2 = ['client_name'=>$fio_client];
		} 
		if ($type_client == 1 && $uid != '') { 
			$obj_upd->uid = $uid;
			$obj_upd->fio_client = '';
			
			$client_db = User::find()->where(['id'=>$uid])->one();
			$return_client_arr1 = ['client_id'=>$client_db->id];
			$return_client_arr2 = ['client_name'=>$client_db->name];
		}
		
		// пишем новый лагерь или id лагеря
		if ($type_camp == 0 && $camp_name != '') { 
			$obj_upd->camp_name = $camp_name;
			$obj_upd->camp_id = ''; 
		}
		if ($type_camp == 1 && $camp_id != '') { 
			$obj_upd->camp_id = $camp_id;
			$obj_upd->camp_name = '';
		}

		$obj_upd->count_seats = $count_seats;
		$obj_upd->cost = $cost;
		$obj_upd->season = $season;
		$obj_upd->accommodation = $accommodation;
		$obj_upd->nutrition = $nutrition;
		$obj_upd->claim_status = $claim_status;
		$obj_upd->pay_status = $pay_status;
		$obj_upd->comment = $comment;
		$obj_upd->save();
		
			return $date_update;

	} else { return "System Error"; }

	} else {
			return "System Error";
	}
	}

}