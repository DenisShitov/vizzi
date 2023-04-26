<?php
namespace app\modules\api\controllers;
use app\models\CampsFiles;
use app\models\TourTags;
use app\models\UploadCampImages;
use app\models\UploadCampFiles;
use yii\base\BaseObject;
use yii\rest\ActiveController;
use app\models\Tour;
use app\models\Camps;
use app\models\CampsCorrelation;
use app\models\Correlation;
use app\models\Regions;
use app\models\CampsPlaces;
use app\models\PlacesTypes;
use app\models\CampsSchedule;
use app\models\InfrastructureImgs;
use app\models\Ambassadors;
use app\models\Employers;
use app\models\Tags;
use yii\httpclient\Client;

use Yii;
use yii\db\Query;
use yii\web\UploadedFile;

class CampsController extends ActiveController
{

  /*
  ?offset=10&limit=10
  */

  public $modelClass = 'app\models\Camps';

  public static function allowedDomains()
  {
    return [
      '*',
      'http://localhost:3000',
      'http://localhost:3001/',
    ];
  }

  public function behaviors()
  {
    $behaviors = parent::behaviors();
    $behaviors['corsFilter'] = [
      'class' => \yii\filters\Cors::className(),
      'cors' => [                   // restrict access to domains:
        'Origin' => ['*'],
        'Access-Control-Request-Method' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
        'Access-Control-Request-Headers' => ['*'],
        'Access-Control-Allow-Credentials' => false,
        'Access-Control-Max-Age' => 3600,
        'Access-Control-Expose-Headers' => [],
      ],
    ];
    $behaviors['contentNegotiator'] = [
      'class' => \yii\filters\ContentNegotiator::className(),
      'formats' => [
        'application/json' => \yii\web\Response::FORMAT_JSON,
      ]
    ];

    return $behaviors;
  }


  public function actions()
  {
    $actions = parent::actions();

    $actions['index']['dataFilter'] = [
      'class' => \yii\data\ActiveDataFilter::class,
      'searchModel' => $this->modelClass,
    ];

    return $actions;
  }

  public function actionNewSearchCamps() {
    $data = Yii::$app->request->post();
    $search = Camps::find()->leftJoin('camp_correlation', 'camp_correlation.camp_id = camps.id')->leftJoin('correlation', 'correlation.id = camp_correlation.correlation_id');
    $query = new Query;
    $query->select(['*', '(c_cost - (c_cost * (c_discount * 0.01))) AS cost'])->from('camps');
    
    if (count($data['corr_array']) > 0) {
      $query->leftJoin("camp_correlation", "camps.id = camp_correlation.camp_id")->andWhere(['correlation_id' => $data['corr_array']]);
    }

    if($data['age'] > 0) {
      $query->andWhere(['and',['<=', 'c_age_from', $data['age']],['>=', 'c_age_to', $data['age']]]);
    }

    if(count($data['cost']) > 0){
      $query->having(['between', 'cost', $data['cost'][0], $data['cost'][1]]);
    }

    if($data['discount']){
      $query->andWhere(['>', 'c_discount', 0]);
    }

    if($data['mir_discount']){
      $query->andWhere(['>', 'c_mir_discount', 0]);
    }

    if($data['sort_name']){
      $query->orderBy([$data['sort_name'] => $data['sort_dir'] === 'SORT_ASC' ? SORT_ASC : SORT_DESC]);
    }

    return $query->all();
  }

  public function actionGetCampById() {
    $data = Yii::$app->request->post();
    $camp = Camps::find()->where(['id' => $data['id']])->one();
    return $camp;
  }

  public function actionCorrelation()
  {
    $corr = Yii::$app->db->createCommand('SELECT * FROM `correlation` LEFT JOIN (SELECT correlation_id, COUNT(*) AS count FROM camp_correlation GROUP BY correlation_id) test ON correlation.id = test.correlation_id')->queryAll();
    $corr1 = Correlation::find()->all();
    return $corr;
  }

  public function actionCorrById()
  {
    $data = Yii::$app->request->post();
    $id = $data['id'];
    $corr = CampsCorrelation::find()->where(['camp_id' => $id])->select('correlation_id')->asArray()->all();
    return $corr;
  }

  public function actionCorrtableCount() {
    $data = Yii::$app->request->post();
    $corr_id = $data['id'];
    $out = CampsCorrelation::find()->where(['correlation_id' => $corr_id])->count();
    return $out;
  }

