<?php

namespace app\models;

use Yii;


class Employers extends \yii\db\ActiveRecord
{

    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employers';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['camp_id', 'sort'], 'integer'],
            [['name', 'description', 'phone', 'email', 'img_src'], 'string']
        ];
    }
    
}
