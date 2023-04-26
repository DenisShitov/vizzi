<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

use app\models\User;
use app\models\Claims;
use app\models\Camps;

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin/?']];
$this->params['breadcrumbs'][] = $this->title;

$act = isset($_GET['act']) ? $_GET['act'] : null;

include(Yii::getAlias('@app/modules/admin/views/_parts/fadmin.php'));
?>

<link href="/web/assets0/chosen.min.css" rel="stylesheet">
<?php
$this->registerJsFile(Yii::getAlias('@web/assets0/chosen.jquery.min.js'),['depends'=>'yii\web\YiiAsset']);

$script00 = <<< JS
$('#btn_add_claim').click(function() { // добавляем новую заявку
	var type_client = $('#type_client').val();
	var type_camp = $('#type_camp').val();

	var fio_client = $('#fio_client').val();
	var uid = $('#uid').val();
	var camp_name = $('#camp_name').val();
	var camp_id = $('#camp_id').val();
	var fio_client = $('#fio_client').val();
	var cost = $('#cost').val();
	var camp_name = $('#camp_name').val();
	var count_seats = $('#count_seats').val();
	var accommodation = $('#accommodation').val();
	var season = $('#season').val();
	var nutrition = $('#nutrition').val();
	var comment = $('#comment').val();
	var claim_status = $('#claim_status').val();
	var pay_status = $('#pay_status').val();
	
	if (type_client != '' && type_camp != '' && count_seats != '' && season != '') {
	if (type_client == 0 && fio_client != '' || type_client == 1 && uid != '' || type_camp == 0 && camp_name != '' || type_camp == 1 && camp_id != '') {
	$.ajax({
       url: '/admin/claims/add/',
       type: 'post',
	   dataType: '',
       data: {
			type_client: type_client,
			type_camp: type_camp,
			fio_client: fio_client,
			uid: uid,
			cost: cost,
			camp_name: camp_name,
			camp_id: camp_id,
			count_seats: count_seats,
			accommodation: accommodation,
			season: season,
			nutrition: nutrition,
			comment: comment,
			claim_status: claim_status,
			pay_status: pay_status
       },
       success: function (data) {
			alert('Заявка добавлена!');
			location.reload();
			//resetModalAddClaim(1);
       },
	   error: function() {
			alert('Ошибка при добавлении. Попробуйте позже.');
	   }
	});
	} else { alert('Заполните все необходимые поля'); }
	} else { alert('Заполните все необходимые поля'); }
});

$('#btn_clear_claim').click(function() { // кнопка для очистки данных в модали добавления заявки
	resetModalAddClaim(0);
});

function resetModalAddClaim(data_hide) { // сбрасываем значение полей после добавления заявки
	if (data_hide == 1) { $('#modal_add_claim').modal('hide'); }
	$('#modal_add_claim input').val('');
	$('#modal_add_claim textarea').val('');
	$('#modal_add_claim select').prop('selectedIndex',0);
	$('.sel-control-show').each(function() {
		var data_block = $(this).attr('data-block');
		var data_val = $(this).val();	
		SelControlShow(data_block,data_val);
	});
}


$(document).ready(function() { // инициализация
	jsChosenInit();
	$('.start-hide').hide();
});

function jsChosenInit() { // вызов плагина для быстрого поиска лагеря
	$('.js-chosen').chosen({
		width: '100%',
		no_results_text: 'Совпадений не найдено',
		placeholder_text_single: 'Выберите лагерь'
	});	
}

$('body').on('click','.btn-update-base',function() { // действия при нажатии на кпонку "редактировать"
	var data_id = $(this).attr('data-id');
	var data_text = $('#claim_block'+data_id+' .panel-body').text();
	
	$('#modal_update_claim').attr('data-id',data_id);
	$('#m_r_text').text(data_text);
	$('#modal_update_claim').modal('show');
});	

$('.btn-remove-claim').click(function() { // удаление заявки
	var data_id = $(this).attr('data-id');
	var data_parent = $(this).attr('data-parent');

	if (confirm('Удалить сделку?')) {
	$.ajax({
		   url: '/admin/claims/remove/',
		   type: 'post',
		   dataType: '',
		   data: {
				id: data_id
		   },
		   success: function (data) {
				$('#modal_update_claim'+data_id).modal('hide');
				setTimeout(function() { $('#claim_block'+data_id).parent().remove(); },500);
		   },
		   error: function() {
				alert('Ошибка при удалении. Попробуйте позже.');
		   }
	});
	}
});