  public function actionGetCompilationByCorr() {
    $data = Yii::$app->request->post();
    $compilation = null;
    if (count($data['idArr']) > 0){
      $ids = [];
      $query = new Query;
      $query2 = new Query;
      $query->select(['*'])->from('camps')
        ->leftJoin("camp_correlation", "camps.id = camp_correlation.camp_id")
        ->where(['camp_correlation.correlation_id' => $data['idArr']]);
      $query2->select(['*'])->from('camps')
        ->leftJoin("camp_correlation", "camps.id = camp_correlation.camp_id")
        ->where(['camp_correlation.correlation_id' => $data['mainCorrId']]);
      $queryArr = $query->union($query2)->all();
      $input = [];
      for($j=0; $j<count($queryArr); $j++){
        $input[] = $queryArr[$j]['id'];
      }
      $result = array_count_values($input);
      foreach ($result as $key => $value) {
        if($value > 1){
          $ids[] = $key;
        }
      }
      $compilation = Camps::find()
        ->where(['id' => $ids])
        ->asArray()
        ->all();
    } else {
      $compilation = Camps::find()->
      leftJoin("camp_correlation", "camps.id = camp_correlation.camp_id")->
      where(['camp_correlation.correlation_id' => $data['mainCorrId']])->
      asArray()->
      all();
    }
    return $compilation;
  }

  public function actionRegions()
  {
    $regions = Regions::find()->all();
    return $regions;
  }

  public function actionCompilation() {
    if (Yii::$app->request->get()) {
      $data = Yii::$app->request->get();
      $compilation = Camps::find()->
      leftJoin("camp_correlation", "camps.id = camp_correlation.camp_id")->
      where(['camp_correlation.correlation_id' => $data['id']])->
      asArray()->
      all();
      return $compilation;
    }
  }

  public function actionTour()
  {
    $data = Yii::$app->request->get();
    if(isset($data['tour_id'])) {
      $tour = Tour::find()->where(['id' => $data['tour_id']])->all();
    } else {
      $tour = Tour::find()->where(['id_camp' => $data['id_camp']])->all();
    }
    if ($tour) {
      return $tour;
    }
  }

  public function actionTakePrices()
  {

    if (Yii::$app->request) {

      $prices = Yii::$app->db->createCommand('SELECT c_cost, c_discount FROM camps ORDER BY c_cost ASC')
        ->queryAll();
      $new_list = [];
      foreach ($prices as $price){
        if ($price['c_discount'] > 0) {
          $new_list[] = (int)$price['c_cost']*$price['c_discount']/100;
        } else {
          $new_list[] = (int)$price['c_cost'];
        }
      }
      sort($new_list);
      return $new_list;
    }
  }

  public function actionGetInfrastructurePics()
  {
    $data = Yii::$app->request->post();
    $camp_id = $data['camp_id'];
    $pics = InfrastructureImgs::find()->where(['camp_id' => $camp_id])->asArray()->all();
    if(count($pics) > 0){
      return $pics;
    } else {
      return 'Pictures not found';
    }
  }

  public function actionTakePriceFork()
  {
    if (Yii::$app->request) {
      $price = Yii::$app->db->createCommand('SELECT MIN(c_cost) AS min_cost, MAX(c_cost) AS max_cost FROM camps')->queryAll();
      return $price;
    }
  }
  public function actionTakeCapacityFork()
  {
    if (Yii::$app->request) {
      $capacity = Yii::$app->db->createCommand('SELECT MIN(c_capacity) AS min_capacity, MAX(c_capacity) AS max_capacity FROM camps')->queryAll();
      return $capacity;
    }
  }

  public function actionTakeShiftCapacityFork()
  {
    if (Yii::$app->request) {
      $capacity = Yii::$app->db->createCommand('SELECT MIN(c_shift_capacity) AS min_capacity, MAX(c_shift_capacity) AS max_capacity FROM camps')->queryAll();
      return $capacity;
    }
  }

