<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadUserFiles extends Model
{
  public $userFile;
  public $user_id;
  public $child_id=null;
  public $hash;
  public $file_type;
  public $src;

  public function rules()
  {
    return [
      [['userFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, doc, docx, pdf, xls, xlsx', 'maxSize' => 3000000],
    ];
  }

  public function upload()
  {
    if ($this->validate()) {
      $dir = 'ufiles/'. $this->user_id . '/';
      if(!is_dir($dir)) {
        mkdir( $dir . '/' , 0777 , true);
      }
      $id = $this->child_id ?? 'n';
      $this->src = 'ufiles/' . $this->user_id . '/' . $this->file_type . $id . $this->hash . '.' . $this->userFile->extension;
      $this->userFile->saveAs($this->src);
      return true;
    } else {
      return false;
    }
  }
}