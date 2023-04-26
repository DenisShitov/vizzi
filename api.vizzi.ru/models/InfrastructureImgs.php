<?php

namespace app\models;

use Yii;

class InfrastructureImgs extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'infrastructure_imgs';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['camp_id', 'src'], 'required'],
      [['camp_id'], 'integer'],
      [['category', 'name', 'src'], 'string'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'camp_id' => 'Camp ID',
      'name' => 'Name',
      'category' => 'Category',
      'src' => 'Src',
    ];
  }
}
