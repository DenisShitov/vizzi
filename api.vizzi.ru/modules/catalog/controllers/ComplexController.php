<?php

namespace app\modules\catalog\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\HttpException;

/**
 * Default controller for the `catalog` module
 */
class ComplexController extends Controller
{

    /* public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view'],
                'rules' => [
                    [
                        'actions' => ['index','view'],
                        'allow' => true,
						'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->active == 1;
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
    } */

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionView()
    {
        return $this->render('view');
    }	
	
}
