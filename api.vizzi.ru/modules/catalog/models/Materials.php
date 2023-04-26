<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "materials".
 *
 * @property int $id
 * @property string $name
 * @property int $type 1 - news, 2 - doc/stat
 * @property string $content
 * @property string $img
 * @property string $date_create
 */
class Materials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'content', 'img', 'date_create'], 'required'],
            [['type'], 'integer'],
            [['content', 'img'], 'string'],
            [['date_create'], 'safe'],
            [['name'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'content' => 'Content',
            'img' => 'Img',
            'date_create' => 'Date Create',
        ];
    }
}
