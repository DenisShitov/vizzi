<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\User;
use app\models\Camps;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','requests'],
                'rules' => [
                    [
                        'actions' => ['index','requests','getlistusers','getlistcamps'],
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

    public function actionIndex()
    {
        return $this->render('index');
    }
	
    public function actionRequests()
    {
        return $this->render('requests');
    }
	
    public function actionGetlistusers() {
	if (Yii::$app->request->isAjax) {
    $data = Yii::$app->request->post();
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			$reviews_data = Claims::find()->orderBy('id DESC')->all();
			return $reviews_data;
	} else {
			return "System Error";
	}
    }
	
}
