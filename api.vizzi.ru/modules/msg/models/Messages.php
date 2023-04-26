<?php

namespace app\modules\msg\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $date
 * @property int $to_id
 * @property int $from_id
 * @property string $text
 * @property int $reader
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'to_id', 'from_id', 'text'], 'required'],
            [['to_id', 'from_id', 'reader'], 'integer'],
            [['date'], 'safe'],
            [['text'], 'string'],
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
            'date' => 'Date',
            'to_id' => 'To ID',
            'from_id' => 'From ID',
            'text' => 'Text',
            'reader' => 'Reader',
        ];
    }
}
