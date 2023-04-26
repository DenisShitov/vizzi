<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "camps".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 */
class Correlation extends \yii\db\ActiveRecord
{

  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'correlation';
  }


  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['sort_order'], 'integer'],
      [['name', 'type', 'icon'], 'string']
    ];
  }


}