  public function actionUploadCampFiles() {
    $data = Yii::$app->request->post();
    if($data['file_type'] == 1) {
      $model = new UploadCampFiles();
    } else {
      $model = new UploadCampImages();
    }
    $model->camp_id = $data['camp_id'];
    if($data['multiple'] != null){
      $model->multiple = true;
    }
    $model->image = UploadedFile::getInstancesByName('images');
    if ($model->upload()) {
      if($data['file_type'] == 2){
        return true;
      }
      if($data['multiple']) {
        foreach ($model->image as $image) {
          $upd_obj = new CampsFiles();
          $upd_obj->camp_id = $data['camp_id'];
          $upd_obj->file_type = $data['file_type'];
          if($data['file_type'] == 1){
            $upd_obj->file_original_name = $image->baseName;
          }
          $upd_obj->file_src = '/cpics/'. $data['camp_id'] . '/' . $image->baseName . '.' . $image->extension;
          $upd_obj->save();
        }
      } else {
          $upd_obj = new CampsFiles();
          $upd_obj->camp_id = $data['camp_id'];
          $upd_obj->file_type = $data['file_type'];
          if($data['file_type'] == 1){
            $upd_obj->file_original_name = $model->images->baseName;
          }
          $upd_obj->file_src = '/cpics/'. $data['camp_id'] . '/' . $model->images->baseName . '.' . $model->images->extension;
          $upd_obj->save();
        }
      return 'Фото загружено';
    } else {
      return $model->upload();
    }
  }

  public function actionDeleteCampImage() {
    $data = Yii::$app->request->post();
    CampsFiles::find()
      ->where(['file_src' => $data['src']])
      ->one()
      ->delete();
//    unlink('/var/www/api.vizzi.ru/web' . $data['src']);
    return 'deleted';
  }

  public function transcription()
  {
    return
    [
      'q' => 'й',
      'w' => 'ц',
      'e' => 'у',
      'r' => 'к',
      't' => 'е',
      'y' => 'н',
      'u' => 'г',
      'i' => 'ш',
      'o' => 'щ',
      'p' => 'з',
      'a' => 'ф',
      's' => 'ы',
      'd' => 'в',
      'f' => 'а',
      'g' => 'п',
      'h' => 'р',
      'j' => 'о',
      'k' => 'л',
      'l' => 'д',
      'z' => 'я',
      'x' => 'ч',
      'c' => 'с',
      'v' => 'м',
      'b' => 'и',
      'n' => 'т',
      'm' => 'ь'
    ];
  }

  public function actionSearchByName() {
      if (Yii::$app->request->post()){
          $data = Yii::$app->request->post();
          $search = Camps::find()
              ->where(['LIKE', 'c_name', $data['search']])
              ->orWhere(['LIKE', 'c_address', $data['search']])
              ->orWhere(['LIKE', 'c_tags', $data['search']])
              ->all();
          if(!$search){
            $newSearch = mb_strtolower($data['search']);
            $newSearch = str_split($newSearch);
            $string = '';
            foreach ($newSearch as $sign) {
              $string .= $this->transcription()[$sign];
            }
            $search = Camps::find()
              ->where(['LIKE', 'c_name', $string])
              ->orWhere(['LIKE', 'c_address', $string])
              ->orWhere(['LIKE', 'c_tags', $string])
              ->all();
          };
          return $search;
      }
  }

  public function actionUploadPlaceCoordsId() {
    $data = Yii::$app->request->post();
    if (isset($data['place_id'])) {
      if(CampsPlaces::find()->where(['place_id' => $data['place_id']])->andWhere(['camp_id' => $data['camp_id']])->count() == 0) {
        $new_place = new CampsPlaces();
        $new_place->camp_id = $data['camp_id'];
        $new_place->place_id = $data['place_id'];
        $new_place->place_type = $data['place_type'];
        $new_place->place_type_name = $data['place_type_name'];
        $new_place->name = $data['name'];
        $new_place->descr = $data['descr'];
        $new_place->addr = $data['addr'];
        $new_place->distance = $data['distance'];
        $new_place->coordinate_1 = $data['coordinate_1'];
        $new_place->coordinate_2 = $data['coordinate_2'];
        $new_place->save();
      } else {
        return 'Такая запись существует';
      }
    } else {
      return 'Отсутствует ID';
    }
  }

//  public function actionGetPlacesCoords() {
//      $data = Yii::$app->request->post();
//      $types = PlacesTypes::find()->all();
//      $count = 0;
//      foreach ($types as $key => $val) {
//        $text = $val->name;
//        $out = $this->getPlacesResponse($text, $data['coord']);
//        if(isset($out)){
//          foreach ($out as $value) {
//            $place_coordinates = $value->geometry->coordinates;
//            $place_id = $value->properties->CompanyMetaData->id;
//            $place_name = $value->properties->name;
//            $place_description = $value->properties->description;
//            $place_addr = $value->properties->CompanyMetaData->address;
//            if(
//              CampsPlaces::find()->where(['place_id' => $place_id])->count() == 0 &&
//              CampsPlaces::find()->where(['camp_id' => $data['camp_id']])->count() == 0
//            ){
//              $new_place = new CampsPlaces();
//              $new_place->camp_id = (int)$data['camp_id'];
//              $new_place->place_id = (int)$place_id;
//              $new_place->place_type = $val->type;
//              $new_place->place_type_name = $text;
//              $new_place->name = $place_name;
//              $new_place->descr = $place_description;
//              $new_place->addr = $place_addr;
//              $new_place->coordinate_1 = (string)$place_coordinates[0];
//              $new_place->coordinate_2 = (string)$place_coordinates[1];
//              $new_place->save();
//              $count++;
//            }
//          }
//        }
//      }
//    return $count;
//  }

//  public function getPlacesResponse($text, $ll) {
//    $client = new Client();
//    $spn = '';
//     if ($text == 'аэровокзал' || $text == 'ж/д вокзал' || $text == 'автовокзал') {
//      return null;
//     } else {
//       $spn = '0.05,0.05';
//       $response = $client->createRequest()
//         ->setMethod('get')
//         ->setUrl('https://search-maps.yandex.ru/v1/')
//         ->setData([
//           'text' => $text,
//           'type' => 'biz',
//           'll' => $ll,
//           'spn' => $spn,
//           'lang' => 'ru_RU',
//           'apikey' => '259749b1-7a8e-444c-9862-114cfceae6fb',
//           'results' => '5'])
//         ->send();
//       $out1 = json_decode($response->content);
//       $out = $out1->features;
//       return $out;
//     }
//  }
  public function actionGetCampPlaces() {
    $data = Yii::$app->request->post();
    $id = $data['id'];
    $out = CampsPlaces::find()->where(['=', 'camp_id', $id])->all();
    return $out;
  }

