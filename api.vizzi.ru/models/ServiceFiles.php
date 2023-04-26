<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "camps_files".
 *
 * @property int $id
 * @property int $service_id
 * @property int $file_type
 * @property string $file_src
 * @property string $file_name
 */
class ServiceFiles extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'service_files';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['service_id', 'file_type', 'file_src'], 'required'],
      [['service_id', 'file_type'], 'integer'],
      [['file_src', 'file_name'], 'string'],
    ];
  }

}
