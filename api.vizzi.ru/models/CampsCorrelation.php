<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "camps_files".
 *
 * @property int $camp_id
 * @property int $correlation_id
 */
class CampsCorrelation extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'camp_correlation';
  }

  public static function primaryKey()
  {
    return ['camp_id'];
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['camp_id', 'correlation_id'], 'integer'],
    ];
  }

}
