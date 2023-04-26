<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "camps_files".
 *
 * @property int $id
 * @property int $camp_id
 * @property int $file_type
 * @property string $file_src
 * @property string $file_original_name
 */
class CampsFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'camps_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['camp_id', 'file_type', 'file_src'], 'required'],
            [['camp_id', 'file_type'], 'integer'],
            [['file_src', 'file_original_name'], 'string'],
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
            'file_type' => 'File Type',
            'file_src' => 'File Src',
            'file_original_name' => 'File Original Name',
        ];
    }
}
