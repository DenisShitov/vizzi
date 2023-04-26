<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "child_data".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $ch_name
 * @property string $ch_surname
 * @property string $ch_thirdname
 * @property int $ch_birthday
 * @property int $ch_phone
 * @property int $ch_sor_date
 * @property int $ch_passport_date
 * @property string $ch_medfeatures
 * @property string $ch_snils
 * @property string $ch_sor
 * @property string $ch_polis
 * @property string $ch_photo_src
 * @property string $comment
 */
class ChildData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'child_data';
    }

    public function fields() {
      return ['id','parent_id', 'ch_sor_valid', 'ch_birthday', 'ch_polis_valid', 'ch_snils_valid', 'ch_name', 'ch_surname', 'ch_thirdname', 'ch_phone', 'ch_photo_src', 'ch_sor', 'ch_sor_src','ch_sor_date', 'ch_passport', 'ch_passport_src','ch_passport_date','ch_passport_valid', 'ch_snils', 'ch_snils_src','ch_snils_valid','ch_polis', 'ch_polis_src','ch_polis_valid','ch_medfeatures', 'ch_gender','comment'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'ch_sor_valid', 'ch_polis_valid', 'ch_snils_valid'], 'integer'],
            [['ch_name', 'ch_surname', 'ch_thirdname', 'ch_phone', 'ch_photo_src', 'ch_sor', 'ch_sor_src', 'ch_snils', 'ch_snils_src','ch_polis', 'ch_polis_src','ch_medfeatures', 'comment'], 'string'],
        ];
    }


    /**
     * {@inheritdoc}
     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => 'ID',
//            'parent_id' => 'Parent ID',
//            'ch_fio' => 'Ch Fio',
//            'ch_birthday' => 'Ch Birthday',
//            'ch_snils' => 'Ch Snils',
//            'ch_sor' => 'Ch Sor',
//            'ch_polis' => 'Ch Polis',
//            'comment' => 'Comment',
//        ];
//    }

  public function getCh_birthday() {
    return date("yyyy-MM-dd", $this->ch_birthday);
  }
}
