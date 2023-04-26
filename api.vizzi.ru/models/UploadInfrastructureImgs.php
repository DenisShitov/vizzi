<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadInfrastructureImgs extends Model
{
  public $input_file;
  public $camp_id;
  public $name;
  public $category;
  public $dhash;

  public function rules()
  {
    return [
      [['input_file'], 'file', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg'], 'maxSize' => 1048576, 'message' => 'Неподходящий формат документа', 'tooBig' => 'Загрузите документ размером не более 1 MB'],
    ];
  }

  private function transliterate($st) {
    $stOut = strtr($st, array(
      'а' => 'a', 'б' => 'b', 'в' => 'v',
      'г' => 'g', 'д' => 'd', 'е' => 'e',
      'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
      'и' => 'i', 'й' => 'y', 'к' => 'k',
      'л' => 'l', 'м' => 'm', 'н' => 'n',
      'о' => 'o', 'п' => 'p', 'р' => 'r',
      'с' => 's', 'т' => 't', 'у' => 'u',
      'ф' => 'f', 'х' => 'h', 'ц' => 'c',
      'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
      'ь' => '', 'ы' => 'y', 'ъ' => '',
      'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
      ' ' => '_',
      'А' => 'a', 'Б' => 'b', 'В' => 'v',
      'Г' => 'g', 'Д' => 'd', 'Е' => 'e',
      'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
      'И' => 'i', 'Й' => 'y', 'К' => 'k',
      'Л' => 'l', 'М' => 'm', 'Н' => 'n',
      'О' => 'o', 'П' => 'p', 'Р' => 'r',
      'С' => 's', 'Т' => 't', 'У' => 'u',
      'Ф' => 'f', 'Х' => 'h', 'Ц' => 'c',
      'Ч' => 'ch', 'Ш' => 'sh', 'Щ' => 'sch',
      'Ь' => '', 'Ы' => 'y', 'Ъ' => '',
      'Э' => 'e', 'Ю' => 'yu', 'Я' => 'ya'
    ));
    return $stOut;
  }

  /**
   * @return mixed
   */
  public function imageResize($file_name, $width, $height, $crop=FALSE)
  {
    list($wid, $ht) = getimagesize($file_name);
    $r = $wid / $ht;
    if ($crop) {
      if ($wid > $ht) {
        $wid = ceil($wid-($width*abs($r-$width/$height)));
      } else {
        $ht = ceil($ht-($ht*abs($r-$w/$h)));
      }
      $new_width = $width;
      $new_height = $height;
    } else {
      if ($width/$height > $r) {
        $new_width = $height*$r;
        $new_height = $height;
      } else {
        $new_height = $width/$r;
        $new_width = $width;
      }
    }
    $source = imagecreatefromjpeg($file_name);
    $dst = imagecreatetruecolor($new_width, $new_height);
    image_copy_resampled($dst, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
    return $dst;
  }

  public function myUpload()
  {
    if ($this->validate()) {
      $file = $this->input_file;
      $this->name = $this->transliterate($this->name);
      $this->category = $this->transliterate($this->category);
      $dir = 'infpic/'.$this->camp_id . '/' . $this->category;
      if(is_dir($dir)){
        $file->saveAs('infpic/' . $this->camp_id . '/' . $this->category . '/' . $this->name . '-' . $this->dhash . '.' . $this->input_file->extension);
        return true;
      } else {
        mkdir( $dir . '/' , 0777 , true);
        $file->saveAs('infpic/' . $this->camp_id . '/' . $this->category . '/' . $this->name . '-' . $this->dhash . '.' . $this->input_file->extension);
        return true;
      }
    } else {
      return false;
    }
  }
}