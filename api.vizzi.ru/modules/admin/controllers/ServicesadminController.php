<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

use app\models\Service;
use app\models\Camps;

/**
 * AdvertController implements the CRUD actions for Advert model.
 */
class ServicesadminController extends Controller
{
//  public function behaviors()
//  {
//    return [
//      'access' => [
//        'class' => AccessControl::className(),
//        'only' => ['index','view','add','update','save','picupload0','picupload','fileupload','getlistpics','getlistfiles','fileremove'],
//        'rules' => [
//          [
//            'actions' => ['index','view','add','update','save','picupload0','picupload','fileupload','getlistpics','getlistfiles','fileremove'],
//            'allow' => true,
//            'matchCallback' => function ($rule, $action) {
//              return Yii::$app->user->identity->superuser == 1;
//            },
//            'roles' => ['@'],
//          ],
//        ],
//      ],
//      'verbs' => [
//        'class' => VerbFilter::className(),
//        'actions' => [
//          'logout' => ['post'],
//        ],
//      ],
//    ];
//  }

  public function actionIndex()
  {
    return $this->render('index');
  }

  public function actionAdd()
  {
    $camps = Camps::find()->all();
    return $this->render('add',['camps'=>$camps]);
  }

  public function actionView()
  {
    return $this->render('view');
  }

  public function actionPicupload0() {
    $data = Yii::$app->request->post();
    $file = $_FILES;

    //id camp_id file_type file_src file_original_name
    $camp_id = $data['camp_id'];
    $file_type = 0;
    $dhash = 'main';

    $count_camp = Camps::find()->where(['id'=>$camp_id])->count();
    if ($count_camp > 0) {
      $model = new UploadPic();
      $model->id = $camp_id;
      $model->key = 0;
      $model->dhash = $dhash;
      $model->myFiles = UploadedFile::getInstanceByName('myFiles');
      if ($model->myUpload()) {
        $updater = Camps::find()->where(['id'=>$camp_id])->one();
        $updater->c_banner = '/cpics/pic_'.$camp_id.$dhash.'.'.$model->myFiles->extension;
        $updater->save();
        return '/cpics/pic_'.$camp_id.$dhash.'.'.$model->myFiles->extension;
      } else {
        return 'Error';
      }
    } else { return 'Error'; }

  }

