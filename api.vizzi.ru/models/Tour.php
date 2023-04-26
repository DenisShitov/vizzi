<?php

namespace app\models;

use Yii;


class Tour extends \yii\db\ActiveRecord
{

    public function getTags()
    {
      return $this->hasMany(TourTags::class, ['tour_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour';
    }
    public function fields() {
      return ['id', 'id_camp', 'tour_number', 'tour_price','tour_from', 'tour_to', 'tour_description', 'tour_program_description', 'tags'];
    }

//    public function fields() {
//      return ['id_camp', 'tour_number', 'tour_price', 'tour_from', 'tour_to', 'tour_description', 'tour_program_description', 'tags'];
//    }

    public function rules()
    {
        return [
            [['id_camp', 'tour_number', 'tour_price'], 'integer'],
            [['tour_from', 'tour_to', 'tour_description', 'tour_program_description'], 'string']
        ];
    }
    
}
