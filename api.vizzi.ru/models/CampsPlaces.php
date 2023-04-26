<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "camps_files".
 *
 * @property int $id
 * @property int $camp_id
 * @property int $place_id
 * @property int $coordinate_1
 * @property int $coordinate_2
 * @property string $name
 * @property string $descr
 * @property string $addr
 */
class CampsPlaces extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'camps_places';
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
      [['descr', 'name', 'addr', 'distance', 'coordinate_1', 'coordinate_2', 'place_type', 'place_type_name'], 'string'],
      [['place_id', 'camp_id'], 'integer'],
    ];
  }

}
