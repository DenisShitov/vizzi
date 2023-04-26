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
use app\models\Reviews;

class ReviewsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','add','changestatus','remove'],
                'rules' => [
                    [
                        'actions' => ['index','view','add','changestatus','remove'],
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
			$reviews_data = Reviews::find()->orderBy('id DESC')->all();
			return $reviews_data;
	} else {
			return "System Error";
	}
    }
	
	public function actionRemove() {
	if (Yii::$app->request->isAjax) {
    $data = Yii::$app->request->post();
    $id = $data['id'];
	$obj_count = Reviews::find()->where(['id'=>$id])->count();
	if ($obj_count > 0) {
		$obj_upd  = Reviews::find()->where(['id'=>$id])->one();
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
	$r_date = date("Y-m-d");
    $r_name = $data['r_name'];
    $r_text = $data['r_text'];
    $r_moderate = $data['r_moderate'];
    $r_camp_id = $data['r_camp_id'];

	if ($r_name != '' && $r_text != '' && $r_moderate != '' && $r_camp_id != '') {
		$obj_upd  = new Reviews();
		$obj_upd->r_user_name = $r_name;
		$obj_upd->r_date = $r_date;
		$obj_upd->r_text = $r_text;
		$obj_upd->r_moderate = $r_moderate;
		$obj_upd->r_camp_id = $r_camp_id;
		$obj_upd->save();
		
		$return_data = Reviews::find()->where(['id'=>$obj_upd->primaryKey])->one();
		return $return_data->id;
	} else { return "System Error"; }

	} else {
			return "System Error";
	}
	}

	public function actionChangestatus() {
	if (Yii::$app->request->isAjax) {
    $data = Yii::$app->request->post();
	//$r_date = date("Y-m-d");
    $id = $data['id'];
    $status = $data['status'];
	
	$obj_count = Reviews::find()->where(['id'=>$id])->count();
	if ($id != '' && $status != '' && $obj_count > 0) {
		$obj_upd = Reviews::find()->where(['id'=>$id])->one();
		$obj_upd->r_moderate = $status;
		$obj_upd->save();

		return 'Success';
	} else { return "System Error"; }

	} else {
			return "System Error";
	}
	}

}