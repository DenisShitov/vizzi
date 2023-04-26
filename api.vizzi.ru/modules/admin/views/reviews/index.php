<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

use app\models\User;
use app\models\Reviews;
use app\models\Camps;

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin/?']];
$this->params['breadcrumbs'][] = $this->title;

$act = isset($_GET['act']) ? $_GET['act'] : null;

include(Yii::getAlias('@app/modules/admin/views/_parts/fadmin.php'));
?>

<link href="/web/assets0/chosen.min.css" rel="stylesheet">
<?php
$this->registerJsFile(Yii::getAlias('@web/assets0/chosen.jquery.min.js'),['depends'=>'yii\web\YiiAsset']);

$script00 = <<< JS
$('#btn_add_review').click(function() {
	var r_moderate = $('#r_moderate').val();
	var r_name = $('#r_name').val();
	var r_camp_id = $('#r_camp_id').val();
	var r_text = $('#r_text').val();
	
	if (r_moderate != '' && r_name != '' && r_camp_id != '' && r_text != '') {
	$.ajax({
       url: '/admin/reviews/add/',
       type: 'post',
	   dataType: '',
       data: {
			r_moderate: r_moderate,
			r_name: r_name,
			r_text: r_text,
			r_camp_id: r_camp_id
       },
       success: function (data) {
			alert('Отзыв добавлен!');
			var r_moderate_cnt = '';
			if (r_moderate == 1) { r_moderate_cnt = '<span class="text-success review-status" title="Прошел модерацию">&bull;</span>'; } else { r_moderate_cnt = '<span class="text-danger review-status" title="Не промодерирован">•</span>'; }
			$('#reviews_block_main').prepend('<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" data-key="'+data+'"><div class="panel panel-default review-block" id="review_block'+data+'"><div class="panel-header"><h4 class="panel-title">'+r_name+' '+r_moderate_cnt+'</h4></div><div class="panel-body">'+r_text+'</div><div class="panel-footer"><button class="btn btn-default fl-right btn-moderate-base" type="button" data-id="'+data+'" data-moderate="'+r_moderate+'">Модерация</button> </div></div></div>');
			resetModalAddReview();
       },
	   error: function() {
			alert('Ошибка при добавлении. Попробуйте позже.');
	   }
	});
	} 
});

function resetModalAddReview() {
	$('#modal_add_review').modal('hide');
	$('#r_name').val('');
	$('#r_moderate').val(0);
	$('#r_text').val('');
}

$('#m_r_btn_change_status').click(function() {
	var data_id = $('#modal_moderate_review').attr('data-id');
	var data_status = $('#m_r_status').val();
	
	if (data_id != '' && data_status != '') {
	$.ajax({
       url: '/admin/reviews/changestatus/',
       type: 'post',
	   dataType: '',
       data: {
			id: data_id,
			status: data_status
       },
       success: function () {
			alert('Статус изменен!');
			$('#review_block'+data_id+' span').attr('class','');
			$('#review_block'+data_id+' .btn-moderate-base').attr('data-moderate',data_status);
			if (data_status == 0) {
				$('#review_block'+data_id+' span').addClass('text-danger review-status');
				$('#review_block'+data_id+' span').attr('title','Не промодерирован');
			} else {
				$('#review_block'+data_id+' span').addClass('text-success review-status');
				$('#review_block'+data_id+' span').attr('title','Прошел модерацию');
			}
       },
	   error: function() {
			alert('Ошибка при изменении статуса. Попробуйте позже.');
	   }
	});
	} 
});

$(document).ready(function(){
	$('.js-chosen').chosen({
		width: '100%',
		no_results_text: 'Совпадений не найдено',
		placeholder_text_single: 'Выберите регион'
	});
});

$('body').on('click','.btn-moderate-base',function() {
	var data_id = $(this).attr('data-id');
	var data_moderate = $(this).attr('data-moderate');
	var data_text = $('#review_block'+data_id+' .panel-body').text();
	
	$('#modal_moderate_review').attr('data-id',data_id);
	$('#m_r_text').text(data_text);
	$('#m_r_status').val(data_moderate);
	$('#modal_moderate_review').modal('show');
});	

