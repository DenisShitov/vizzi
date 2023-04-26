<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "camps_files".
 *
 * @property int $id
 * @property string $type
 * @property string $name
 */
class PlacesTypes extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'places_types';
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
      [['type', 'name'], 'required'],
      [['type', 'name'], 'string'],
    ];
  }

}
