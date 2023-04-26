<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\Camps;
use app\models\Tour;
use app\models\CampsFiles;
use app\models\Correlation;
use app\models\CampsCorrelation;
use app\models\InfrastructureImgs;

$id = isset($_GET['id']) ? $_GET['id'] : null;

$cobject_count = Camps::find()->where(['id' => $id])->count();
$tours = Tour::find()->where(['id_camp' => $id])->all();

$campTypes = CampsCorrelation::find()->select(['correlation_id'])->where(['camp_id' => $id])->asArray()->all();
$infPics = InfrastructureImgs::find()->where(['camp_id' => $id])->all();
$campTypesNew = [];
foreach ($campTypes as $key) {
  $campTypesNew[] = $key['correlation_id'];
}
$this->title = 'Объект не найден';
?>


<link href="/web/assets0/bootstrap-tagsinput.css" rel="stylesheet">
<link href="/web/assets0/chosen.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<?php
$this->registerJsFile(Yii::getAlias('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js'), ['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile(Yii::getAlias('@web/assets0/summernote-ru-RU.min.js'), ['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile(Yii::getAlias('@web/assets0/chosen.jquery.min.js'), ['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile(Yii::getAlias('@web/assets0/bootstrap-tagsinput.min.js'), ['depends' => 'yii\web\YiiAsset']);

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

$(document).ready(function(){
	$('.js-chosen').chosen({
		width: '100%',
		no_results_text: 'Совпадений не найдено',
		placeholder_text_single: 'Выберите регион'
	});
	
	$('#c_tags').tagsinput({
	  maxTags: 8
	});
});
JS;
$this->registerJs($script2, yii\web\View::POS_READY);

include(Yii::getAlias('@app/modules/admin/views/_parts/fadmin.php'));
include(Yii::getAlias('@app/modules/admin/views/_parts/c_iso_arr.php'));


?>
<script
  src="https://api-maps.yandex.ru/2.0/?load=package.standard&lang=ru-RU&apikey=692cc63f-0e24-408e-8085-6da78e18c232"
  type="text/javascript"></script>

<div class="container admin-block">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <a href="/admin/objects/" class="btn btn-default mt30">← Лагеря</a> <a href="/admin/"
                                                                             class="btn btn-default mt30">Админ-панель</a><br/>
      <h3>Просмотр/редактирование объекта №<?php echo $id; ?></h3><br/>
    </div>

    <?php
    if ($cobject_count > 0) {
    $cobject = Camps::find()->where(['id' => $id])->one();
    $this->title = $cobject->c_name;


    $script3 = <<< JS
$('#btn_save').click(function() {
  
	var c_name = $('#c_name').val();
	var c_desc = $('#c_desc').val();
  var c_desc_prog = $('#c_desc_prog').val();
  var c_desc_acc = $('#c_desc_acc').val();
  var c_desc_pay = $('#c_desc_pay').val();
	var c_iso = $('#c_iso').val();
	var c_address = $('#c_address').val();
	var c_tags = JSON.stringify($('#c_tags').tagsinput('items'));
	var c_age_from = $('#c_age_from').val();
	var c_age_to = $('#c_age_to').val();
	var c_cost = $('#c_cost').val();
	var c_lim_op = $('#c_lim_op').val();
	var c_discount = $('#c_discount').val();
	var c_map_coord = $('#c_map_coord').val();
	var c_duration = $('#c_duration').val();
	var comment = $('#comment').val();
	var types = [];
	function tourData() {
	    let tourObj = [];
    document.querySelectorAll('.tour-input').forEach(function (input, i) {
      let newObj = {};
      newObj['tour_number'] = input.querySelector('.tour-input-number').value;
      newObj['tour_from'] = input.querySelector('.tour-input-start').valueAsNumber/1000;
      newObj['tour_to'] = input.querySelector('.tour-input-end').valueAsNumber/1000;
      tourObj.push(newObj);
    });
    return tourObj;
	}
	
	function scheuleData() {
	  let arr = [];
	  const wrapper = document.querySelector('#schedule-wrapper');
	  wrapper.querySelectorAll('.schedule-el').forEach(el => {
	    let obj = {},
	    time = el.querySelector('input[name="time"]').value,
	    descr = el.querySelector('input[name="description"]').value,
	    day = el.dataset.dayNum,
	    part = el.dataset.dayPart;
	    if(time != '' && descr != ''){
	      obj.day = day;
	      obj.part = part;
	      obj.time = time;
	      obj.description = descr;
	    }
	    arr.push(obj)
	  })
	  return arr
	}
	
	var forms = document.querySelectorAll('.types-form');
	forms.forEach(el => {
	  var checked = el.querySelectorAll('input:checked');
	  checked.forEach(el => {
	    types.push(el.value)
	  })
	});
	
	if (c_name != '' || c_desc != '' || c_address != '' || c_tags != '' || c_age_from != '' || c_age_to != '' || c_cost != '' || c_lim_op != '' || c_discount != '' || c_map_coord != ''  || c_duration != '' || comment != '') {
	  $.ajax({
       url: '/admin/objects/update/',
       type: 'post',
	   dataType: '',
       data: {
			obj_id: $id,
			c_name: c_name,
			c_desc: c_desc,
			c_desc_prog: c_desc_prog,
			c_desc_acc: c_desc_acc,
			c_desc_pay: c_desc_pay,
			c_address: c_address,
			c_tags: c_tags,
			c_age_from: c_age_from,
			c_age_to: c_age_to,
			c_cost: c_cost,
			c_lim_op: c_lim_op,
			c_discount: c_discount,
			c_map_coord: c_map_coord,
			c_duration: c_duration,
			types: types,
			tour: tourData(),
			schedule: scheuleData(),
			comment: comment
       },
       success: function (data) {
			alert('Сохранено!');
       },
	   error: function(err) {
			alert('Ошибка при сохранении. Попробуйте позже.');
	   }
	});
	} 
});

function getRandomInt(min, max) {
	return Math.floor(Math.random() * (max - min)) + min;
}

    $('#myForm0').submit(function(e){
		var camp_id = $id;
		e.preventDefault();
        var formData = new FormData($(this)[0]);
		formData.append('camp_id', camp_id);
		var rand_int = getRandomInt(10000, 70000);
        $.ajax({
            type: 'post',
            url: '/admin/objects/picupload0/',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
				if (data != 'Error') {
					alert('Файл успешно загружен');
					$('#main_banner_pic').html('<img src="'+data+'?lastmod='+rand_int+'" style="width:150px;" />');
				} else {
					alert('Файл не загружен. Неверный формат файла или превышен допустимый размер (>1 mb).');
				}
            }
        });
        return false;
    });
   
   
	
    $('#myForm1').submit(function(e){
		var camp_id = $id;
		e.preventDefault();
        var formData = new FormData($(this)[0]);
		formData.append('camp_id', camp_id);
        $.ajax({
            type: 'post',
            url: '/admin/objects/picupload/',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
				if (data != 'Error') {
					alert('Файл успешно загружен');
					listDbSavePics();
				} else {
					alert('Файл не загружен. Неверный формат файла или превышен допустимый размер (>1 mb).');
				}
            }
        });
        return false;
    });
	
    $('#myForm2').submit(function(e){
		var camp_id = $id;
		e.preventDefault();
        var formData = new FormData($(this)[0]);
		formData.append('camp_id', camp_id);
        $.ajax({
            type: 'post',
            url: '/admin/objects/fileupload/',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
				if (data != 'Error') {
					alert('Файл успешно загружен');
					listDbSaveFiles();
				} else {
					alert('Файл не загружен. Неверный формат файла или превышен допустимый размер (>1 mb).');
				}
            }
        });
        return false;
    });

/* $(document).ready(function() {
	$('.myfiles-input').change(function(){
		var dfile_info =  $(this).attr('data-file_info');
		
		var text = $(this).val();
		var size = $(this).files[0].size;
		$('span',dfile_info).text(text);
		$('u',dfile_info).text(size);
	});

}); */

function listDbSavePics() {
	var camp_id = $id;

	$.ajax({
		url: '/admin/objects/getlistpics/',
		type: 'post',
		data: {camp_id: camp_id},
		success: function (data) {
			var count_data = data.length;

				$('#list_pics').html('');
				for (var ii=0;ii<count_data;ii++) {
					var file_id = data[ii].id;
					var file_src = data[ii].file_src;
					var file_name = data[ii].file_original_name;
					$('#list_pics').append('<div title="'+file_name+'" id="pic_unit'+file_id+'" class="pic_unit" style="background:url('+file_src+') no-repeat;"><button class="pic-unit-remove" title="Удалить изображение" data-id="'+file_id+'">x</button></div>');
				}
		},
		error: function() {
		}
	});
}

$('body').on('click','.pic-unit-remove',function() {
	var data_id = $(this).attr('data-id');
	if (confirm('Удалить изображение?')) {
	$.ajax({
		   url: '/admin/objects/fileremove/',
		   type: 'post',
		   dataType: '',
		   data: {
				id: data_id
		   },
		   success: function (data) {
				$('#pic_unit'+data_id).remove();
		   },
		   error: function() {
				alert('Ошибка при удалении. Попробуйте позже.');
		   }
	});
	}
});

$('body').on('click','.file-unit-remove',function() {
	var data_id = $(this).attr('data-id');
	if (confirm('Удалить файл?')) {
	$.ajax({
		   url: '/admin/objects/fileremove/',
		   type: 'post',
		   dataType: '',
		   data: {
				id: data_id
		   },
		   success: function (data) {
				$('#file_unit'+data_id).remove();
		   },
		   error: function() {
				alert('Ошибка при удалении. Попробуйте позже.');
		   }
	});
	}
});

function listDbSaveFiles() {
	var camp_id = $id;

	$.ajax({
		url: '/admin/objects/getlistfiles/',
		type: 'post',
		data: {camp_id: camp_id},
		success: function (data) {
			var count_data = data.length;

				$('#list_docs').html('');
				for (var ii=0;ii<count_data;ii++) {
					var file_id = data[ii].id;
					var file_src = data[ii].file_src;
					var file_name = data[ii].file_original_name;
					//$('#list_docs').append('<div class=\"unit\"><a class=\"btn btn-default\" href=\"'+file_src+'\" target=\"_blank\"><i class=\"material-icons\" style=\"font-size:12px;\">attach_file</i> '+file_name+'</a></div>');
					$('#list_docs').append('<div class="unit" id="file_unit'+file_id+'"><div class="input-group"><span class="txt">'+file_name+'</span><div class="input-group-btn"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="material-icons" style="font-size:14px;">file_open</i> <span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu"><li><a href="'+file_src+'" target="_blank">Просмотр</a></li><li><a href="#" class="file-unit-remove" data-id="'+file_id+'">Удалить</a></li></ul></div></div></div>');
				}
		},
		error: function() {
		}
	});
}


$(document).ready(function() {
	$(function(){
	  $('#b_docs .db_save_files').each(function (index, element) {
			var data_id = $(element).attr('data-id');
			listDbSaveFiles(data_id);
	  });
	});
});


$('.myfiles-input').bind('change', function() {
	var size = this.files[0].size;
	var name = this.files[0].name;
	var input_type = $(this).attr('data-input_type');
	var dfile_info =  $(this).attr('data-file_info');

	if (1000000 < size){
		alert('Размер больше 1 мб.');
	}
	
	//$('span',dfile_info).text(name);
	
	var fileExtension = ['png','jpg','jpeg'];
	if (input_type == 1) { var fileExtension = ['doc','pdf','txt','rtf']; }
	if ($.inArray(name.split('.').pop().toLowerCase(), fileExtension) == -1) {
		alert('Неподходящий тип файла');
	}
});



var myMap, myPlacemark, coords;
var coords = [55.7499,37.6290];

ymaps.ready(init);
function init(){
	
	myMap = new ymaps.Map('map', {
		center: coords, 
		zoom: 11, 
		behaviors: ['default', 'scrollZoom']
	});	
		
	var search_control = new ymaps.control.SearchControl({
		float: 'left',
		noPlacemark: true,
		width: 600,
		position: {
			top: 10,
			left: 10
		}
	});

	myMap.controls.add(search_control).add('zoomControl');

	myPlacemark = new ymaps.Placemark(coords,{}, {preset: "twirl#redIcon", draggable: true});	
	
	myPlacemark.events.add('dragend', function(e){
		var cord = e.get('target').geometry.getCoordinates();
		savecoordinats(cord);
	});

	myMap.geoObjects.add(myPlacemark);			
	
	myMap.events.add('click', function (e) {        
        var cord = e.get('coordPosition');
		savecoordinats(cord);
	});	
	
	search_control.events.add("resultselect", function (e) {
		var cord = search_control.getResultsArray()[0].geometry.getCoordinates();
		savecoordinats(cord);
	});
}
	
function savecoordinats(cord){	
	$('#ypoint').val(cord);
	ymaps.geocode(cord).then(function(res) {
		var data = res.geoObjects.get(0).properties.getAll();
		//$('#address').val(data.text);
	});
	myPlacemark.getOverlay().getData().geometry.setCoordinates(cord);	
}

$('#ypoint_set').click(function() {
	var ypoint_val = $('#ypoint').val();
	if (ypoint_val != '') {
		$('#c_map_coord').val(ypoint_val);
		$('#map_geo_get').modal('hide');
	}
});

$(document).ready(function(){
	//initCopy('#address-copy', function(){return $('#address').val()});
	//initCopy('#ypoint-copy', function(){return $('#ypoint').val()});

	$('#address, #ypoint').focus(function(){
		$(this).select();
	});
});

JS;
    $this->registerJs($script3, yii\web\View::POS_READY);
    ?>

    <div class="col-lg-12 col-md-12" style="margin-bottom:30px;">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#obj_info" aria-controls="obj_info" role="tab"
                                                  data-toggle="tab">Информация</a></li>

        <li role="presentation"><a href="#obj_pic" aria-controls="obj_pic" role="tab" data-toggle="tab">Изображения</a>
        </li>
        <li role="presentation"><a href="#obj_doc" aria-controls="obj_doc" role="tab" data-toggle="tab">Документы</a>
        </li>
      </ul>

      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="obj_info">

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
            <label>Наименование</label>
            <input type="text" id="c_name" value="<?php echo $cobject->c_name; ?>" class="form-control" placeholder=""/>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p0">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
              <label>Описание</label>
              <textarea id="c_desc" class="form-control editor-element"
                        rows="4"><?php echo $cobject->c_desc; ?></textarea>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
              <label>Программы</label>
              <textarea id="c_desc_prog" class="form-control editor-element"
                        rows="4"><?php echo $cobject->c_desc_prog; ?></textarea>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
              <label>Размещение</label>
              <textarea id="c_desc_acc" class="form-control editor-element"
                        rows="4"><?php echo $cobject->c_desc_acc; ?></textarea>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
              <label>Оплата</label>
              <textarea id="c_desc_pay" class="form-control editor-element"
                        rows="4"><?php echo $cobject->c_desc_pay; ?></textarea>
            </div>

            <?php
              $corr_types = Correlation::find()->select('type')->distinct()->all();
              foreach ($corr_types as $type) {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
              <p><b><?= $type->type ?></b></p>
              <form class="types-form" style="max-height: 250px; overflow-y: auto" action="" id="<?= $type->type ?>-form">
                <?php
                $corr_elements = Correlation::find()->where(['type' => $type->type])->asArray()->all();
                foreach ($corr_elements as $key => $trans) {
                  if($trans['type'] == 'region') {?>
                    <div  style="display: flex; gap: 5px">
                      <input type="radio" id="<?= $trans['type'] . $key ?>" value="<?= $trans['id'] ?>"
                             name="type[]" <?= in_array($trans['id'], $campTypesNew) ? 'checked' : '' ?>>
                      <label style="margin: 0" for="<?= $trans['type'] . $key ?>"><?= $trans['name'] ?></label>
                    </div>
                    <?php } else { ?>
                    <div style="display: flex; gap: 5px">
                      <input type="checkbox" id="<?= $trans['type'] . $key ?>" value="<?= $trans['id'] ?>"
                             name="type[]" <?= in_array($trans['id'], $campTypesNew) ? 'checked' : '' ?>>
                      <label style="margin: 0" for="<?= $trans['type'] . $key ?>"><?= $trans['name'] ?></label>
                    </div>
                    <?php } ?>
                <?php } ?>
              </form>
            </div>
            <?php } ?>


            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
              <label>Координаты для карты
                <button class="btn btn-info btn-sm" style="float:right;font-size:10px;" type="button"
                        data-toggle="modal" data-target="#map_geo_get">Получить координаты
                </button>
              </label>
              <input type="text" id="c_map_coord" value="<?php echo $cobject->c_map_coord; ?>" class="form-control"
                     placeholder=""/>
            </div>

            <div class="modal fade" id="map_geo_get" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content module-modal">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-left" id="request_modal_title">Получить координаты</h4>
                  </div>
                  <div class="modal-body">
                    <div id="map" style="width:100%; height:200px;"></div>
                  </div>
                  <div class="modal-footer" style="text-align: left !important;">
                    <div class="snp-form-row">
                      <label class="text-left">Координаты:</label>
                      <div class="toolbar">
                        <div class="input-group">
                          <input id="ypoint" type="text" disabled class="form-control">
                          <span class="input-group-btn">
					<button class="btn btn-default" id="ypoint_set" type="button">Выгрузить в поле</button>
					</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
              <label>Адрес</label>
              <textarea id="c_address" class="form-control" rows="2"><?php echo $cobject->c_address; ?></textarea>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
              <label>Теги <span class="text-primary"
                                title="Введите тег и нажмите Enter, чтобы добавить. Нажмите на [x] чтобы удалить тег (либо backspace).">?</span></label>
              <?php
              $arr_c_tags0 = $cobject->c_tags;
              $arr_c_tags1 = json_decode($arr_c_tags0);
              $arr_c_tags = implode(",", $arr_c_tags1);
              ?>
              <input type="text" id="c_tags" data-role="tagsinput" class="form-control"
                     value="<?php echo $arr_c_tags; ?>" placeholder=""/>
            </div>


            <div class="tour-container col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
              <h3>Смены</h3>
              <button style="margin: 20px 0" class="btn btn-success" onclick="addTour(event)">+ Добавить смену</button>
              <div class="tour-container-inner col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                foreach ($tours as $tour) { ?>
                  <div class="tour-input col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
                      <label>Номер смены:</label>
                      <input type="number"
                             class="tour-input-number"
                             value="<?= $tour->tour_number ?>">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
                      <label>Дата начала смены:</label>
                      <input type="date" class="tour-input-start" value="<?= date('Y-m-d', $tour->tour_from) ?>">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
                      <label>Дата конца смены:</label>
                      <input type="date" class="tour-input-end" value="<?= date('Y-m-d', $tour->tour_to) ?>">
                    </div>
                  </div>
                <?php }
                ?>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
              <h3>Расписание</h3>
              <div class="d-flex" id="schedule-day-control">
                <button class="btn btn-info" onclick="onScheduleDay(1)">Понедельник</button>
                <button class="btn btn-info" onclick="onScheduleDay(2)">Вторник</button>
                <button class="btn btn-info" onclick="onScheduleDay(3)">Среда</button>
                <button class="btn btn-info" onclick="onScheduleDay(4)">Четверг</button>
                <button class="btn btn-info" onclick="onScheduleDay(5)">Пятница</button>
                <button class="btn btn-info" onclick="onScheduleDay(6)">Суббота</button>
                <button class="btn btn-info" onclick="onScheduleDay(7)">Воскресенье</button>
              </div>
              <br>
              <div id="schedule-wrapper">
                <?php
                for ($i = 1; $i < 8; $i++) { ?>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 schedule hide" data-day-num="<?= $i ?>">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                      <h4>Утро</h4>
                      <div class="" style="display: flex; flex-direction: column; gap:5px">

                      </div>
                      <button type="button" class="btn btn-success btn-xs" style="font-size: 16px; margin-top: 1rem;"
                              onclick="addScheduleTime(event, <?= $i ?>, 1)">+
                      </button>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                      <h4>День</h4>
                      <div class="" style="display: flex; flex-direction: column; gap:5px">

                      </div>
                      <button type="button" class="btn btn-success btn-xs" style="font-size: 16px; margin-top: 1rem;"
                              onclick="addScheduleTime(event, <?= $i ?>, 2)">+
                      </button>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                      <h4>Обед</h4>
                      <div class="" style="display: flex; flex-direction: column; gap:5px">

                      </div>
                      <button type="button" class="btn btn-success btn-xs" style="font-size: 16px; margin-top: 1rem;"
                              onclick="addScheduleTime(event, <?= $i ?>, 3)">+
                      </button>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                      <h4>Вечер</h4>
                      <div class="" style="display: flex; flex-direction: column; gap:5px">

                      </div>
                      <button type="button" class="btn btn-success btn-xs" style="font-size: 16px; margin-top: 1rem;"
                              onclick="addScheduleTime(event, <?= $i ?>, 4)">+
                      </button>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>

            <style>
              .schedule {
                visibility: visible;
              }

              .schedule.hide {
                visibility: hidden;
              }
            </style>

            <script>
              function addScheduleTime(event, d, p) {
                const element = document.createElement('div');
                let cls = ['d-flex', 'schedule-el'];
                element.classList.add(...cls);
                element.dataset.dayNum = d;
                element.dataset.dayPart = p;
                element.innerHTML = `
        <input type="text" name="time" style="width: 20%" placeholder="00:00">
        <input type="text" name="description" placeholder="Описание">
      `;
                event.target.previousElementSibling.appendChild(element);
              }

              function onScheduleDay(num) {
                document.querySelectorAll('.schedule').forEach(el => {
                  if (el.dataset.dayNum == num) {
                    el.classList.remove('hide');
                  } else {
                    el.classList.add('hide');
                  }
                })
              }
            </script>


            <div class="col-lg-4 col-md-8 col-sm-12 col-xs-12 obj-view-input">
              <label>Возраст <i>от, до</i></label>
              <div class="input-group">
                <input type="number" id="c_age_from" class="form-control" value="<?php echo $cobject->c_age_from; ?>"
                       placeholder="от"/>
                <span class="input-group-btn" style="width:0px;"></span>
                <input type="number" id="c_age_to" class="form-control" value="<?php echo $cobject->c_age_to; ?>"
                       placeholder="до"/>
              </div>

            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 obj-view-input">
              <label>Стоимость</label>
              <div class="input-group">
                <input type="number" id="c_cost" value="<?php echo $cobject->c_cost; ?>" class="form-control">
                <span class="input-group-addon">₽</span>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 obj-view-input">
              <label>Скидка</label>
              <div class="input-group">
                <input type="number" id="c_discount"
                       value="<?= isset($cobject->c_discount) ? $cobject->c_discount : '0'; ?>" class="form-control">
                <span class="input-group-addon">%</span>
              </div>
            </div>


            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 obj-view-input">
              <label>Длительность</label>
              <div class="input-group">
                <input type="number" id="c_duration" value="<?php echo $cobject->c_duration; ?>" class="form-control"
                       placeholder=""/>
                <span class="input-group-addon">дни</span>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
              <label>Комментарий</label>
              <textarea id="comment" class="form-control" rows="4"><?php echo $cobject->comment; ?></textarea>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input text-left">
              <button id="btn_save" class="btn btn-success" rows="4">Сохранить</button>
            </div>

          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="obj_pic">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb30">
            <label>Главный баннер</label><br/>
            <div id="main_banner_pic"><?php
              if ($cobject->c_banner != '') {
                echo '<img src="' . $cobject->c_banner . '" style="width:150px;" />';
              } else {
                echo '<p>Главный баннер не загружен</p>';
              }
              ?></div>
            <form id="myForm0" action="">
              <div class="example-1">
                <div class="form-group">
                  <label class="label">
                    <input id="myFiles0" class="myfiles-input" data-file_info="#fileinfo1" type="file" name="myFiles"
                           accept=".png,.jpg,.jpeg"/>
                  </label>
                </div>
              </div>

              <div class="file-info" id="fileinfo1"><span></span> <u></u></div>
              <button type="submit" class="btn btn-sm btn-primary">Заменить</button>
            </form>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mb30">
            <label>Дополнительные изображения</label>
            <div id="list_pics" style="display:block;float:left;width:100%;margin-top:10px;margin-bottom:10px;">
              <?php
              $pics_count = CampsFiles::find()->where(['camp_id' => $id, 'file_type' => 0])->count();
              if ($pics_count > 0) {
                $pics_all = CampsFiles::find()->where(['camp_id' => $id, 'file_type' => 0])->orderBy('id DESC')->all();
                foreach ($pics_all as $pic) {
                  echo '<div title="' . $pic->file_original_name . '" class="pic_unit" id="pic_unit' . $pic->id . '" style="background:url(' . $pic->file_src . ') no-repeat;"><button class="pic-unit-remove" title="Удалить изображение" data-id="' . $pic->id . '">x</button></div>';
                }
              } else {
                echo '<p>Изображения не загружены</p>';
              }
              ?>
            </div>
            <form id="myForm1">
              <div class="example-1">
                <div class="form-group">
                  <label class="label">
                    <input id="myFiles1" class="myfiles-input" data-file_info="#fileinfo2" type="file" name="myFiles"
                           accept=".png,.jpg,.jpeg"/>
                  </label>
                </div>
              </div>

              <div class="file-info" id="fileinfo2"><span></span> <u></u></div>
              <button type="submit" class="btn btn-sm btn-primary">Загрузить</button>
            </form>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Картинки инфраструктуры</h3>
            <form action="" id="infrastructure-input" style="display: flex; gap: 10px; align-items: center">
              <input type="text" name="name" placeholder="Наименование обьекта">
              <input type="text" name="category" placeholder="Категория обьекта">
              <input type="file" name="file">
              <button type="button" class="btn btn-success" onclick="uploadInfrestructurePics(event)">+ Загрузить</button>
            </form>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
              <?php foreach ($infPics as $picture) {?>
                <div class="infpic-el">
                  <button type="button" class="btn btn-danger" onclick="delInfrestructurePic(event, <?= $picture->id ?>)">x</button>
                  <p style="margin: 0">Категория: <?= $picture->category ?></p>
                  <h5 style="margin: 0"><?= $picture->name ?></h5>
                  <img src="/web/<?= $picture->src ?>" alt="">
                </div>
              <?php } ?>
            </div>
          </div>
        </div>

        <script>
          async function uploadInfrestructurePics(event){
            const form = event.target.parentElement,
                  camp_id = <?= $id ?>;
            let formData = new FormData(form);
            formData.append('camp_id', camp_id);

            $.ajax({
                type: 'post',
                url: 'upload-infrastructure-pics/',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
            if (data != 'Error') {
              window.location.reload()
            } else {
            	alert('Файл не загружен. Неверный формат файла или превышен допустимый размер (>1 mb).');
            }}
            });
          }

          async function delInfrestructurePic(event, id) {
            $.ajax({
              type: 'post',
              url: 'del-infrastructure-pics/',
              data: {
                id: id,
              },
              success: function(data) {
                if (data != 'Error') {
                  window.location.reload()
                } else {
                  alert('Error');
                }}
            });
          }
        </script>
        <style>
          .infpic-el {
            position: relative;
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            border: 1px solid #6b7280;
            padding: 10px;
          }
          .infpic-el img {
            width: 120px;
          }
          .infpic-el button {
            position: absolute;
            bottom: 10px;
            right: 10px;
          }
        </style>

        <div role="tabpanel" class="tab-pane" id="obj_doc">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb30">
            <strong style="display: block;margin-bottom: 10px;">Загрузка документов</strong>
            <form id="myForm2">
              <div class="example-1">
                <div class="form-group">
                  <label class="label">
                    <input id="myFiles2" class="myfiles-input" data-file_info="#fileinfo3" type="file" name="myFiles"
                           data-input_type="1" accept=".doc,.pdf,.txt,.rtf"/>
                  </label>
                </div>
              </div>

              <div class="file-info" id="fileinfo3"><span></span> <u></u></div>
              <button type="submit" class="btn btn-sm btn-primary">Загрузить</button>
            </form>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mb30">
            <label>Список документов</label>
            <div id="list_docs" style="display:block;float:left;width:100%;margin-top:10px;margin-bottom:10px;">
              <?php
              $pics_count = CampsFiles::find()->where(['camp_id' => $id, 'file_type' => 1])->count();
              if ($pics_count > 0) {
                $docs_all = CampsFiles::find()->where(['camp_id' => $id, 'file_type' => 1])->orderBy('id DESC')->all();
                foreach ($docs_all as $doc) {
                  //echo '<div class="unit" id="file_unit'.$doc->id.'">'.$doc->file_original_name.' <button class="file-unit-remove" title="Удалить файл" data-id="'.$doc->id.'"><span class="material-icons">delete</span></button> <a href="'.$doc->file_src.'" target="_blank"><span class="material-icons">file_open</span></a></div>';
                  echo '<div class="unit" id="file_unit' . $doc->id . '"><div class="input-group"><span class="txt">' . $doc->file_original_name . '</span><div class="input-group-btn"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="material-icons" style="font-size:14px;">file_open</i> <span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu"><li><a href="' . $doc->file_src . '" target="_blank">Просмотр</a></li><li><a href="#" class="file-unit-remove" data-id="' . $doc->id . '">Удалить</a></li></ul></div></div></div>';
                }
              } else {
                echo '<p>Документы не загружены</p>';
              }
              ?>
            </div>
          </div>

        </div>


      </div>
    </div>


  </div>

  <?php } else { ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <p>Объект не найден или недоступен.</p>
    </div>
  <?php } ?>

