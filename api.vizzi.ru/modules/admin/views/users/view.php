<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\User;

$id = isset($_GET['id']) ? $_GET['id'] : null;

$user_count = User::find()->where(['id'=>$id])->count();

$this->title = 'Пользователь не найден';
?>

<link href="/web/assets0/bootstrap-tagsinput.css" rel="stylesheet">
<link href="/web/assets0/chosen.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<?php
$this->registerJsFile(Yii::getAlias('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js'),['depends'=>'yii\web\YiiAsset']);
$this->registerJsFile(Yii::getAlias('@web/assets0/summernote-ru-RU.min.js'),['depends'=>'yii\web\YiiAsset']);
$this->registerJsFile(Yii::getAlias('@web/assets0/chosen.jquery.min.js'),['depends'=>'yii\web\YiiAsset']);
$this->registerJsFile(Yii::getAlias('@web/assets0/bootstrap-tagsinput.min.js'),['depends'=>'yii\web\YiiAsset']);

$script2 = <<< JS
$(document).ready(function() {
  $('.editor-element').summernote({
	tabsize: 2,
	lang: 'ru-RU',
	height: 200,
        toolbar: [
          //['style', ['style']],
          ['font', ['bold', 'underline', 'italic', 'clear']],
          //['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          //['insert', ['link', 'picture', 'video']],
          ['view', ['codeview', 'help']]
        ]
  });
});

JS;
$this->registerJs($script2, yii\web\View::POS_READY);

include(Yii::getAlias('@app/modules/admin/views/_parts/fadmin.php'));
?>

<div class="container admin-block">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<a href="/admin/users/" class="btn btn-default mt30">← Пользователи</a> <a href="/admin/" class="btn btn-default mt30">Админ-панель</a><br/>
<?php
$this->title = 'Пользователь не найден';

if ($user_count > 0) {
$user_get = User::find()->where(['id'=>$id])->one();
echo '<h3>'.$user_get->name.' <span class="text-info">'.$user_get->email.'</span></h3><br/></div>';


$this->title = $user_get->name.' - '.$user_get->email;

$script3 = <<< JS


JS;
$this->registerJs($script3, yii\web\View::POS_READY);
?>

<div class="col-lg-12 col-md-12" style="margin-bottom:30px;">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#user_info" aria-controls="user_info" role="tab" data-toggle="tab">Информация</a></li>
		<li role="presentation"><a href="#child_info" aria-controls="child_info" role="tab" data-toggle="tab">Записи о детях</a></li> 
		<li role="presentation"><a href="#fav_info" aria-controls="fav_info" role="tab" data-toggle="tab">Избранное пользователя</a></li> 
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="user_info">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 obj-view-input">
					<label>E-mail</label>
					<input type="text" disabled value="<?php echo $user_get->email; ?>" class="form-control" />
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 obj-view-input">
					<label>Имя</label>
					<input type="text" disabled value="<?php echo $user_get->name; ?>" class="form-control" />
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 obj-view-input">
					<label>Телефон</label>
					<input type="text" disabled value="<?php echo $user_get->phone; ?>" placeholder="не добавлен" class="form-control" />
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="child_info">
			
		</div>
		<div role="tabpanel" class="tab-pane" id="fav_info">
			
		</div>
	</div>
</div>

</div>

<?php } else { ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<p>Пользователь не найден.</p>
</div>
<?php } ?>

</div>

<style>
.obj-view-input {
	margin-bottom:20px;
}

.nav-tabs {
    font-size: 16px;
}
</style>