<?php
namespace app\models;

use Yii;

class UserInfo extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'user';
    }

	public function fields()
	{
		$fields = parent::fields();
		unset($fields['typeuser'],$fields['superuser'],$fields['username'],$fields['keyq'],$fields['manager'],$fields['auth_key'],$fields['password_hash'],$fields['password_reset_token'],$fields['status'],$fields['created_at'],$fields['updated_at'],$fields['access_token'],$fields['email_confirm'],$fields['active']);
		return $fields;
	}

}
