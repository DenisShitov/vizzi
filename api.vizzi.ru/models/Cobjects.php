<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cobjects".
 *
 * @property int $id
 * @property string $obj_title
 * @property string $obj_desc
 * @property int $obj_type 1 - вторичка, 2 - земельный участок, 3 - дом
 * @property double $obj_cost
 * @property string $obj_address
 * @property double $obj_square_full
 * @property double $obj_square_kitchen
 * @property double $obj_square_rooms
 * @property string $obj_arenda_start
 * @property int $obj_rooms_count
 * @property string $obj_pic1
 * @property string $obj_pic2
 * @property string $obj_pic3
 * @property string $obj_char
 * @property string $obj_map
 * @property string $obj_banks
 * @property string $comment
 */
class Cobjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cobjects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['obj_title', 'obj_desc', 'obj_cost', 'obj_address', 'obj_square_full', 'obj_square_kitchen', 'obj_square_rooms', 'obj_arenda_start', 'obj_char', 'obj_map'], 'required'],
            [['obj_desc', 'obj_address', 'obj_pic1', 'obj_pic2', 'obj_pic3', 'obj_char', 'obj_map', 'obj_banks', 'comment'], 'string'],
            [['obj_type', 'obj_rooms_count'], 'integer'],
            [['obj_cost', 'obj_square_full', 'obj_square_kitchen', 'obj_square_rooms'], 'number'],
            [['obj_title', 'obj_arenda_start'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'obj_title' => 'Obj Title',
            'obj_desc' => 'Obj Desc',
            'obj_type' => 'Obj Type',
            'obj_cost' => 'Obj Cost',
            'obj_address' => 'Obj Address',
            'obj_square_full' => 'Obj Square Full',
            'obj_square_kitchen' => 'Obj Square Kitchen',
            'obj_square_rooms' => 'Obj Square Rooms',
            'obj_arenda_start' => 'Obj Arenda Start',
            'obj_rooms_count' => 'Obj Rooms Count',
            'obj_pic1' => 'Obj Pic1',
            'obj_pic2' => 'Obj Pic2',
            'obj_pic3' => 'Obj Pic3',
            'obj_char' => 'Obj Char',
            'obj_map' => 'Obj Map',
            'obj_banks' => 'Obj Banks',
            'comment' => 'Comment',
        ];
    }
}
