<?php

namespace app\models;

use Yii;


class TourTags extends \yii\db\ActiveRecord
{

  public function getTag()
  {
    return $this->hasOne(Tags::class, ['id' => 'tag_id']);
  }

  public function setTag()
  {
    return false;
  }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour_tags';
    }

    public function fields()
    {
      return ['tag'];
    }

  /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id', 'tag_id'], 'integer'],
        ];
    }
    
}
