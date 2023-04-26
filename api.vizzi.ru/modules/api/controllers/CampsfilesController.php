<?php
namespace app\modules\api\controllers;
use yii\rest\ActiveController;

class CampsfilesController extends ActiveController
{

public $modelClass = 'app\models\CampsFiles';

	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [                   // restrict access to domains:
				'Origin' => ['*'],
				//'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
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

}