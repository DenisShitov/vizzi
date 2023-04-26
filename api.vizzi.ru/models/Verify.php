<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "verify".
 *
 * @property int $id
 * @property string $email
 * @property string $token
 */
class Verify extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verify';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'token'], 'required'],
            [['email', 'token'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'token' => 'Token',
        ];
    }
}
