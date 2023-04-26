<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadDocs extends Model
{
  public $doc_file;
  public $parent_id;
  public $child_id;
  public $doc_type;
  public $dhash;

  public function rules()
  {
    return [
      [['doc_file'], 'file', 'skipOnEmpty' => false, 'extensions' => ['docx', 'doc', 'pdf', 'txt', 'rtf', 'png', 'jpg'], 'maxSize' => 1048576, 'message' => 'Неподходящий формат документа', 'tooBig' => 'Загрузите документ размером не более 1 MB'],
    ];
  }

  public function myUpload()
  {
    if ($this->validate()) {
      $file = $this->doc_file;
      $file->saveAs('ufiles/' . $this->doc_type . '_' . $this->parent_id . '-' . $this->child_id . '-' . $this->dhash . '.' . $this->doc_file->extension);
      return true;
    } else {
      return false;
    }
  }
}