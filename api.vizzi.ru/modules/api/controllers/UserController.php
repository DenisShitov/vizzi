<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use yii\web\UploadedFile;


use app\models\User;
use app\models\ChildData;
use app\models\Favorites;
use app\models\Orders;
use app\models\UploadDocs;
use app\models\UploadUserPhoto;
use app\models\UploadUserFiles;
use app\models\UserFiles;

/*
+ отзывы
+ добавление отзыва
+ история заявок
*/

class UserController extends ActiveController
{
  public $modelClass = 'app\models\UserInfo';
  public $defaultAction = 'info';

  public function behaviors()
  {
    $behaviors = parent::behaviors();
    $behaviors['corsFilter'] = [
      'class' => \yii\filters\Cors::className(),
      'cors' => [
        'Origin' => ['*'],
        'Access-Control-Request-Method' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
        'Access-Control-Request-Headers' => ['*'],
        'Access-Control-Allow-Credentials' => null,
        'Access-Control-Max-Age' => 86400,
        'Access-Control-Expose-Headers' => [],
      ],
    ];
    $behaviors['authenticator'] = [
      'class' => QueryParamAuth::className(),
      'except' => ['login', 'signup', 'update-user', 'claims', 'reset-password'],
    ];
    $behaviors['contentNegotiator'] = [
      'class' => \yii\filters\ContentNegotiator::className(),
      'formats' => [
        'application/json' => \yii\web\Response::FORMAT_JSON,
      ]
    ];
    return $behaviors;
  }


  public function actionSignup()
  {
    if (Yii::$app->request->post()) {
      $params = Yii::$app->request->post();
      if (!empty($params['log']) && !empty($params['pwd']) && !empty($params['name']) && !empty($params['phone'])) {
        $user_find = User::find()->where(['email' => $params['log']])->count();
        if ($user_find == 0) {
          $user = new User();
          $user->name = $params['name'];
          $user->email = $params['log'];
          $user->phone = $params['phone'];
          $user->active = 1;
          $user->setPassword($params['pwd']);
          $user->generateAuthKey();
          $user->keyq = Yii::$app->security->generateRandomString();
          $new_access_token = Yii::$app->security->generateRandomString();
          $user->access_token = $new_access_token;
          $user->save(false);

          return ['id' => $user->primaryKey, 'access-token' => $new_access_token];
        }
        {
          return '';
        }
      } else {
        return '';
      }
    } else {
      return '';
    }
  }

  public function actionLogin()
  {
    if (Yii::$app->request->post()) {
      $params = Yii::$app->request->post();
      if (!empty($params['log']) && !empty($params['pwd'])) {
        $user = User::findByUseremail($params['log']);
        if ($user->validatePassword($params['pwd'])) {
          return ['id' => $user->id, 'access-token' => $user->access_token, 'superuser' => $user->superuser];
        } else {
          Yii::$app->response->statusCode = 401;
          return '';
        }
      } else {
        return '';
      }
    } else {
      return '';
    }
  }

  public function actionInfo()
  {
    $user_info_count = $this->modelClass::find()->where(['id' => Yii::$app->user->identity->id, 'active' => 1])->count();
    if ($user_info_count > 0) {
      $user_info = $this->modelClass::find()->where(['id' => Yii::$app->user->identity->id, 'active' => 1])->one();
      return $user_info;
    } else {
      return '';
    }
  }

  public function actionChilds()
  {
    $info_count = ChildData::find()->where(['parent_id' => Yii::$app->user->identity->id])->count();
    if ($info_count > 0) {
      $get_info = ChildData::find()->where(['parent_id' => Yii::$app->user->identity->id])->asArray()->all();
      return $get_info;
    } else {
      return '';
    }
  }

