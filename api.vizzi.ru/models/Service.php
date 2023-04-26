<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "camps".
 *
 * @property int $id
 * @property int $id_camp
 * @property string $name
 * @property string $address
 * @property int $price
 * @property int $discount
 * @property int $season
 * @property int $transfer
 * @property string $description
 * @property int $duration
 * @property int $invalid
 * @property int $attractions
 * @property int $meal
 * @property int $kids
 * @property int $photoplace
 * @property int $dayoff
 * @property int $guide
 * @property int $yourself
 * @property int $anyweather
 * @property int $age_from
 * @property int $age_to
 * @property int $position
 * @property int $hobby
 * @property int $comfort

 */
class Service extends \yii\db\ActiveRecord
{

  public $ratingAll;

  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'services';
  }


  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['name', 'address', 'price', 'season', 'transfer', 'description'], 'required'],
      [['name', 'address', 'region' ,'description'], 'string'],
      [['price', 'discount', 'season', 'transfer', 'duration', 'invalid', 'attractions', 'meal', 'kids', 'photoplace', 'dayoff', 'guide', 'yourself', 'anyweather', 'age_from', 'age_to', 'position', 'hobby', 'comfort'], 'integer'],
      [['discount'], 'integer', 'max' => 100],
    ];
  }



}