  public function actionGetSchedule() {
    $data = Yii::$app->request->post();
    $id = $data['camp_id'];
    $schedules = CampsSchedule::find()->where(['=', 'camp_id', $id])->asArray()->all();
    return $schedules;
  }

  public function actionUpdateCampDatabaseField() {
    $data = Yii::$app->request->post();
    $camp = Camps::find()->
      where(['id' => $data['campId']])->
      one();
    $camp->{$data['field']} = $data['value'];
    $camp->save();
    return true;
  }

  public function actionUpdateCampTours() {
    $data = Yii::$app->request->post();
    $oldTour = Tour::find()->where(['id_camp' => $data['camp_id']])->one();
    TourTags::deleteAll(['tour_id' => $oldTour->id]);
    Tour::deleteAll(['id_camp' => $data['camp_id']]);
    foreach ($data['tours'] as $tour) {
      $newObj = new Tour();
      $newObj->id_camp = $data['camp_id'];
      $newObj->tour_number = $tour['tour_number'];
      $newObj->tour_from = $tour['tour_from'];
      $newObj->tour_to = $tour['tour_to'];
      $newObj->tour_description = $tour['tour_description'];
      $newObj->tour_program_description = $tour['tour_program_description'];
      $newObj->tour_price = $tour['tour_price'];
      $newObj->save();
      if (!$newObj->save()) {
        return $newObj->errors;
      }
        foreach ($tour['tags'] as $tag) {
          $newTag = new TourTags();
          $newTag->tour_id = $newObj->id;
          $newTag->tag_id = $tag;
          $newTag->save();
        }
    }
    return 'Сохранено';
  }

  public function actionUpdateCampCorr() {
    $data = Yii::$app->request->post();
    CampsCorrelation::deleteAll(['camp_id' => $data['camp_id']]);
    foreach ($data['corr_arr'] as $corr) {
      $newObj = new CampsCorrelation();
      $newObj->camp_id = $data['camp_id'];
      $newObj->correlation_id = $corr;
      $newObj->save();
      if(!$newObj->save()){
        return $newObj->errors;
      }
    }
    return 'Сохранено';
  }

  public function actionGetTags() {
    return Tags::find()->all();
  }

  public function actionUpdateCampSchedule() {
    $data = Yii::$app->request->post();
    CampsSchedule::deleteAll(['camp_id' => $data['camp_id']]);
    foreach($data['array'] as $item){
      $newObj = new CampsSchedule();
      $newObj->camp_id = $data['camp_id'];
      $newObj->day = $item['day'];
      $newObj->day_part = $item['day_part'];
      $newObj->sort = $item['sort'];
      $newObj->time = $item['time'];
      $newObj->description = $item['description'];
      $newObj->save();
      if(!$newObj->save()){
        return $newObj->errors;
      }
    }
    return 'Сохранено';
  }

