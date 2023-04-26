<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favorites".
 *
 * @property int $id
 * @property int $type
 * @property int $uid
 * @property int $obj_id
 */
class Favorites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'uid', 'obj_id'], 'integer'],
            [['uid', 'obj_id'], 'required'],
        ];
    }
	
	public function fields()
	{
		$fields = parent::fields();
		unset($fields['uid']);
		return $fields;
	}

}
