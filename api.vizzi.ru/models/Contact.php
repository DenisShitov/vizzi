<?php
namespace app\models;
use yii\db\ActiveRecord;
use yii\helpers\Url;

class Contact extends ActiveRecord
{
	public $verifyCode;
	
    public static function tableName()
    {
        return 'support';
    }
	
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Заполните поле'],
			[['email'], 'required', 'message' => 'Заполните поле'],
			[['theme'], 'required', 'message' => 'Заполните поле'],
			[['msg'], 'required', 'message' => 'Заполните поле'],
			['verifyCode', 'captcha', 'captchaAction' => Url::to('/app/captcha')],
            ['email', 'email', 'message' => 'Заполните поле в формате index@index.ru'],
        ];
    }	
	
}