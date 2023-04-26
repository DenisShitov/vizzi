<?php

namespace app\models;

use Yii;

class Orders extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */

  public function setCamp()
  {
    return false;
  }
  public function getCamp()
  {
    return $this->hasOne(Camps::class, ['id' => 'camp_id']);
  }
  public function setTour()
  {
    return false;
  }
  public function getTour()
  {
    return $this->hasOne(Tour::class, ['id' => 'tour_id']);
  }
  public function setChild()
  {
    return false;
  }
  public function getChild()
  {
    return $this->hasOne(ChildData::class, ['id' => 'child_id']);
  }
  public function setUser()
  {
    return false;
  }
  public function getUser()
  {
    return $this->hasOne(User::class, ['id' => 'user_id'])->select(['name', 'surname', 'thirdname', 'email', 'phone', 'passport', 'img_src', 'passp1_valid', 'passp2_valid']);
  }

  public static function tableName()
  {
    return 'orders';
  }

  public function fields()
  {
    return [
      'id', 'user_id', 'child_id', 'camp_id', 'tour_id', 'status', 'stage', 'comment', 'camp', 'tour', 'child', 'user'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['id', 'user_id', 'child_id', 'camp_id', 'tour_id', 'status', 'stage'], 'integer'],
      [['comment'], 'string'],
    ];
  }

}
