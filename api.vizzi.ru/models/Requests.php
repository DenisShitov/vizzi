<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requests".
 *
 * @property int $id
 * @property string $req_date
 * @property string $r_name
 * @property string $r_phone
 * @property string $r_email
 * @property string $comment
 */
class Requests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['req_date', 'r_name', 'r_phone'], 'required'],
            [['comment'], 'string'],
            [['req_date', 'r_name', 'r_phone', 'r_email'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'req_date' => 'Req Date',
            'r_name' => 'R Name',
            'r_phone' => 'R Phone',
            'r_email' => 'R Email',
            'comment' => 'Comment',
        ];
    }
}
