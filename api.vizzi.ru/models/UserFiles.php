<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "child_data".
 *
 * @property int $id
 * @property int $user_id
 * @property string $file_type
 * @property string $file_src
 * @property string $file_name
 * @property int $child_id
 */
class UserFiles extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'user_files';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['id', 'user_id', 'child_id'], 'integer'],
      [['file_type', 'file_src', 'file_name'], 'string'],
    ];
  }
}