$('#m_r_btn_remove').click(function() {
	var data_id = $('#modal_moderate_review').attr('data-id');

	if (confirm('Удалить отзыв?')) {
	$.ajax({
		   url: '/admin/reviews/remove/',
		   type: 'post',
		   dataType: '',
		   data: {
				id: data_id
		   },
		   success: function (data) {
				$('#review_block'+data_id).parent().remove();
				$('#modal_moderate_review').modal('hide');
		   },
		   error: function() {
				alert('Ошибка при удалении. Попробуйте позже.');
		   }
	});
	}
});
JS;
$this->registerJs($script00, yii\web\View::POS_READY);
?>

<div class="modal fade" id="modal_moderate_review" data-id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content module-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-left" id="request_modal_title">Модерация отзыва</h4>
      </div>
      <div class="modal-body">
		<div style="width:100%; height:200px;overflow:auto;padding:15px;" id="m_r_text"></div>
      </div>
      <div class="modal-footer" style="text-align: left !important;">
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
				<div class="input-group">
					<select class="form-control" id="m_r_status" data-val="">
						<option value="0">Не опубликован</option>
						<option value="1">Опубликован</option>
					</select>
					<span class="input-group-btn">
					<button class="btn btn-success" id="m_r_btn_change_status" type="button">Изменить статус</button>
					</span>
				</div>
		</div>
		<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 text-right">
			<button class="btn btn-danger btn-remove-moderate-review" id="m_r_btn_remove" type="button">Удалить отзыв</button>
		</div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_add_review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content module-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-left" id="request_modal_title">Добавить отзыв</h4>
      </div>
		<div class="modal-footer" style="text-align: left !important;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Имя отправителя</label>
						<input type="text" class="form-control" id="r_name" />
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Статус</label>
						<select id="r_moderate" class="form-control select-status-moderate-review">
							<option value="0">Не опубликован</option>
							<option value="1">Опубликован</option>
						</select>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Лагерь</label>
						<select id="r_camp_id" class="form-control select-status-moderate-review js-chosen">
						<?php
							$all_camps = Camps::find()->all();
							foreach ($all_camps as $camp) {
								echo '<option value="'.$camp->id.'">'.$camp->c_name.'</option>';
							}
						?>
						</select>
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Текст отзыва</label>
						<textarea class="form-control" id="r_text"></textarea>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 r-form">
						<button class="btn btn-success" id="btn_add_review" type="button">Добавить</button>
					</div>
				</div>
		</div>
    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">
<a href="/admin/" class="btn btn-default mt30">← Назад</a>  <button type="button" data-toggle="modal" data-target="#modal_add_review" class="btn btn-success mt30">Добавить отзыв</button><br/>
<h1><?php echo $this->title; ?></h1><br/>

<div class="col-lg-12 col-md-12" id="reviews_block_main" style="margin-bottom:30px;">
<?php
$query = Reviews::find()->orderBy('id DESC');
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_obj',
	'summary' => '',
    'emptyText' => 'Отзывов не добавлено',
    'emptyTextOptions' => [
        'tag' => 'p',
		'class' => 'text-center'
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'col-lg-4 col-md-6 col-sm-12 col-xs-12'
    ],	
]);
?>
</div>

</div>
</div>



<style>
.bg-danger, .bg-warning, .bg-success {
	color:#fff;
}
.square {
    width: 10px;
    height: 10px;
    display: inline-block;
    vertical-align: middle;
}

.panel-header {
	padding:15px;
	border-bottom:1px solid #ccc;
}
.panel-footer {
	min-height:55px;
}

.review-status {
    font-size: 30px;
    vertical-align: top;
    line-height: 0;
    padding-top: 7px;
	cursor:default;
    display: inline-block;
}

.review-block .panel-body {
	height:150px;
	overflow:auto;
}

.r-form {
	margin-bottom:15px;
}

.review-block-camp {
	padding-left:0;
}

.review-block-camp a {
	display:block;
}

.marquee {
    overflow: auto;
	height:40px;
}

.pl0 {
	padding-left:0 !important;
}
.pr0 {
	padding-right:0 !important;
}
.p0 {
	padding:0 !important;
}
</style>