  public function actionFileremove() {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $id = $data['id'];
      $obj_count = CampsFiles::find()->where(['id'=>$id])->count();
      if ($obj_count > 0) {
        $obj_upd  = CampsFiles::find()->where(['id'=>$id])->one();
        $obj_upd->delete();
        return "Success";
      } else {
        return "Error";
      }
    } else {
      return "Error";
    }
  }

  public function actionPicupload() {
    $data = Yii::$app->request->post();
    $file = $_FILES;

    //id camp_id file_type file_src file_original_name
    $camp_id = $data['camp_id'];
    $file_type = 0;
    $dhash = date("YmdHis");

    $model = new UploadPic();
    $model->id = $camp_id;
    $model->key = 0;
    $model->dhash = $dhash;
    $model->myFiles = UploadedFile::getInstanceByName('myFiles');
    if ($model->myUpload()) {
      $updater = new CampsFiles();
      $updater->camp_id = $camp_id;
      $updater->file_type = $file_type;
      $updater->file_src = '/cpics/pic_'.$camp_id.$dhash.'.'.$model->myFiles->extension;
      $updater->file_original_name = $model->myFiles->baseName.'.'.$model->myFiles->extension;
      $updater->save();
      return 'Success';
    } else {
      return 'Error';
    }
  }

  public function actionFileupload() {
    $data = Yii::$app->request->post();
    $file = $_FILES;

    $camp_id = $data['camp_id'];
    $file_type = 1;
    $dhash = date("YmdHis");

    $model = new UploadFile();
    $model->id = $camp_id;
    $model->key = 1;
    $model->dhash = $dhash;
    $model->myFiles = UploadedFile::getInstanceByName('myFiles');
    if ($model->myUpload()) {
      $updater = new CampsFiles();
      $updater->camp_id = $camp_id;
      $updater->file_type = $file_type;
      $updater->file_src = '/cdocs/doc_'.$camp_id.$dhash.'.'.$model->myFiles->extension;
      $updater->file_original_name = $model->myFiles->baseName.'.'.$model->myFiles->extension;
      $updater->save();
      return 'Success';
    } else {
      return 'Error';
    }
  }

  public function actionGetlistpics() {
    if (Yii::$app->request) {
      $data = Yii::$app->request->post();
      $service_id = $data['id'];
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $files_data = ServiceFiles::find()->where(['camp_id'=>$service_id,'file_type'=>0])->orderBy('id DESC')->all();
      return $files_data;
    } else {
      return "System Error";
    }
  }

  public function actionGetlistfiles() {
    if (Yii::$app->request) {
      $data = Yii::$app->request->post();
      $service_id = $data['id'];
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $files_data = ServiceFiles::find()->where(['camp_id'=>$service_id,'file_type'=>1])->orderBy('id DESC')->all();
      return $files_data;
    } else {
      return "System Error";
    }
  }

  public function actionUpdate() {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $uid = Yii::$app->user->identity->id;
      //$new_date = date("Y.m.d H:i");
      $obj_id = $data['id'];
      $name = $data['name'];
      $address = $data['address'];
      $price = $data['price'];
      $discount = $data['discount'];
      $season = $data['season'];
      $transfer = $data['transfer'];
      $region = $data['region'];
      $duration = $data['duration'];
      $invalid = $data['invalid'];
      $attractions = $data['attractions'];
      $meal = $data['meal'];
      $kids = $data['kids'];
      $photoplace = $data['photoplace'];
      $dayoff = $data['dayoff'];
      $guide = $data['guide'];
      $yourself = $data['yourself'];
      $anyweather = $data['anyweather'];
      $age_from = $data['age_from'];
      $age_to = $data['age_to'];
      $position = $data['position'];
      $hobby = $data['hobby'];
      $comfort = $data['comfort'];
      $description = $data['description'];

      $obj_count = Service::find()->where(['id'=>$obj_id])->count();

      if ($obj_count > 0) {
        $obj_upd  = Service::find()->where(['id'=>$obj_id])->one();
        $obj_upd->name = $name;
        $obj_upd->address = $address;
        $obj_upd->price = $price;
        $obj_upd->discount = $discount;
        $obj_upd->season = $season;
        $obj_upd->transfer = $transfer;
        $obj_upd->region = $region;
        $obj_upd->duration = $duration;
        $obj_upd->invalid = $invalid;
        $obj_upd->attractions = $attractions;
        $obj_upd->meal = $meal;
        $obj_upd->kids = $kids;
        $obj_upd->photoplace = $photoplace;
        $obj_upd->dayoff = $dayoff;
        $obj_upd->guide = $guide;
        $obj_upd->yourself = $yourself;
        $obj_upd->anyweather = $anyweather;
        $obj_upd->age_from = $age_from;
        $obj_upd->age_to = $age_to;
        $obj_upd->position = $position;
        $obj_upd->hobby = $hobby;
        $obj_upd->comfort = $comfort;
        $obj_upd->description = $description;

        if (isset($data['tour'])){
          $obj_upd->save();
          $deleteTour = Tour::find()->where(['id_camp' => $obj_id])->all();
          if ($deleteTour){
            foreach ($deleteTour as $item) {
              $item->delete();
            }
          }

          foreach ($data['tour'] as $tour){
            $tourNew = new Tour();
            $tourNew->id_camp = $obj_upd->id;
            $tourNew->tour_number = $tour['tour_number'];
            $tourNew->tour_from = $tour['tour_from'];
            $tourNew->tour_to = $tour['tour_to'];
            $tourNew->save();
          }
        }

        return "Success";

      } else {
        return "System Error";
      }
    } else {
      return "System Error";
    }
  }

  public function actionSave() {
    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
//      $uid = Yii::$app->user->identity->id;
      //$new_date = date("Y.m.d H:i");

      $id_camp = $data['id_camp'];
      $name = $data['name'];
      $address = $data['address'];
      $price = $data['price'];
      $discount = $data['discount'];
      $season = $data['season'];
      $transfer = $data['transfer'];
      $region = $data['region'];
      $duration = $data['duration'];
      $invalid = $data['invalid'];
      $attractions = $data['attractions'];
      $meal = $data['meal'];
      $kids = $data['kids'];
      $photoplace = $data['photoplace'];
      $dayoff = $data['dayoff'];
      $guide = $data['guide'];
      $yourself = $data['yourself'];
      $anyweather = $data['anyweather'];
      $age_from = $data['age_from'];
      $age_to = $data['age_to'];
      $position = $data['position'];
      $hobby = $data['hobby'];
      $comfort = $data['comfort'];
      $description = $data['description'];

      if ($name != '' && $address != '' && $price != '' && $season != '' && $transfer != '' && $description != '') {
        $obj_upd  = new Service();
        $obj_upd->name = $name;
        $obj_upd->id_camp = $id_camp;
        $obj_upd->address = $address;
        $obj_upd->price = $price;
        $obj_upd->discount = $discount;
        $obj_upd->season = $season;
        $obj_upd->transfer = $transfer;
        $obj_upd->region = $region;
        $obj_upd->duration = $duration;
        $obj_upd->invalid = $invalid;
        $obj_upd->attractions = $attractions;
        $obj_upd->meal = $meal;
        $obj_upd->kids = $kids;
        $obj_upd->photoplace = $photoplace;
        $obj_upd->dayoff = $dayoff;
        $obj_upd->guide = $guide;
        $obj_upd->yourself = $yourself;
        $obj_upd->anyweather = $anyweather;
        $obj_upd->age_from = $age_from;
        $obj_upd->age_to = $age_to;
        $obj_upd->position = $position;
        $obj_upd->hobby = $hobby;
        $obj_upd->comfort = $comfort;
        $obj_upd->description = $description;
        $obj_upd->save();
        return 'Success';
      } else { return "System Error"; }

    } else {
      return "System Error";
    }
  }


}