<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report_errors".
 *
 * @property int $id
 * @property int $uid
 * @property string $page
 * @property string $text
 */
class ReportErrors extends \yii\db\ActiveRecord
{
	
    public $verifyCode;	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_errors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'page', 'text'], 'required', 'message' => 'Заполните поле'],
            [['uid'], 'integer'],
			['verifyCode', 'captcha', 'captchaAction' => 'app/captcha'],
            [['page', 'text'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'ID пользователя',
            'page' => 'Страница',
            'text' => 'Описание',
        ];
    }
}
