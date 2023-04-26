<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadCampImages extends Model
{
  /**
   * @var UploadedFile[]
   */

  public $image;
  public $multiple = false;
  public $camp_id;

  public function rules()
  {
    return [
      [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, webp', 'maxFiles' => 20],
    ];
  }

  public function upload()
  {
    $dir = 'cpics/'. $this->camp_id . '/';
    if($this->validate()){
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

  private function saveFile() {
//    if ($this->multiple === true) {
//      foreach ($this->image as $file) {
//        $file->saveAs('cpics/'. $this->camp_id . '/' . $file->baseName . '.' . $file->extension);
//      }
//    } else {
//      $file = $this->image;
//      $file->saveAs('cpics/'. $this->camp_id . '/' . $file->baseName . '.' . $file->extension);
//    }
      foreach ($this->image as $file) {
        $file->saveAs('cpics/'. $this->camp_id . '/' . $file->baseName . '.' . $file->extension);
      }
  }
}