$('.btn-update-base').click(function() { //вызов модали редактирования
	var data_id = $(this).attr('data-id');
	
	var data_block0 = $('#modal_update_claim'+data_id+' select[data-id="type_client"]').attr('data-block');
	var data_val0 = $('#modal_update_claim'+data_id+' select[data-id="type_client"]').val();	
	SelControlShow(data_block0,data_val0);
	var data_block1 = $('#modal_update_claim'+data_id+' select[data-id="type_camp"]').attr('data-block');
	var data_val1 = $('#modal_update_claim'+data_id+' select[data-id="type_camp"]').val();	
	SelControlShow(data_block1,data_val1);
	
	var len_act_sel_uid = $('#modal_update_claim'+data_id+' select[data-id="uid"] option').length;
	if (len_act_sel_uid == 0) {
		var sel_uid_cnt = $('#uid').html();
		$('#modal_update_claim'+data_id+' select[data-id="uid"]').html(sel_uid_cnt);
	}
	
	var len_act_sel_camp_id = $('#modal_update_claim'+data_id+' select[data-id="camp_id"] option').length;
	if (len_act_sel_camp_id == 0) {
		var sel_camp_id_cnt = $('#camp_id').html();
		$('#modal_update_claim'+data_id+' select[data-id="camp_id"]').html(sel_camp_id_cnt);
		var camp_id_val = $('#modal_update_claim'+data_id+' select[data-id="camp_id"]').attr('data-val');
		$('#modal_update_claim'+data_id+' select[data-id="camp_id"] option[value="'+camp_id_val+'"]').attr('selected','selected');
		$('#modal_update_claim'+data_id+' select[data-id="camp_id"]').addClass('js-chosen');
			jsChosenInit();
	}
	
});

$('.btn-update-claim').click(function() { //обновление заявки
	var data_id = $(this).attr('data-id');
	var data_parent = $(this).attr('data-parent');
	
	var type_client = $('select[data-id="type_client"]',data_parent).val();
	var type_camp = $('select[data-id="type_camp"]',data_parent).val();

	var fio_client = $('input[data-id="fio_client"]',data_parent).val();
	var uid = $('select[data-id="uid"]',data_parent).val();
	var camp_name = $('input[data-id="camp_name"]',data_parent).val();
	var camp_id = $('select[data-id="camp_id"]',data_parent).val();
	var fio_client = $('input[data-id="fio_client"]',data_parent).val();
	var cost = $('input[data-id="cost"]',data_parent).val();
	var camp_name = $('input[data-id="camp_name"]',data_parent).val();
	var count_seats = $('input[data-id="count_seats"]',data_parent).val();
	var accommodation = $('select[data-id="accommodation"]',data_parent).val();
	var season = $('select[data-id="season"]',data_parent).val();
	var nutrition = $('select[data-id="nutrition"]',data_parent).val();
	var comment = $('textarea[data-id="comment"]',data_parent).val();
	var claim_status = $('select[data-id="claim_status"]',data_parent).val();
	var pay_status = $('select[data-id="pay_status"]',data_parent).val();
	
	if (type_client == 0 && fio_client != '' || type_client == 1 && uid != '' || type_camp == 0 && camp_name != '' || type_camp == 1 && camp_id != '') {
	$.ajax({
       url: '/admin/claims/update/',
       type: 'post',
	   dataType: '',
       data: {
			claim_id: data_id,
			type_client: type_client,
			type_camp: type_camp,
			fio_client: fio_client,
			uid: uid,
			cost: cost,
			camp_name: camp_name,
			camp_id: camp_id,
			count_seats: count_seats,
			accommodation: accommodation,
			season: season,
			nutrition: nutrition,
			comment: comment,
			claim_status: claim_status,
			pay_status: pay_status
       },
       success: function (data) {
			alert('Заявка обновлена!');
			var date_update = data;
			updateInfoMainClaimBlock(date_update,data_parent,data_id);
       },
	   error: function() {
			alert('Ошибка при добавлении. Попробуйте позже.');
	   }
	});
	} else { alert('Проверьте корректность введенных данных.'); }
});