</div>


<script>
  var counterTour = 1;

  function addTour(event) {
    if (event.target.classList.contains('btn-success')) {
      var tourInner = document.querySelector('.tour-container-inner');
      var newTourInput = document.createElement('div');
      newTourInput.classList.add('tour-input');
      newTourInput.classList.add('col-lg-12');
      newTourInput.classList.add('col-md-12');
      newTourInput.classList.add('col-sm-12');
      newTourInput.classList.add('col-xs-12');
      var newTourHtml = `
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
        <input type="number"
        class="tour-input-number">
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
        <input type="date" class="tour-input-start">
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
        <input type="date" class="tour-input-end">
      </div>
      <button class="btn btn-danger tour-delete" onclick="addTour(event)">x</button>
      `;
      newTourInput.innerHTML = newTourHtml;
      tourInner.appendChild(newTourInput);
    }
    if (event.target.classList.contains('btn-danger')) {
      event.target.parentElement.remove();
    }
  }
</script>


<style>
  .obj-view-input {
    margin-bottom: 30px;
  }

  .obj-view-input label {
    margin-bottom: 10px;
    display: block;
  }

  .bootstrap-tagsinput {
    width: 100%;
  }

  .bootstrap-tagsinput input {
    width: 100%;
  }

  label i {
    font-weight: normal !important;
    font-size: 80%;
    font-style: normal !important;
  }

  .tour-input {
    box-sizing: border-box;
    position: relative;
  }

  .tour-delete {
    position: absolute;
    right: -30px;
    top: -5px;
  }

  .tour-input input {
    width: 100%;
  }

  #myForm0 label, #myForm1 label, #myForm2 label {
    color: #555;
  }

  #list_pics img {
    margin-bottom: 5px;
  }

  #list_docs .unit {
    margin: 5px;
    display: inline-block;
    width: 48%;
  }

  #list_docs .unit span.txt {
    background: #fff;
    display: block;
    border: 1px solid #ccc;
    height: 34px;
    line-height: 32px;
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    padding-left: 10px;
    overflow: auto;
  }

  .pic_unit {
    width: 100px;
    height: 100px;
    margin: 5px;
    display: inline-block;
    background-size: cover !important;
    background-position: center !important;
    position: relative;
  }

  .pic-unit-remove {
    opacity: 0;
    background: #fff;
    border-radius: 0;
    border: 0;
    color: #111;
    font-size: 10px;
    position: absolute;
    top: 5px;
    right: 5px;
    transition: 0.3s all;
  }

  .pic_unit:hover .pic-unit-remove {
    transition: 0.3s all;
    opacity: 1;
  }
</style>