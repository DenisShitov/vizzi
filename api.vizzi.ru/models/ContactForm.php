<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $theme;
    public $msg;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            [['name'], 'required', 'message' => 'Заполните поле'],
			[['email'], 'required', 'message' => 'Заполните поле'],
			[['theme'], 'required', 'message' => 'Заполните поле'],
			[['msg'], 'required', 'message' => 'Заполните поле'],
			
			['verifyCode', 'captcha', 'captchaAction' => 'app/captcha'],
            ['email', 'email', 'message' => 'Заполните поле в формате index@index.ru'],
            // verifyCode needs to be entered correctly
            //[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LcHnxoUAAAAAMfJnGTWCom7YisjPm2b8ITkoDlz'],
        ];
    }

    /**
     * @return array customized attribute labels
     
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }
*/

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */

	 
    public function contact()
    {
        if (!$this->validate()) {
            return null;
        }
		// date_support	 theme	 name	email	msg	uid
        $contact = new Contact();
		$contact->date_support = date('d-m-Y');
		$contact->uid = Yii::$app->user->identity->id;		
		$contact->name = $this->name;
		$contact->email = $this->email;
		$contact->theme = $this->theme;
		$contact->msg = $this->msg;
        return $contact->save();
    }
	
	
}