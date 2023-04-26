<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $uid
 * @property string $r_text
 * @property int $r_camp_id
 * @property string $r_user_name
 * @property int $r_moderate
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['r_user_id', 'r_camp_id', 'r_moderate'], 'integer'],
            [['r_text', 'r_user_name', 'r_date'], 'string'],
        ];
    }


	public function fields()
	{
		$fields = parent::fields();
		unset($fields['r_moderate']);
		return $fields;
	}

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'r_text' => 'R Text',
            'r_camp_id' => 'R Camp ID',
            'r_user_name' => 'R User Name',
            'r_moderate' => 'R Moderate',
        ];
    }
}
