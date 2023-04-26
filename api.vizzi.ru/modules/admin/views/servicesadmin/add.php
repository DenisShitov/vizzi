<?php
//use app\models\Cobjects;

$id = isset($_GET['id']) ? $_GET['id'] : null;
$this->title = 'Добавить объект';

include(Yii::getAlias('@app/modules/admin/views/_parts/fadmin.php'));
include(Yii::getAlias('@app/modules/admin/views/_parts/c_iso_arr.php'));
?>

<link href="/web/assets0/bootstrap-tagsinput.css" rel="stylesheet">
<link href="/web/assets0/chosen.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<?php
$this->registerJsFile(Yii::getAlias('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js'),['depends'=>'yii\web\YiiAsset']);
$this->registerJsFile(Yii::getAlias('@web/assets0/summernote-ru-RU.min.js'),['depends'=>'yii\web\YiiAsset']);

$this->registerJsFile(Yii::getAlias('@web/assets0/chosen.jquery.min.js'),['depends'=>'yii\web\YiiAsset']);
$this->registerJsFile(Yii::getAlias('@web/assets0/bootstrap-tagsinput.min.js'),['depends'=>'yii\web\YiiAsset']);
?>

<div style="width: 1000px; margin: 30px auto">
  <form action="/admin/servicesadmin/save" method="post" style="display: flex; flex-direction: column; gap:20px">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
    <select name="id_camp">
      <?php foreach ($camps as $camp) { ?>
        <option value='<?= $camp->id ?>'><?= $camp->c_name ?></option>
      <?php } ?>
    </select>
    <input type="text" name="name">
    <input type="text" name="address">
    <input type="number" name="price">
    <input type="number" name="discount">
    <input type="number" name="season">
    <input type="number" name="transfer">
    <input type="text" name="description">
    <button type="submit">Сохранить</button>
  </form>
</div>
