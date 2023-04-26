<?php

namespace app\models;

use Yii;
use app\models\CampsCorrelation;

/**
 * This is the model class for table "camps".
 *
 * @property int $id
 * @property string $c_name
 * @property string $c_desc
 * @property string $c_desc_prog
 * @property string $c_desc_acc
 * @property string $c_desc_pay
 * @property string $c_iso
 * @property int $c_age_from
 * @property int $c_age_to
 * @property int $c_category
 * @property string $c_banner
 * @property string $c_logo
 * @property string $c_address
 * @property int $c_transfer
 * @property double $c_cost
 * @property int $c_season
 * @property int $c_duration
 * @property string $c_tags
 * @property double $c_rating
 * @property int $c_accommodation
 * @property int $c_nutrition
 * @property int $c_lim_op
 * @property string $c_map_coord
 * @property string $c_key
 * @property int $active
 * @property int $c_location
 * @property int $c_discount
 * @property int $c_haspool
 * @property int $c_guests
 * @property int $c_excursions
 * @property int $c_extreme
 * @property int $c_balanced
 * @property int $c_shift_capacity
 * @property string $comment
 *
 */
class Camps extends \yii\db\ActiveRecord
{

    public $ratingAll;
//    public $c_discount;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'camps';
    }

    public function getAmbassadors()
    {
      return $this->hasMany(Ambassadors::class, ['camp_id' => 'id']);
    }
    public function getEmployers()
    {
      return $this->hasMany(Employers::class, ['camp_id' => 'id']);
    }
    public function getTours()
    {
      return $this->hasMany(Tour::class, ['id_camp' => 'id']);
    }
    public function getCorrelation()
    {
      return $this->hasMany(CampsCorrelation::class, ['camp_id' => 'id'])->select('correlation_id');
    }
    public function getInfrastructure()
    {
      return $this->hasMany(InfrastructureImgs::class, ['camp_id' => 'id']);
    }
    public function getCampFiles()
    {
      return $this->hasMany(CampsFiles::class, ['camp_id' => 'id']);
    }
    public function getSchedule()
    {
      return $this->hasMany(CampsSchedule::class, ['camp_id' => 'id']);
    }
    public function fields()
    {
      return [
        'id','c_name','c_desc', 'c_desc_prog', 'c_desc_acc', 'c_desc_pay','c_logo' , 'c_banner', 'c_address', 'c_tags', 'c_map_coord', 'c_key', 'comment','c_age_from', 'c_region', 'c_age_to', 'c_duration', 'c_capacity', 'c_shift_capacity', 'c_balanced', 'c_discount', 'active','c_cost', 'c_rating_1', 'c_rating_2', 'c_rating_3', 'c_rating_4', 'ambassadors', 'employers', 'tours', 'infrastructure', 'campFiles', 'schedule', 'correlation', 'c_desc_meal', 'c_desc_transfer', 'c_desc_pool', 'c_desc_cashback',
      ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_name'], 'required'],
            [['c_desc', 'c_desc_prog', 'c_desc_acc', 'c_desc_pay','c_logo' , 'c_banner', 'c_address', 'c_tags', 'c_map_coord', 'c_desc_meal', 'c_desc_transfer', 'c_desc_pool', 'c_desc_cashback', 'c_key', 'comment'], 'string'],
            [['c_age_from', 'c_region', 'c_age_to', 'c_duration', 'c_capacity', 'c_shift_capacity', 'c_balanced', 'c_discount', 'active'], 'integer'],
            [['c_cost', 'c_rating_1', 'c_rating_2', 'c_rating_3', 'c_rating_4'], 'number'],
            [['c_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'c_name' => 'C Name',
            'c_desc' => 'C Desc',
            'c_iso' => 'C Iso',
            'c_age_from' => 'C Age From',
            'c_age_to' => 'C Age To',
            'c_category' => 'C Category',
            'c_banner' => 'C Banner',
            'c_address' => 'C Address',
            'c_transfer' => 'C Transfer',
            'c_cost' => 'C Cost',
            'c_season' => 'C Season',
            'c_duration' => 'C Duration',
            'c_tags' => 'C Tags',
            'c_rating' => 'C Rating',
            'c_accommodation' => 'C Accommodation',
            'c_nutrition' => 'C Nutrition',
            'c_lim_op' => 'C Lim Op',
            'c_haspool' => 'C Has Pool',
            'c_guests' => 'C Guests',
            'c_excursions' => 'C Excursions',
            'c_extreme' => 'C Extreme',
            'c_balanced' => 'C Balanced',
            'c_map_coord' => 'C Map Coord',
            'c_key' => 'C Key',
            'active' => 'Active',
            'comment' => 'Comment',
        ];
    }

}
