<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "camps".
 *
 * @property int $id
 * @property string $name
 * @property string $center
 */
class Regions extends \yii\db\ActiveRecord
{

  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'regions';
  }


  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['id'], 'int'],
      [['name', 'center'], 'string'],
    ];
  }


}
