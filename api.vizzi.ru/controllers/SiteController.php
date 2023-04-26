<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\Contact;
use app\models\ReportErrors;
use app\models\Verify;
use app\models\User;
use app\models\Camps;

use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;

use yii\filters\RateLimitInterface;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','report'],
                'rules' => [
                    [
                        'actions' => ['logout','report'],
                        'allow' => true,
						'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->active == 1;
						},
                        'roles' => ['@'],
                    ],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['contact'],
                'rules' => [
                    [
                        'actions' => ['contact'],
                        'allow' => true,
						'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->active == 1 && Yii::$app->user->identity->email_confirm == 1;
							//return Yii::$app->user->identity->email != '' || Yii::$app->user->identity->email != NULL
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
     * @inheritdoc
    */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionDocs() {
		$this->layout = 'sys';
        return $this->render('docs');
    }
/*
    public function actionPrivacypolicy() {
        return $this->render('privacypolicy');
    }

	public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
 
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте Ваш e-mail и следуйте дальнейшим инструкциям.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Извините, произошла ошибка.');
            }
        }
 
	return $this->render('passwordResetRequestForm', [
		'model' => $model
	]);
    }
 
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен.');
            return $this->goHome();
        }
 
		return $this->render('resetPasswordForm', [
		'model' => $model,
		]);
      }
*/
    /**
	 * Action for login. LoginForm used on ActionLogin
     * Login action.
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
/* 		// проверка по email в verify и вывод user
    public function actionVerify() {

		$token = isset($_GET['token']) ? $_GET['token'] : null;
		$verify_count = Verify::find()->where(['token'=>$token])->count();
		if ($verify_count > 0) { // если есть токен и email не активирован
		$verify = Verify::find()->where(['token'=>$token])->one();
		
		$user_count = User::find()->where(['email'=>$verify->email])->count(); // есть ли юзер
		
		if ($user_count > 0) {
		$user = User::find()->where(['email'=>$verify->email])->one();
		$user->email_confirm = 1;
		$user->save();
		
		$verify->delete();
			return $this->goHome();
		} else {
			return $this->goHome();
		}
		
		} else {
			return $this->goHome();
		}

    }
*/
	public function actionSignup() {
        $model = new SignupForm();
		//$model->typeuser = 1;
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
 
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */

/*	 
	public function actionContact()
    {
		// change model on contact form
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
		// contact form submitted or success
        if ($orders = $model->contact()) {}
		Yii::$app->session->setFlash('contactFormSubmitted');
		// reload this page after submit
		return $this->refresh();
        }
		// render view on contact action
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
*/	
	
    public function actionContact() {
        $model = new Contact();
        if( $model->load(Yii::$app->request->post()) ) { //&& $model->validate()
		$model->date_support = date('d.m.Y');
		$model->uid = Yii::$app->user->identity->id;
            if($model->save()) {
				Yii::$app->session->setFlash('contactFormSubmitted');
                return $this->refresh();
            }
        }
        return $this->render('contact', ['model' => $model]);
    }

    public function actionReport() {
        $model = new ReportErrors();
        if( $model->load(Yii::$app->request->post()) ) { //&& $model->validate()
		$model->date_create = date('d.m.Y');
		$model->uid = Yii::$app->user->identity->id;
            if($model->save()) {
				Yii::$app->session->setFlash('reportFormSubmitted');
                return $this->refresh();
            }
        }
        return $this->render('report', ['model' => $model]);
    }
    
    /**
     * Displays about page.
     *
     * @return string
     */
}