function updateInfoMainClaimBlock(date_update,data_parent,data_id) {
	var claim_view_block = '#claim_block'+data_id;
	
	var type_client = $('select[data-id="type_client"]',data_parent).val();
	var type_camp = $('select[data-id="type_camp"]',data_parent).val();

	var fio_client = $('input[data-id="fio_client"]',data_parent).val();
	var uid = $('select[data-id="uid"]',data_parent).val();
	var uid_txt = $('select[data-id="uid"] option[value="'+uid+'"]',data_parent).text();
	var camp_name = $('input[data-id="camp_name"]',data_parent).val();
	var camp_id = $('select[data-id="camp_id"]',data_parent).val();
	var camp_txt = $('select[data-id="camp_id"] option[value="'+camp_id+'"]',data_parent).text();
	var fio_client = $('input[data-id="fio_client"]',data_parent).val();
	var cost = $('input[data-id="cost"]',data_parent).val();
	var camp_name = $('input[data-id="camp_name"]',data_parent).val();
	var count_seats = $('input[data-id="count_seats"]',data_parent).val();
	var accommodation = $('select[data-id="accommodation"]',data_parent).val();
	var season = $('select[data-id="season"]',data_parent).val();
	var nutrition = $('select[data-id="nutrition"]',data_parent).val();
	var comment = $('textarea[data-id="comment"]',data_parent).val();
	var claim_status = $('select[data-id="claim_status"]',data_parent).val();
	var pay_status = $('select[data-id="pay_status"]',data_parent).val();
	
	var actual_season = '-';
	season = parseInt(season);
	switch (season) {
		case 0: actual_season = 'любой'; break;
		case 1: actual_season = 'весна'; break;
		case 2: actual_season = 'зима'; break;
		case 3: actual_season = 'лето'; break;
		case 4: actual_season = 'осень'; break;
	}

	var actual_claim_status = 'открыта';
	if (claim_status == 1) { actual_claim_status = 'закрыта'; }

	var actual_pay_status = 'не оплачен';
	if (pay_status == 1) { actual_pay_status = 'оплачен'; }
	
	if (type_client == 1) {
		$('.client-view-info',claim_view_block).html('<a href="/admin/users/view?id='+uid+'" target="_blank">'+uid_txt+'</a>');
	} else {
		$('.client-view-info',claim_view_block).html(fio_client);
	}
	if (type_camp == 1) {
		$('.camp-view-info',claim_view_block).html('<a href="/admin/objects/view?id='+camp_id+'" target="_blank">'+camp_txt+'</a>');
	} else {
		$('.camp-view-info',claim_view_block).html(camp_name);
	}
	
	$('.update-view-info',claim_view_block).html(date_update);
	$('.cost-view-info',claim_view_block).html(cost);
	$('.season-view-info',claim_view_block).html(actual_season);
	$('.count-view-info',claim_view_block).html(count_seats);
	$('.claim-status-view-info',claim_view_block).html(actual_claim_status);
	$('.pay-status-view-info',claim_view_block).html(actual_pay_status);
}


$('.sel-control-show').change(function() {
	var data_block = $(this).attr('data-block');
	var data_val = $(this).val();	
	SelControlShow(data_block,data_val);
});
function SelControlShow(data_block,data_val) {
	$('*[data-block-item]',data_block).hide();
	$('*[data-block-item='+data_val+']',data_block).fadeIn();
}

$(function (){
    $('a[data-toggle="tooltip"]').tooltip();
});

JS;
$this->registerJs($script00, yii\web\View::POS_READY);


$all_users = User::find()->where(['superuser'=>0])->all();
$all_camps = Camps::find()->all();
?>

