<?php

namespace app\models;

use Yii;


class Ambassadors extends \yii\db\ActiveRecord
{

    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ambassadors';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['camp_id', 'sort'], 'integer'],
            [['name', 'description', 'img_src'], 'string']
        ];
    }
    
}
