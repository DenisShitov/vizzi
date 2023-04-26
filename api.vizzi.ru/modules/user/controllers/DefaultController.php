<?php

namespace app\modules\user\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\web\HttpException;

use app\models\User;
use app\modules\user\models\UploadFile;

/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
{
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index','update'],
                        'allow' => true,
						'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->email_confirm == 1 && Yii::$app->user->identity->active != 2;
						},
                        'roles' => ['@'],
                    ],
                ],
            ],
			'rateLimiter' => [
			'class' => \ethercreative\ratelimiter\RateLimiter::className(),
			'rateLimit' => 100,	 //30 - requests
			'timePeriod' => 600, //600 - minute
			'separateRates' => false,
			'enableRateLimitHeaders' => false,
			],			
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
	$model = new UploadFile();
        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
                //return;
				$updater = User::findOne(Yii::$app->user->identity->id);
				$updater->ava = '/img/uploads/ava_'.Yii::$app->user->identity->typeuser.'_'. Yii::$app->user->identity->id.'.jpg';
				$updater->save();	
            }
        }
        //return $this->render('index');
		return $this->render('index', ['model' => $model]);
    }
	
    public function actionUpdate() {
	if (Yii::$app->request->isAjax) {
    $data = Yii::$app->request->post();
    $phone = explode(":", $data['phone']);
	$phone = strip_tags($phone[0]);
    $desc = explode(":", $data['desc']);
	$desc = strip_tags($desc[0]);
	
	$user_count = User::find()->where(['id'=>Yii::$app->user->identity->id])->count();
	
	if ($user_count > 0) {
	if (Yii::$app->user->identity->typeuser == 1) {
    $name = explode(":", $data['name']);
	$name = strip_tags($name[0]);
    $site = explode(":", $data['site']);
	$site = strip_tags($site[0]);	
	if ($name != '' && $phone != '' && $site != '' && $desc != '') {
	$updater = User::findOne(Yii::$app->user->identity->id);
	$updater->brand_name = $name;
	$updater->brand_desc = $desc;
	$updater->brand_site = $site;
	$updater->phone = $phone;
	$updater->active = 1;
    $updater->save();
	return 'Success';
	} else {
		throw new HttpException(400 ,'Error');
	}
	}
	if (Yii::$app->user->identity->typeuser == 2) {
	if ($phone != '' && $desc != '') {
	$updater = User::findOne(Yii::$app->user->identity->id);
	$updater->brand_desc = $desc;
	$updater->phone = $phone;
	$updater->active = 1;
    $updater->save();
	return 'Success';
	} else {
		throw new HttpException(400 ,'Error');
	}		
	}
	
	} else {
		throw new HttpException(400 ,'Error');
	}	
	
	} else {
		throw new HttpException(400 ,'Error');
	}
	
	}
	
	/*
	public function actionUpload() {
	$model = new UploadFile();
	if(Yii::$app->request->isPost){
		$model->image = UploadedFile::getInstance($model, 'image');
		$model->upload();
		return;
	}
	return $this->render('upload', ['model' => $model]);
	}
	*/
	
	
}