<div class="modal fade" id="modal_add_claim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content module-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-left" id="request_modal_title">Создать заявку</h4>
      </div>
		<div class="modal-footer" style="text-align: left !important;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Тип клиента <a href="#" data-html="true" data-container="body" data-toggle="tooltip" data-placement="right" data-original-title="<b class='text-info'>Из БД</b> - заявка будет связана с пользователем который зарегистрирован. <br/><br/><b class='text-info'>Новый</b> - заявка не связана с пользователем из БД, вся информация о новом клиенте хранится только в текущей заявке (доп.информацию можно указать в комментарий).">?</a></label>
						<select data-block="#client_block" id="type_client" value="0" class="form-control sel-control-show">
							<option value="0">Новый</option>
							<option value="1">Из БД</option>
						</select>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form" id="client_block">
						<label>Клиент </label>
						<select id="uid" class="form-control start-hide" data-block-item="1">
						<?php
							foreach ($all_users as $user1) {
								echo '<option value="'.$user1->id.'">'.$user1->name.'</option>';
							}
						?>
						</select>
						<input type="text" class="form-control" id="fio_client" placeholder="ФИО" data-block-item="0" />
					</div>
					
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Тип лагеря <a href="#" data-html="true" data-container="body" data-toggle="tooltip" data-placement="right" data-original-title="<b class='text-info'>Из БД</b> - заявка будет связана с лагерем который внесен в базу данных. <br/><br/><b class='text-info'>Новый</b> - заявка не связана с лагерем из БД, вся информация о новом лагере хранится только в текущей заявке (доп.информацию можно указать в комментарий).">?</a></label>
						<select data-block="#camp_block" id="type_camp" value="0" class="form-control sel-control-show">
							<option value="0">Новый</option>
							<option value="1">Из БД</option>
						</select>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form" id="camp_block">
						<label>Лагерь </label>
						<div data-block-item="1" class="start-hide">
						<select id="camp_id" class="form-control js-chosen">
						<?php
							foreach ($all_camps as $camp) {
								echo '<option value="'.$camp->id.'">'.$camp->c_name.'</option>';
							}
						?>
						</select>
						</div>
						<input type="text" class="form-control" id="camp_name" placeholder="Название лагеря" data-block-item="0" />
					</div>
					
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Кол-во мест</label>
						<input type="number" class="form-control" id="count_seats" />
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Бюджет</label>
						<input type="text" class="form-control" id="cost" />
					</div>	
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Размещение</label>
						<select id="accommodation" class="form-control">
							<option value="1">1 местный</option>
							<option value="2">2х местный</option>
							<option value="3">3х местный</option>
							<option value="4">4х местный</option>
						</select>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Сезон</label>
						<select id="season" class="form-control">
							<option value="3">Лето</option>
							<option value="2">Зима</option>
							<option value="1">Весна</option>
							<option value="4">Осень</option>
							<option value="0">Любой</option>
						</select>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Питание</label>
						<select id="nutrition" class="form-control">
							<option value="1">Завтрак</option>
							<option value="2">Полупансион</option>
							<option value="3">Полный пансион</option>
							<option value="0">Полное</option>
						</select>
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Описание / комментарий</label>
						<textarea class="form-control" id="comment" rows="4"></textarea>
					</div>
					
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Статус заявки</label>
						<select id="claim_status" class="form-control">
							<option value="0">Открыта</option>
							<option value="1">Закрыта</option>
						</select>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Статус оплаты</label>
						<select id="pay_status" class="form-control">
							<option value="0">Не оплачено</option>
							<option value="1">Оплачено</option>
						</select>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 r-form">
						<button class="btn btn-danger" id="btn_clear_claim" type="button">Очистить данные</button> &nbsp;
						<button class="btn btn-success" id="btn_add_claim" type="button">Сохранить</button> 
					</div>
				</div>
		</div>
    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">
<a href="/admin/" class="btn btn-default mt30">← Назад</a>  <button type="button" data-toggle="modal" data-target="#modal_add_claim" class="btn btn-success mt30">Создать заявку</button><br/>
<h1><?php echo $this->title; ?></h1><br/>

<div class="col-lg-12 col-md-12" id="claims_block_main" style="margin-bottom:30px;">
<?php
$query = Claims::find()->orderBy('id DESC');
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
    'emptyText' => 'Заявок не добавлено',
    'emptyTextOptions' => [
        'tag' => 'p',
		'class' => 'text-center'
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12'
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

.claim-table thead {
	color:#999393;
}
.claim-table {
    margin: 0;
    font-size: 12px;
	text-align:center;
}
	
.panel-header {
	padding:15px;
	border-bottom:1px solid #ccc;
}
.panel-footer {
	min-height:55px;
}

.update-view-info {
	font-size:12px;
}

.claim-status {
    font-size: 30px;
    vertical-align: top;
    line-height: 0;
    padding-top: 7px;
	cursor:default;
    display: inline-block;
}

.claim-block .panel-body {
	padding:10px;
}

.r-form {
	margin-bottom:15px;
}

.claim-block-camp {
	padding-left:0;
}

.claim-block-camp a {
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