<?php

namespace app\modules\favorites\controllers;

use yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\HttpException;

use app\modules\favorites\models\Favorites;
use app\models\User;

/**
 * Default controller for the `favorites` module
 */
class DefaultController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','addfav','removefav'],
                'rules' => [
                    [
                        'actions' => ['index','addfav','removefav'],
                        'allow' => true,
						'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->typeuser == 1 && Yii::$app->user->identity->active == 1 && Yii::$app->user->identity->email_confirm == 1;
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
	
	public function actionAddfav() {
	if (Yii::$app->request->isAjax) {
    $data = Yii::$app->request->post();
    $fid = explode(":", $data['fid']);
    $key = explode(":", $data['key']);
    $type = explode(":", $data['type']);
    $fid = $fid[0];
    $key = $key[0];
	$type = $type[0];
	
	//$user = User::find()->where(['keyq'=>$key])->one();
	$uid = Yii::$app->user->identity->id;
	
	$countfavs_limit = Favorites::find()->where(['uid'=>$uid])->count();
	if ($countfavs_limit <= 100) {
	$countfavs = Favorites::find()->where(['fid'=>$fid])->andWhere(['uid'=>$uid])->count();
	if ($countfavs == 0) {
    $newfav = new Favorites();
	$newfav->fid = $fid;
	$newfav->type = $type;
	$newfav->uid = $uid;
    $newfav->save();
	return 'Success';
	}
	// success font
	}
	// quota == 100 ? quota = 'full' : quota = 'empty'
	else { return 'Quota'; }
	
	return 'Success';
	}
	else {
		throw new HttpException(400 ,'Error');
	}
	}
	
	public function actionRemovefav() {
	if (Yii::$app->request->isAjax) {
    $data = Yii::$app->request->post();
    $id = explode(":", $data['id']);
    $key = explode(":", $data['key']);	
    $id = $id[0];
    $key = $key[0];
	//$user = User::find()->where(['keyq'=>$key])->one();
	$uid = Yii::$app->user->identity->id;
	
	$countfavs = Favorites::find()->where(['id'=>$id])->andWhere(['uid'=>$uid])->count();
	if ($countfavs > 0) {
	$removefav = Favorites::findOne($id);
	$removefav->delete(); // do not remove
	}
	return 'Success';
	} // not return success status request
	else {
		throw new HttpException(400 ,'Error');
	}
	}

}