  public function actionAddBlankCamp() {
    $data = Yii::$app->request->post();
    $camp = new Camps();
    $camp->c_name = $data['c_name'];
    $camp->save();
    return 'Сохранено';
  }

  public function actionRemoveCamp() {
    $data = Yii::$app->request->post();
    Camps::deleteAll(['id' => $data['camp_id']]);
    return 'Лагерь удален';
  }

  public function actionGetAmbassadors() {
    $data = Yii::$app->request->post();
    return Ambassadors::find()->where(['camp_id' => $data['camp_id']])->all();
  }

  public function actionAddBlankAmbassador() {
    $data = Yii::$app->request->post();
    $newObj = new Ambassadors();
    $newObj->camp_id = $data['camp_id'];
    $newObj->sort = $data['sort'];
    $newObj->save();
    if(!$newObj->save()){
      return $newObj->errors;
    }
    return 'Новая запись создана';
  }

  public function actionUpdateAmbassadorDatabaseField() {
    $data = Yii::$app->request->post();
    $obj = Ambassadors::find()->where(['id' => $data['id']])->one();
    $obj->{$data['field']} = $data['value'];
    $obj->save();
    if(!$obj->save()){
      return $obj->errors;
    }
    return 'Изменения сохранены';
  }

  public function actionUpdateAmbassadorImage() {
    $data = Yii::$app->request->post();
    $obj = Ambassadors::find()->where(['id' => $data['id']])->one();
    if($obj->img_src){
      $src = '/var/www/api.vizzi.ru/web' . $obj->img_src;
      if (is_file($src)) {
        unlink($src);
      }
    }
    $model = new UploadCampImages();
    $model->camp_id = $obj->camp_id;
    $model->image = UploadedFile::getInstancesByName('image');
    if($model->upload()){
      $obj->img_src = '/cpics/'. $obj->camp_id . '/' . $model->image[0]->baseName . '.' . $model->image[0]->extension;
      $obj->save();
    }
    if(!$obj->save()){
      return $obj->errors;
    }
    return 'Изменения сохранены';
  }

  public function actionRemoveAmbassador() {
    $data = Yii::$app->request->post();
    $obj = Ambassadors::find()->where(['id' => $data['id']])->one();
    $src = '/var/www/api.vizzi.ru/web' . $obj->img_src;
    if (is_file($src)) {
      unlink($src);
    }
    Ambassadors::deleteAll(['id' => $data['id']]);
    return 'Удалено';
  }

  public function actionGetEmployers() {
    $data = Yii::$app->request->post();
    return Employers::find()->where(['camp_id' => $data['camp_id']])->all();
  }

  public function actionAddBlankEmployer() {
    $data = Yii::$app->request->post();
    $newObj = new Employers();
    $newObj->camp_id = $data['camp_id'];
//    $newObj->sort = $data['sort'];
    $newObj->save();
    if(!$newObj->save()){
      return $newObj->errors;
    }
    return 'Новая запись создана';
  }

  public function actionUpdateEmployerDatabaseField() {
    $data = Yii::$app->request->post();
    $obj = Employers::find()->where(['id' => $data['id']])->one();
    $obj->{$data['field']} = $data['value'];
    $obj->save();
    if(!$obj->save()){
      return $obj->errors;
    }
    return 'Изменения сохранены';
  }

  public function actionUpdateEmployerImage() {
    $data = Yii::$app->request->post();
    $obj = Employers::find()->where(['id' => $data['id']])->one();
    if($obj->img_src){
      $src = '/var/www/api.vizzi.ru/web' . $obj->img_src;
      if (is_file($src)) {
        unlink($src);
      }
    }
    $model = new UploadCampImages();
    $model->camp_id = $obj->camp_id;
    $model->image = UploadedFile::getInstancesByName('image');
    if($model->upload()){
      $obj->img_src = '/cpics/'. $obj->camp_id . '/' . $model->image[0]->baseName . '.' . $model->image[0]->extension;
      $obj->save();
    }
    if(!$obj->save()){
      return $obj->errors;
    }
    return 'Изменения сохранены';
  }

  public function actionRemoveEmployer() {
    $data = Yii::$app->request->post();
    $obj = Employers::find()->where(['id' => $data['id']])->one();
    $src = '/var/www/api.vizzi.ru/web' . $obj->img_src;
    if (is_file($src)) {
      unlink($src);
    }
    Employers::deleteAll(['id' => $data['id']]);
    return 'Удалено';
  }

}