<?php
namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadFile extends Model
{
    public $myFiles;
    public $id;
    public $key;
    public $dhash;

    public function rules()
    {
        return [
            [['myFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => ['doc','pdf','txt','rtf'], 'maxSize' => 1048576, 'message' => 'Неподходящий формат документа', 'tooBig' => 'Загрузите документ размером не более 1 MB'],
        ];
    }
    
	public function myUpload()
	{
		if ($this->validate()) {
			$file = $this->myFiles;
			$file->saveAs('cdocs/doc_'.$this->id.$this->dhash.'.'.$this->myFiles->extension);
			return true;
		} else {
			return false;
		}
	}
}