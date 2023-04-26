<?php
namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadPic extends Model
{
    public $myFiles;
    public $id;
    public $key;
    public $dhash;

    public function rules()
    {
        return [
            [['myFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => ['png','jpg','jpeg'], 'maxSize' => 1048576, 'message' => 'Неподходящий формат документа', 'tooBig' => 'Загрузите документ размером не более 1 MB'],
        ];
    }
    
	public function myUpload()
	{
		if ($this->validate()) {
			$file = $this->myFiles;
			$file->saveAs('cpics/pic_'.$this->id.$this->dhash.'.'.$this->myFiles->extension);
			return true;
		} else {
			return false;
		}
	}

  public function userUpload()
  {
    if ($this->validate()) {
      $file = $this->myFiles;
      $file->saveAs('upics/pic_'.$this->id.$this->dhash.'.'.$this->myFiles->extension);
      return true;
    } else {
      return false;
    }
  }
}