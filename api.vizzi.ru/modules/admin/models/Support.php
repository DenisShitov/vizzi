<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "advert".
 *
 * @property int $id
 * @property string $geo
 * @property int $target 1 - продажи и привлечение, 2 - имидж и узнаваемость
 * @property string $goodservice товар или услуга
 * @property int $cost_pr 1 - до 10, 2 - 10-50, 3 - от 50
 * @property int $net_pr 1 - all, 2 - yt, 3 -in, 4 - vk
 * @property string $concurent конкурентные преимущества
 * @property int $auditory 0 - all, 1 - women, 2 - men
 * @property int $age 0: all, 1: 0-6, 2: 7-12, 3: 13-17, 4: 18-25, 5: 26-34, 6: to 35
 * @property string $comment
 */
class Support extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'support';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['theme', 'name', 'email', 'msg'], 'required'],
            [['uid'], 'integer'],
			[['date_support'], 'date'],
            [['theme', 'name', 'email', 'msg'], 'string'],
            //[['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'theme' => 'Тема',
            'name' => 'Имя',
            'email' => 'E-mail',
            'msg' => 'Сообщение',
            'date_support' => 'Дата обращения',
			'uid' => 'ID пользователя'
        ];
    }
}
