<?php
namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
//use app\models\Cobjects;

class UploadImg1 extends Model
{
    public $image;
    public $id;

    public function rules()
    {
        return [
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => ['jpg','jpeg','png'], 'maxSize' => 307200, 'message' => 'Загрузите изображение в формате: .jpg', 'tooBig' => 'Загрузите изображение размером не более 300 KB'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
			//$date_hash = date("Y_m_d_H_i");
				$this->image->saveAs('img/_uploads/pic'.$this->id.'_1.'.$this->image->extension);
            return true;
        } else {
            return false;
        }
    }
}