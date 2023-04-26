<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\httpclient\Client;

use app\modules\admin\models\UploadImg1;
use app\modules\admin\models\UploadPic;
use app\modules\admin\models\UploadFile;
use app\models\User;
use app\models\Camps;
use app\models\CampsFiles;
use app\models\Cobjects;
use app\models\Tour;
use app\models\CampsCorrelation;
use app\models\CampsSchedule;
use app\models\InfrastructureImgs;
use app\models\UploadInfrastructureImgs;


/**
 * AdvertController implements the CRUD actions for Advert model.
 */
class ObjectsController extends Controller
{
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only' => ['index', 'view', 'add', 'update', 'save', 'picupload0', 'picupload', 'fileupload', 'getlistpics', 'getlistfiles', 'fileremove'],
        'rules' => [
          [
            'actions' => ['index', 'view', 'add', 'update', 'save', 'picupload0', 'picupload', 'fileupload', 'getlistpics', 'getlistfiles', 'fileremove'],
            'allow' => true,
            'matchCallback' => function ($rule, $action) {
              return Yii::$app->user->identity->superuser == 1;
            },
            'roles' => ['@'],
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'logout' => ['post'],
        ],
      ],
    ];
  }

  public function actionIndex()
  {
    return $this->render('index');
  }

  public function actionAdd()
  {
    return $this->render('add');
  }

  public function actionView()
  {
    return $this->render('view');
  }

  public function actionPicupload0()
  {
    $data = Yii::$app->request->post();
    $file = $_FILES;

    //id camp_id file_type file_src file_original_name
    $camp_id = $data['camp_id'];
    $file_type = 0;
    $dhash = 'main';

    $count_camp = Camps::find()->where(['id' => $camp_id])->count();
    if ($count_camp > 0) {
      $model = new UploadPic();
      $model->id = $camp_id;
      $model->key = 0;
      $model->dhash = $dhash;
      $model->myFiles = UploadedFile::getInstanceByName('myFiles');
      if ($model->myUpload()) {
        $updater = Camps::find()->where(['id' => $camp_id])->one();
        $updater->c_banner = '/cpics/pic_' . $camp_id . $dhash . '.' . $model->myFiles->extension;
        $updater->save();
        return '/cpics/pic_' . $camp_id . $dhash . '.' . $model->myFiles->extension;
      } else {
        return 'Error';
      }
    } else {
      return 'Error';
    }

  }

  public function actionFileremove()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $id = $data['id'];
      $obj_count = CampsFiles::find()->where(['id' => $id])->count();
      if ($obj_count > 0) {
        $obj_upd = CampsFiles::find()->where(['id' => $id])->one();
        $obj_upd->delete();
        return "Success";
      } else {
        return "Error";
      }
    } else {
      return "Error";
    }
  }

  public function actionPicupload()
  {
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
      $updater->file_src = '/cpics/pic_' . $camp_id . $dhash . '.' . $model->myFiles->extension;
      $updater->file_original_name = $model->myFiles->baseName . '.' . $model->myFiles->extension;
      $updater->save();
      return 'Success';
    } else {
      return 'Error';
    }
  }

  public function actionFileupload()
  {
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
      $updater->file_src = '/cdocs/doc_' . $camp_id . $dhash . '.' . $model->myFiles->extension;
      $updater->file_original_name = $model->myFiles->baseName . '.' . $model->myFiles->extension;
      $updater->save();
      return 'Success';
    } else {
      return 'Error';
    }
  }

  public function actionDelInfrastructurePics() {
    $data = Yii::$app->request->post();
    $id = $data['id'];
    $pic = InfrastructureImgs::findOne($id);
    unlink(Yii::$app->basePath . '/web/' . $pic->src);
    $pic->delete();
    return 'Delete file success ' . Yii::$app->basePath . '/web/' . $pic->src;
  }

  public function actionUploadInfrastructurePics() {
    $data = Yii::$app->request->post();
    $file = $_FILES;
    $camp_id = $data['camp_id'];
    $dhash = date("YmdHis");
    $model = new UploadInfrastructureImgs();
    $model->camp_id = $camp_id;
    $model->name = $data['name'];
    $model->category = $data['category'];
    $model->dhash = $dhash;
    $model->input_file = UploadedFile::getInstanceByName('file');
    if ($model->myUpload()) {
      $upd_obj = new InfrastructureImgs();
      $upd_obj->camp_id = $camp_id;
      $upd_obj->category = $data['category'];
      $upd_obj->name = $data['name'];
      $upd_obj->src = 'infpic/' . $camp_id . '/' . $model->category . '/' . $model->name . '-' . $dhash . '.' . $model->input_file->extension;

      if(!$upd_obj->save()){
        return json_encode($upd_obj->getErrors());
      } else {
        return 'success';
      }
    } else {
      return 'File upload error';
    }
  }


  public function actionGetlistpics()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $camp_id = $data['camp_id'];
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $files_data = CampsFiles::find()->where(['camp_id' => $camp_id, 'file_type' => 0])->orderBy('id DESC')->all();
      return $files_data;
    } else {
      return "System Error";
    }
  }

  public function actionGetlistfiles()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $camp_id = $data['camp_id'];
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $files_data = CampsFiles::find()->where(['camp_id' => $camp_id, 'file_type' => 1])->orderBy('id DESC')->all();
      return $files_data;
    } else {
      return "System Error";
    }
  }

  public function actionUpdate()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $uid = Yii::$app->user->identity->id;
      //$new_date = date("Y.m.d H:i");

      $obj_id = $data['obj_id'];
      $c_name = $data['c_name'];
      $c_desc = $data['c_desc'];
      $c_desc_prog = $data['c_desc_prog'];
      $c_desc_acc = $data['c_desc_acc'];
      $c_desc_pay = $data['c_desc_pay'];
      $c_address = $data['c_address'];
      $c_tags = $data['c_tags'];
      $c_age_from = $data['c_age_from'];
      $c_age_to = $data['c_age_to'];
      $c_cost = $data['c_cost'];
      $c_discount = $data['c_discount'];
      $c_duration = $data['c_duration'];
      $c_map_coord = $data['c_map_coord'];
      $types = $data['types'];
      $comment = $data['comment'];

      $obj_count = Camps::find()->where(['id' => $obj_id])->count();

      if ($obj_count > 0) {
        $obj_upd = Camps::find()->where(['id' => $obj_id])->one();
        $obj_upd->c_name = $c_name;
        $obj_upd->c_desc = $c_desc;
        $obj_upd->c_desc_prog = $c_desc_prog;
        $obj_upd->c_desc_acc = $c_desc_acc;
        $obj_upd->c_desc_pay = $c_desc_pay;
        $obj_upd->c_address = $c_address;
        $obj_upd->c_tags = $c_tags;
        $obj_upd->c_age_from = $c_age_from;
        $obj_upd->c_age_to = $c_age_to;
        $obj_upd->c_cost = $c_cost;
        $obj_upd->c_duration = $c_duration;
        $obj_upd->c_map_coord = $c_map_coord;
        $obj_upd->comment = $comment;
        $obj_upd->c_discount = $c_discount;
        $campsCorrelation = CampsCorrelation::find()->where(['camp_id' => $obj_id])->all();
        foreach ($campsCorrelation as $corr) {
          $corr->delete();
        }
        foreach ($types as $type) {
          $campsCorrelation = new CampsCorrelation();
          $campsCorrelation->camp_id = $obj_id;
          $campsCorrelation->correlation_id = $type;
          $campsCorrelation->save();
        }

        if (isset($data['tour'])) {
          $obj_upd->save();
          $deleteTour = Tour::find()->where(['id_camp' => $obj_id])->all();
          if ($deleteTour) {
            foreach ($deleteTour as $item) {
              $item->delete();
            }
          }

          foreach ($data['tour'] as $tour) {
            $tourNew = new Tour();
            $tourNew->id_camp = $obj_upd->id;
            $tourNew->tour_number = $tour['tour_number'];
            $tourNew->tour_from = $tour['tour_from'];
            $tourNew->tour_to = $tour['tour_to'];
            $tourNew->save();
          }
        }

        if (isset($data['schedule'])) {
          if(CampsSchedule::find()->where(['camp_id' => $obj_id])->count() > 0){
            CampsSchedule::deleteAll(['camp_id' => $obj_id]);
          }
          for ($i = 0; $i < count($data['schedule']); $i++) {
            $scheduleNew = new CampsSchedule();
            $scheduleNew->camp_id = $obj_id;
            $scheduleNew->day = $data['schedule'][$i]['day'];
            $scheduleNew->day_part = $data['schedule'][$i]['part'];
            $scheduleNew->time = $data['schedule'][$i]['time'];
            $scheduleNew->description = $data['schedule'][$i]['description'];
            $scheduleNew->save();
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

  public function actionSave()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $uid = Yii::$app->user->identity->id;
      //$new_date = date("Y.m.d H:i");
      $camp_key0 = date("YmdHis");
      $camp_key = 'camp_' . $camp_key0;

      $c_name = $data['c_name'];
      $c_desc = $data['c_desc'];
      $c_desc_prog = $data['c_desc_prog'];
      $c_desc_acc = $data['c_desc_acc'];
      $c_desc_pay = $data['c_desc_pay'];
      $c_iso = $data['c_iso'];
      $c_category = $data['c_category'];
      $c_transfer = $data['c_transfer'];
      $c_season = $data['c_season'];
      $c_address = $data['c_address'];
      $c_tags = $data['c_tags'];
      $c_age_from = $data['c_age_from'];
      $c_age_to = $data['c_age_to'];
      $c_cost = $data['c_cost'];
      $c_accommodation = $data['c_accommodation'];
      $c_nutrition = $data['c_nutrition'];
      $c_lim_op = $data['c_lim_op'];
      $c_discount = $data['c_discount'];
      $c_duration = $data['c_duration'];
      $c_map_coord = $data['c_map_coord'];
      $c_key = $camp_key;
      $comment = $data['comment'];

      if ($c_name != '' && $c_desc != '' && $c_iso != '' && $c_category != '' && $c_address != '') {
        $obj_upd = new Camps();
        $obj_upd->c_name = $c_name;
        $obj_upd->c_desc = $c_desc;
        $obj_upd->c_desc_prog = $c_desc_prog;
        $obj_upd->c_desc_acc = $c_desc_acc;
        $obj_upd->c_desc_pay = $c_desc_pay;
        $obj_upd->c_iso = $c_iso;
        $obj_upd->c_category = $c_category;
        $obj_upd->c_transfer = $c_transfer;
        $obj_upd->c_season = $c_season;
        $obj_upd->c_address = $c_address;
        $obj_upd->c_tags = $c_tags;
        $obj_upd->c_age_from = $c_age_from;
        $obj_upd->c_age_to = $c_age_to;
        $obj_upd->c_cost = $c_cost;
        $obj_upd->c_accommodation = $c_accommodation;
        $obj_upd->c_nutrition = $c_nutrition;
        $obj_upd->c_lim_op = $c_lim_op;
        $obj_upd->c_discount = $c_discount;
        $obj_upd->c_duration = $c_duration;
        $obj_upd->c_map_coord = $c_map_coord;
        $obj_upd->c_key = $c_key;
        $obj_upd->comment = $comment;
//    $this->getPlacesCoords($c_map_coord);
        if (isset($data['tour'])) {
          $obj_upd->save();
          foreach ($data['tour'] as $tour) {
            $tourNew = new Tour();
            $tourNew->id_camp = $obj_upd->id;
            $tourNew->tour_number = $tour['tour_number'];
            $tourNew->tour_from = $tour['tour_from'];
            $tourNew->tour_to = $tour['tour_to'];
            $tourNew->save();
          }
        }
        $get_camp = Camps::find()->where(['c_key' => $c_key])->one();
        return $get_camp->id;
      } else {
        return "System Error";
      }

    } else {
      return "System Error";
    }
  }

  public function getPlacesCoords()
  {
    $data = Yii::$app->request->post();
    $client = new Client();

    $response = $client->createRequest()
      ->setMethod('get')
      ->setUrl('https://search-maps.yandex.ru/v1')
      ->setData([
        'text' => 'метро',
        'type' => 'biz',
        'll' => '39.598383,47.229414',
        'spn' => '0.03,0.03',
        'lang' => 'ru_RU',
        'apikey' => '259749b1-7a8e-444c-9862-114cfceae6fb',
        'rspn' => '1',
        'results' => '10',
      ])
      ->send();
    if ($response->isOk) {
      $newUserId = $response->data['id'];
    }
    return $data['coord'];
  }

}