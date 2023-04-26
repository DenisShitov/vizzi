<?php

namespace app\models;

use Yii;

class CampsSchedule extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'camps_schedule';
  }

  public static function primaryKey()
  {
    return ['id'];
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['time', 'description'], 'string'],
      [['camp_id', 'day', 'day_part', 'sort'], 'integer']
    ];
  }

}
