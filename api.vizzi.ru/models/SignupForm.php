<?php
 
namespace app\models;
 
use Yii;
use yii\base\Model;

use app\models\Verify;
 
/**
 * Signup form
 */
class SignupForm extends Model
{
 
    public $name;	
    public $email;
	//public $phone;
	public $typeuser;
	public $cart_id;
    public $password;
    public $keyq;
    //public $verifyCode;	
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //['username', 'trim'],
            //[['username','email'], 'required', 'message' => 'Заполните поле'],
            //['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот логин уже занят'],
            //['username', 'string', 'min' => 3, 'max' => 255],
			//['phone', 'required', 'message' => 'Заполните поле'],
			//['phone', 'trim'],
			//['phone', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот телефон уже используется'],
			//['typeuser', 'required', 'message' => 'Пожалуйста, выберите Ваш вариант'],
            ['email', 'trim'],
			['email', 'required', 'message' => 'Введите e-mail'],
			//['typeuser', 'required', 'message' => 'Выберите Ваше призвание'],
			['name', 'required', 'message' => 'Введите Ваше имя'],
            ['email', 'email', 'message' => 'Заполните поле в формате index@index.ru'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот e-mail уже используется'],
			//['verifyCode', 'captcha', 'captchaAction' => 'app/captcha'],
            ['password', 'required', 'message' => 'Заполните поле'],
            ['password', 'string', 'min' => 6],
        ];
    }
 
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
 
        if (!$this->validate()) {
            return null;
        }
		
		$tokenus = Yii::$app->security->generateRandomString();
		
 
        $user = new User();
        //$user->username = $this->username;
        $user->email = $this->email;
		$user->name = $this->name;
		
		// temp data
		$user->email_confirm = 1;
		$user->active = 1;

		//$user->cart_id = 0;
        $user->keyq = Yii::$app->security->generateRandomString();
        $user->setPassword($this->password);
        $user->generateAuthKey();

/* 		
		$verify = new Verify();
		$verify->email = $this->email;
		$verify->token = $tokenus;
		$verify->save();
		$url_gen = 'http://'.$_SERVER['SERVER_NAME'];

		$email_body = '<div style="font-family:Calibri;font-size:14px;border: 5px solid #ccc;padding:15px;"><h2>Здравствуйте, '.$this->name.'!</h2><p>Подтвердите Ваш E-mail для продолжения работы с сервисом "Firestarter".</p><p>Перейдите по ссылке ниже:<br><a href="'.$url_gen.'/app/verify?token='.$tokenus.'" style="color:#467fcf;">'.$url_gen.'/app/verify?token='.$tokenus.'</a></p><p><br>Спасибо!<br>Команда <b>Firestarter</b></p></div>';

		Yii::$app->mailer->compose()
		->setTo($this->email)
		->setFrom(['support@firestarter.host'])
		->setSubject('[Firestarter] Подтверждение E-mail')
		->setHtmlBody($email_body)
		->send(); */
		
		return $user->save() ? $user : null;
		
    }
 
}