<?php

namespace app\models;

use Yii;


class Tags extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['name', 'img_src'], 'string']
        ];
    }
    
}
