<?php

namespace app\modules\msg\controllers;

use yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\HttpException;

use app\modules\msg\models\Messages;
use app\models\User;

/**
 * Default controller for the `msg` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','addmsg','dialog','coop'],
                'rules' => [
                    [
                        'actions' => ['index','addmsg','dialog','coop'],
                        'allow' => true,
						'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->active == 1 && Yii::$app->user->identity->email_confirm == 1;
						},
                        'roles' => ['@'],
                    ],
                ],
            ],
			'rateLimiter' => [
				'class' => \ethercreative\ratelimiter\RateLimiter::className(),
				'rateLimit' => 100,	 //100 - requests
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
    public function actionIndex()
    {
        return $this->render('index');
    }
	
    public function actionDialog()
    {
        return $this->render('dialog');
    }

    public function actionCoop()
    {
        return $this->render('coop');
    }	
	
	public function actionAddmsg() {
	if (Yii::$app->request->isAjax) {
    $data = Yii::$app->request->post();
    $to = explode(":", $data['to']);
	$toname = explode(":", $data['to_name']);
    $key = explode(":", $data['key']);
    $msg = explode(":", $data['msg']);
    $to = $to[0];
	$toname = $toname[0];
    $key = $key[0];
	$msg = strip_tags($msg[0]); //msg
	
	//$user_cnt = User::find()->where(['keyq'=>$key])->count();
	
	//$user = User::find()->where(['keyq'=>$key])->one(); //выбираем пользователя по ключу
	//$uid = $user->id; //получаем id пользователя
	//$uname = $user->name; //получаем имя пользователя
	
	$count_actual_msg = Messages::find()->where(['to_id' => $to,'from_id' => Yii::$app->user->identity->id])->orWhere(['to_id' => Yii::$app->user->identity->id,'from_id' => $to])->count();
	
	if ($count_actual_msg > 0) {
    $newmsg = new Messages();
	$newmsg->date = date('Y-m-d H:i:s');
	$newmsg->to_id = $to;
	$newmsg->from_id = Yii::$app->user->identity->id;
	$newmsg->to_name = $toname;
	$newmsg->from_name = Yii::$app->user->identity->name;
	$newmsg->text = $msg;
	$newmsg->reader = 0;
	$newmsg->type = 0;
    $newmsg->save();
	//sleep(1);
		return 'Success';
	} else {
		throw new HttpException(400 ,'Error');
	}
	}
	else {
		throw new HttpException(400 ,'Error');
	}
	}
	
}
