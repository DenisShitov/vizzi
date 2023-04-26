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
?>


<div class="container admin-block">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<a href="/admin/objects/" class="btn btn-default mt30">← Назад</a><br/>
	<h3>Добавить новый объект</h3><br/>
</div>

<?php

$script3 = <<< JS
$('#btn_save').click(function() {
	var c_name = $('#c_name').val();
	var c_desc = $('#c_desc').val();
	var c_iso = $('#c_iso').val();
	var c_category = $('#c_category').val();
	var c_transfer = $('#c_transfer').val();
	var c_season = $('#c_season').val();
	var c_address = $('#c_address').val();
	var c_tags = JSON.stringify($('#c_tags').tagsinput('items'));
	var c_age_from = $('#c_age_from').val();
	var c_age_to = $('#c_age_to').val();
	var c_cost = $('#c_cost').val();
	var c_accommodation = $('#c_accommodation').val();
	var c_nutrition = $('#c_nutrition').val();
	var c_lim_op = $('#c_lim_op').val();
	var c_cash_discount = $('#c_cash_discount').val();
	var c_map_coord = $('#c_map_coord').val();
	var c_duration = $('#c_duration').val();
	var comment = $('#comment').val();
	
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
	
	if (c_name != '' && c_desc != '' && c_iso != '' && c_address != '') {
	$.ajax({
       url: '/admin/objects/save/',
       type: 'post',
	   dataType: '',
       data: {
			c_name: c_name,
			c_desc: c_desc,
			c_iso: c_iso,
			c_category: c_category,
			c_transfer: c_transfer,
			c_season: c_season,
			c_address: c_address,
			c_tags: c_tags,
			c_age_from: c_age_from,
			c_age_to: c_age_to,
			c_cost: c_cost,
			c_accommodation: c_accommodation,
			c_nutrition: c_nutrition,
			c_lim_op: c_lim_op,
			c_cash_discount: c_cash_discount,
			c_map_coord: c_map_coord,
			c_duration: c_duration,
			tour: tourData(),
			comment: comment,
			},
       success: function (data) {
			alert('Добавлено!');
			location.replace('/admin/objects/view?id='+data);
       },
	   error: function() {
			alert('Ошибка при добавлении. Попробуйте позже.');
	   }
	});
	}
});


/* $(document).ready(function() {
$('#char_template').click(function() {
	var char_temp = '<table><tr><td>Тип жилья</td><td>Новостройка</td></tr><tr><td>Площадь комнат</td><td>14.63 м²</td></tr><tr><td>Санузел</td><td>1 совмещенный</td></tr><tr><td>Балкон/лоджия</td><td>1 лоджия</td></tr><tr><td>Тип дома</td><td>Монолитный</td></tr><tr><td>Лифты</td><td>1 пассажирский</td></tr><tr><td>Парковка</td><td>Подземная</td></tr></table>';
	
	$('#obj_char').val(char_temp);
});
}); */

JS;
$this->registerJs($script3, yii\web\View::POS_READY);
?>
  <!--
    tour: {
      {
      'id_camp': 1,
      'tour_number': 3,
      'tour_from': 12123123123,
      'tour_to': 312312312312,
      }
    },
  -->

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 obj-view-input">
	<label>Наименование</label>
	<input type="text" id="c_name" value="" class="form-control" placeholder="" />
</div>

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 obj-view-input">
	<label>Категория</label>
	<select id="c_category" class="form-control" data-val="">
		<option value="1">Тематические</option>
		<option value="2">Развивающие</option>
		<option value="3">Спортивные</option>
		<option value="4">Оздоровительные</option>
	</select>
</div>

<div class="col-lg-12 col-md-2 col-sm-12 col-xs-12 p0">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
	<label>Описание</label>
	<textarea id="c_desc" class="form-control editor-element" rows="4"></textarea>
</div>

<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
	<label>Регион</label>
	<select id="c_iso" data-val="" class="form-control js-chosen">
	<?php
		foreach ($c_iso_arr as $ci_arr => $ci_key) {
			echo '<option value="'.$ci_arr.'">'.$ci_key.'</option>';
		}
	?>
	</select>
</div>

<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
	<label>Трансфер</label>
	<select id="c_transfer" class="form-control" data-val="">
		<option value="2">Автобус</option>
		<option value="1">Авиа</option>
		<option value="3">Ж/Д</option>
		<option value="4">Самостоятельно</option>
	</select>
