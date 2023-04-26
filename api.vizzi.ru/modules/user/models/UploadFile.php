<?php
namespace app\modules\user\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadFile extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg', 'maxSize' => 307200, 'message' => 'Загрузите изображение в формате: .jpg', 'tooBig' => 'Загрузите изображение размером не более 300 KB'],
			//image < 300 kb
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->image->saveAs('img/uploads/ava_' .Yii::$app->user->identity->typeuser.'_'. Yii::$app->user->identity->id . '.jpg');
            return true;
        } else {
            return false;
        }
    }
}