  public function actionAddchild()
  {
    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
      $name = $data['name'];
      $surname = $data['surname'];
      $thirdname = $data['thirdname'];
      $bday = $data['bday'];
      $snils = $data['snils'];
      $sor = $data['sor'];
      $polis = $data['polis'];
      $obj_count = ChildData::find()->where(['parent_id' => Yii::$app->user->identity->id, 'ch_name' => $name])->count();
      if ($obj_count == 0) {
        $new_obj = new ChildData();
        $new_obj->parent_id = Yii::$app->user->identity->id;
        $new_obj->ch_name = $name;
        $new_obj->ch_surname = $surname;
        $new_obj->ch_thirdname = $thirdname;
        $new_obj->ch_birthday = $bday;
        $new_obj->ch_snils = $snils;
        $new_obj->ch_sor = $sor;
        $new_obj->ch_polis = $polis;
        $new_obj->save();
        return $new_obj;
      } else {
        return 'Object not found';
      }
    } else {
      return 'Server error';
    }
  }

  public function actionAddBlankChild() {
    $data = Yii::$app->request->post();
    $obj = new ChildData();
    $obj->parent_id = $data['user_id'];
    $obj->ch_gender = 1;
    $obj->save();
    if(!$obj->save()){
      return $obj;
    }
    return $obj;
  }

  public function actionUpdchild()
  {
    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
      $obj_count = ChildData::find()->where(['parent_id' => Yii::$app->user->identity->id, 'id' => $data['id']])->count();
      if ($obj_count > 0) {
        $upd_obj = ChildData::find()->where(['parent_id' => Yii::$app->user->identity->id, 'id' => $data['id']])->one();
        $upd_obj->parent_id = Yii::$app->user->identity->id;
        $upd_obj->ch_name = $data['name'];
        $upd_obj->ch_surname = $data['surname'];
        $upd_obj->ch_thirdname = $data['thirdname'];
        $upd_obj->ch_birthday = Yii::$app->formatter->asDate($data['bday'], 'yyyy-MM-dd');
        $upd_obj->ch_snils = $data['snils'];
        $upd_obj->ch_sor = $data['sor'];
        $upd_obj->ch_polis = $data['polis'];
        $upd_obj->ch_phone = $data['phone'];
        $upd_obj->ch_sor_date = Yii::$app->formatter->asDate($data['sorDate'], 'yyyy-MM-dd');
        $upd_obj->ch_phone = $data['passport'];
        $upd_obj->ch_sor_date = Yii::$app->formatter->asDate($data['passportDate'], 'yyyy-MM-dd');
        $upd_obj->ch_medfeatures = $data['medfeatures'];
        $upd_obj->save();
        return 'Information saved';
      } else {
        return 'Object not found';
      }
    } else {
      return 'Server error';
    }
  }

  public function actionUpdateChild() {
    $data = Yii::$app->request->post();
    $child = ChildData::find()->where(['id' => $data['id']])->one();
    foreach ($data as $key => $value) {
      $child->{$key} = $value;
    }
    $child->save();
    return 'Данные сохранены '.$child->id;
  }

  public function actionGetChildById() {
    $data = Yii::$app->request->post();
    $child = ChildData::find()->where(['id' => $data['id']])->one();
    return $child;
  }

  public function actionRemovechild()
  {
    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
      $id = $data['id'];
      $obj_count = ChildData::find()->where(['parent_id' => Yii::$app->user->identity->id, 'id' => $id])->count();
      if ($obj_count > 0) {
        $new_obj = ChildData::find()->where(['parent_id' => Yii::$app->user->identity->id, 'id' => $id])->one();
        $new_obj->delete();
        return 'Success';
      } else {
        return '';
      }
    } else {
      return '';
    }
  }

  public function actionUploadMainDocs() {
    $data = Yii::$app->request->post();
    $model = new UploadUserFiles();
    $model -> user_id = $data['user_id'];
    $model -> hash = date("mdYHis");
    $model -> child_id = $data['child_id'] ?? null;
    $model -> file_type = $data['file_type'];
    if (Yii::$app->request->isPost) {
      $model->userFile = UploadedFile::getInstanceByName('userFile');
      if ($model->upload()) {
        if(isset($data['child_id'])){
          $propName = 'ch_'.$data['file_type'].'_src';
          $child = ChildData::find()->where(['id' => $data['child_id']])->one();
          $child->{$propName} = $model->src;
          $child->save();
        } else {
          $propName = $data['file_type'].'_src';
          $user = User::find()->where(['id' => $data['user_id']])->one();
          $user->{$propName} = $model->src;
          $user->save();
        }
        return 'Документ загружен';
      } else {
        return 'Ошибка загрузки документа';
      }
    }
  }

  public function actionUploadDocChild() {
    $data = Yii::$app->request->post();

    $file = $_FILES;
    $parent_id = $data['parent_id'];
    $child_id = $data['child_id'];
    $doc_type = $data['doc_type'];

    $dhash = date("YmdHis");

    $model = new UploadDocs();
    $model->parent_id = $parent_id;
    $model->child_id = $child_id;
    $model->doc_type = $doc_type;
    $model->dhash = $dhash;
    $model->doc_file = UploadedFile::getInstanceByName('doc_file');
    if ($model->myUpload()) {
      $upd_obj = ChildData::find()->where(['id' => $child_id])->one();
      switch ($doc_type) {
        case 'snils' :
          $upd_obj->ch_snils_src = '/ufiles/snils_' . $parent_id . '-' . $child_id . '-' . $dhash . '.' . $model->doc_file->extension;
          break;
        case 'sor' :
          $upd_obj->ch_sor_src = '/ufiles/sor_' . $parent_id . '-' . $child_id . '-' . $dhash . '.' . $model->doc_file->extension;
          break;
        case 'polis' :
          $upd_obj->ch_polis_src = '/ufiles/polis_' . $parent_id . '-' . $child_id . '-' . $dhash . '.' . $model->doc_file->extension;
          break;
        case 'photo' :
          $upd_obj->ch_photo_src = '/ufiles/photo_' . $parent_id . '-' . $child_id . '-' . $dhash . '.' . $model->doc_file->extension;
          break;
      }
    } if(!$upd_obj->save()) {
      return $upd_obj->getErrors();
    }
    return 'ok';
  }

  public function actionUploadPhoto() {
    $data = Yii::$app->request->post();
    $file = $_FILES;
    $dhash = date("YmdHis");
    $model = new UploadUserPhoto();
    $model->parent_id = $data['parent_id'];
    $model->dhash = $dhash;
    if (isset($data['child_id'])) {
      $model->child_id = $data['child_id'];
    }
    $model->photo = UploadedFile::getInstanceByName('photo');
    if ($model->myUpload()) {
      if (isset($data['child_id'])) {
        $upd_obj = ChildData::find()->where(['id' => $data['child_id']])->one();
        $upd_obj->ch_photo_src = '/ufiles/' . $data['parent_id'] . '/chphoto-' . $data['child_id'] . '-' . $dhash . '.' . $model->photo->extension;
        $upd_obj->save();
        return 'Фото ребенка сохранена';
      } else {
        $upd_obj = User::find()->where(['id'=>$data['parent_id']])->one();
        $upd_obj->img_src = '/ufiles/' . $data['parent_id'] . '/photo-' . $dhash . '.' . $model->photo->extension;
        $upd_obj->save();
        return 'Фото родителя сохранена';
      }
    } else {
      return 'Ошибка загрузки';
    }
  }

  public function actionDeletePhoto() {
    $data = Yii::$app->request->post();
    if(isset($data['child_id'])) {
      $child = ChildData::find()->where(['id' => $data['child_id']])->one();
      $child->ch_photo_src = null;
      $child->save();
    } else {
      $user = User::find()->where(['id'=>$data['parent_id']])->one();
      $user->img_src = null;
      $user->save();
    }
    $newSrc = '/var/www/api.vizzi.ru/web' . $data['src'];
    if (is_file($newSrc)) {
      unlink($newSrc);
    }
    return 'Файл удален';
  }

  public function actionUploadUserFiles() {
    $data = Yii::$app->request->post();
    $model = new UploadUserFiles();
    $model -> user_id = $data['user_id'];
    $model -> hash = date("mdYHis");
    $model -> child_id = $data['child_id'] ?? null;
    $model -> file_type = $data['file_type'];
    if (Yii::$app->request->isPost) {
      $model->userFile = UploadedFile::getInstanceByName('userFile');
      if ($model->upload()) {
        $new = new UserFiles();
        $new->user_id = $data['user_id'];
        $new->child_id = $data['child_id'] ?? null;
        $new->file_name = $data['file_name'];
        $new->file_type = $data['file_type'];
        $new->file_src = $model->src;
        $new->save();
        return 'Документ загружен';
      } else {
        return 'Ошибка загрузки документа';
      }
    }
  }

  public function actionGetUserFiles() {
    $data = Yii::$app->request->post();
    $out = UserFiles::find()->where(['user_id' => $data['user_id']])->all();
    return $out;
  }

  public function actionDeleteUserFiles() {
    $data = Yii::$app->request->post();
    UserFiles::find()
      ->where(['file_src' => $data['src']])
      ->one()
      ->delete();
    unlink('/var/www/api.vizzi.ru/web/' . $data['src']);
    return 'deleted';
  }

  public function actionDeleteMainUserFiles() {
    $data = Yii::$app->request->post();
    if (isset($data['child_id'])) {
      $prop = 'ch_'.$data['file_type'].'_src';
      $child = ChildData::find()->where(['id' => $data['child_id']])->one();
      $child->{$prop} = null;
      $child->save();
    } else {
      $prop = $data['file_type'].'_src';
      $user = User::find()->where(['id'=>$data['user_id']])->one();
      $user->{$prop} = null;
      $user->save();
    }
    unlink('/var/www/api.vizzi.ru/web/' . $data['src']);
    return 'Файл удален';
  }

  public function actionFavorites()
  {
    $obj_count = Favorites::find()->where(['uid' => Yii::$app->user->identity->id])->count();
    if ($obj_count > 0) {
      $obj_info = Favorites::find()->where(['uid' => Yii::$app->user->identity->id])->all();
      return $obj_info;
    } else {
      return '';
    }
  }

  public function actionAddfav()
  {
    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
      $obj_id = $data['obj_id'];
      $type = $data['type'];
      $obj_count = Favorites::find()->where(['uid' => Yii::$app->user->identity->id, 'obj_id' => $obj_id, 'type' => $type])->count();
      if ($obj_count == 0) {
        $new_obj = new Favorites();
        $new_obj->uid = Yii::$app->user->identity->id;
        $new_obj->obj_id = $obj_id;
        $new_obj->type = $type;
        $new_obj->save();
        return 'Success';
      } else {
        return '';
      }
    } else {
      return '';
    }
  }

  public function actionRemovefav()
  {
    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
      $obj_id = $data['obj_id'];
      $type = $data['type'];
      $obj_count = Favorites::find()->where(['uid' => Yii::$app->user->identity->id, 'obj_id' => $obj_id, 'type' => $type])->count();
      if ($obj_count > 0) {
        $new_obj = Favorites::find()->where(['uid' => Yii::$app->user->identity->id, 'obj_id' => $obj_id, 'type' => $type])->one();
        $new_obj->delete();
        return 'Success';
      } else {
        return '';
      }
    } else {
      return '';
    }
  }

  public function actionUpdateUser()
  {
    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
      $model = User::findOne($data['id_user']);
      if ($model) {
        $model->name = isset($data['name']) ? $data['name'] : $model->name;
        $model->surname = isset($data['surname']) ? $data['surname'] : $model->surname;
        $model->thirdname = isset($data['thirdname']) ? $data['thirdname'] : $model->thirdname;
        $model->phone = isset($data['phone']) ? $data['phone'] : $model->phone;
        $model->email = isset($data['email']) ? $data['email'] : $model->email;
        $model->address = isset($data['address']) ? $data['address'] : $model->address;
        if ($model->validate() && $model->save()) {
          return 'Success';
        } else {
          return $model->getErrors();
        }
      }
    }
    return '';
  }



  public function actionResetPassword()
  {
    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
      $user = User::find()->where(['email' => $data['user_email']])->one();
      if ($user) {
        $pass = Yii::$app->security->generateRandomString(12);
        $user->setPassword($pass);
        $user->save();
        $html = 'Ваш логин - ' . $user->email . ' Ваш новый пароль - ' . $pass;
        $mail = Yii::$app->mailer->compose()
          ->setFrom('info@vh526442.eurodir.ru')
          ->setTo($data['user_email'])
          ->setSubject('Восстановление пароля')
          ->setTextBody($html)
          ->setHtmlBody($html);
        if ($mail->send()) {
          return json_encode([
            'status' => 200,
            'message' => 'Проверьте Ваш e-mail и следуйте дальнейшим инструкциям'
          ]);
        } else {
          return json_encode([
            'status' => 404,
            'message' => 'Ошибка передачи'
          ]);
        }
      } else {
        return json_encode([
          'status' => 406,
          'message' => 'Такого пользователя не существует'
        ]);
      }
    }
  }

  /* public function actions()
  {
    $actions = parent::actions();

    $actions['index']['dataFilter'] = [
      'class' => \yii\data\ActiveDataFilter::class,
      'searchModel' => $this->modelClass,
    ];

    return $actions;
  } */

}