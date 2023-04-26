<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\User;
use app\models\ChildData;

class UploadUserPhoto extends Model
{
  public $photo;
  public $parent_id;
  public $child_id=null;
  public $dhash;

  public function rules()
  {
    return [
      [['photo'], 'file', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg', 'webp'], 'maxSize' => 1048576, 'message' => 'Неподходящий формат документа', 'tooBig' => 'Загрузите документ размером не более 1 MB'],
    ];
  }

  private function imageCheck($src) {
    $newSrc = '/var/www/api.vizzi.ru/web' . $src;
    if (is_file($newSrc)) {
      unlink($newSrc);
    }
  }

  private function saveFile() {
    $file = $this->photo;
    if ($this->child_id) {
      $src = 'ufiles/' . $this->parent_id . '/chphoto-' . $this->child_id . '-' . $this->dhash . '.' . $this->photo->extension;
      $this->imageCheck(ChildData::find()->where(['id' => $this->child_id])->select('ch_photo_src')->one()->ch_photo_src);
      $file->saveAs($src);
    } else {
      $src = 'ufiles/' . $this->parent_id . '/photo-' . $this->dhash . '.' . $this->photo->extension;
      $this->imageCheck(User::find()->where(['id' => $this->parent_id])->select('img_src')->one()->img_src);
      $file->saveAs($src);
    }
  }

  public function myUpload()
  {
    if ($this->validate()) {
      $dir = 'ufiles/'. $this->parent_id . '/';
      if(is_dir($dir)) {
        $this->saveFile();
      } else {
        mkdir( $dir . '/' , 0777 , true);
        $this->saveFile();
      }
      return true;
    } else {
      return false;
    }
  }
}