</div>

<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
	<label>Сезон</label>
	<select id="c_season" class="form-control" data-val="">
		<option value="0">Любой</option>
		<option value="1">Весна</option>
		<option value="2">Зима</option>
		<option value="3">Лето</option>
		<option value="4">Осень</option>
		<option value="5">Весна + Лето</option>
		<option value="6">Осень + Зима</option>
	</select>
</div>

<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
	<label>Размещение</label>
	<select id="c_accommodation" class="form-control" data-val="">
		<option value="1">1 местный</option>
		<option value="2">2х местный</option>
		<option value="3">3х местный</option>
		<option value="4">4х местный</option>
	</select>
</div>

<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
	<label>Питание</label>
	<select id="c_nutrition" class="form-control" data-val="">
		<option value="0">Все</option>
		<option value="1">Завтрак</option>
		<option value="2">Полупансион</option>
		<option value="3">Полный пансион</option>
	</select>
</div>

<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
	<label>Условия для людей с огранич.возможностями</label>
	<select id="c_lim_op" class="form-control" data-val="">
		<option value="0">Нет</option>
		<option value="1">Да</option>
	</select>
</div>

<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
	<label>Наличие кэшбэка и скидок</label>
	<select id="c_cash_discount" class="form-control" data-val="">
		<option value="0">Нет</option>
		<option value="1">Да</option>
	</select>
</div>

<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
	<label>Координаты для карты</label>
	<input type="text" id="c_map_coord" value="" class="form-control" placeholder="" />
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
	<label>Адрес</label>
	<textarea id="c_address" class="form-control" rows="2"></textarea>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
	<label>Теги <span class="text-primary" title="Введите тег и нажмите Enter, чтобы добавить. Нажмите на [x] чтобы удалить тег (либо backspace).">?</span></label>
	<input type="text" id="c_tags" data-role="tagsinput" class="form-control" value="" placeholder="" />
</div>

<div class="tour-container col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
  <h3>Смены</h3>
  <botton onclick="tourData()">test</botton>
  <button style="margin: 20px 0" class="btn btn-success" onclick="addTour(event)">+ Добавить смену</button>
  <div class="tour-container-inner col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
    <div class="tour-input col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
        <label>Номер смены:</label>
        <input type="number"
               class="tour-input-number"
               value="2018-07-22">
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
        <label>Дата начала смены:</label>
        <input type="date" class="tour-input-start">
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 obj-view-input">
        <label>Дата конца смены:</label>
        <input type="date"class="tour-input-end">
      </div>
    </div>
  </div>
</div>

</div>


  <div class="col-lg-4 col-md-8 col-sm-12 col-xs-12 obj-view-input">
	  <label>Возраст <i>от, до</i></label>
    <div class="input-group">
      <input type="number" id="c_age_from" class="form-control" value="" placeholder="от" />
	  <span class="input-group-btn" style="width:0px;"></span>
      <input type="number" id="c_age_to" class="form-control" value="" placeholder="до" />
    </div>

  </div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 obj-view-input">
	<label>Стоимость</label>
	<div class="input-group">
	  <input type="text" id="c_cost" value="" class="form-control">
	  <span class="input-group-addon">₽</span>
	</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 obj-view-input">
	<label>Длительность</label>
	<div class="input-group">
	  <input type="number" id="c_duration" value="" class="form-control" placeholder="" />
	  <span class="input-group-addon">дни</span>
	</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input">
	<label>Комментарий</label>
	<textarea id="comment" class="form-control" rows="4"></textarea>
</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 obj-view-input text-left">
	<button id="btn_save" class="btn btn-success" rows="4">Добавить</button>
</div>

</div>

</div>

<script>
  var counterTour = 1;
  function addTour(event) {
    if(event.target.classList.contains('btn-success')){
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
    if(event.target.classList.contains('btn-danger')){
      event.target.parentElement.remove();
    }
  }
</script>
<style>
.obj-view-input {
	margin-bottom:30px;
}

.obj-view-input label {
	margin-bottom:10px;
	display:block;
}

.bootstrap-tagsinput {
	width: 100%;
}
.bootstrap-tagsinput input {
	width:100%;
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
.tour-input input{
  width: 100%;
}
label i {
	font-weight:normal !important;
	font-size:80%;
	font-style:normal !important;
}
</style>