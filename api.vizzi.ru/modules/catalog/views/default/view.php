<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Cobjects;

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$keyq = Yii::$app->user->identity->keyq;
}

$cobj_cnt = Cobjects::find()->where(['id' => $id])->count();

if ($cobj_cnt > 0) {
	
$cobj = Cobjects::find()->where(['id' => $id])->one();

$this->title = $cobj->obj_title;
?>

<div class="modal fade" id="request_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content module-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-left" id="request_modal_title">Получить консультацию</h4>
      </div>
      <div class="modal-body">
		<input type="text" placeholder="Ваше имя" class="form-control" /><br/>
		<input type="text" placeholder="Ваш телефон" class="form-control" /><br/>
		<button class="btn btn-success" type="button">Отправить заявку</button>
		
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="cf_modal_get" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content module-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-left" id="cfmodallabel"><span class="p1">ГП-9, дом Монако</span> <span class="p2">(<small>33.75</small> м²)</span></h4>
      </div>
      <div class="modal-body">
		<span><u>Цена:</u> <small class="f-cost">2 472 000</small> руб.</span><br/>
		<span><u>Количество:</u> <small class="f-count">2</small></span><br/><br/>
		<span><u>Подъезд:</u> <small class="f-entr">1</small></span><br/>
		<span><u>Этаж:</u> <small class="f-floor">5</small></span><br/><br/><br/>
		
		<b>Получить консультацию</b><br/><br/>
		<input type="text" placeholder="Ваше имя" class="form-control" /><br/>
		<input type="text" placeholder="Ваш телефон" class="form-control" /><br/>
		<button class="btn btn-success" type="button">Отправить заявку</button>
		
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_bank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content module-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-left" id="">ВТБ</h4>
      </div>
      <div class="modal-body">
		<b>Выгодные ипотечные условия</b>
		<p>Только до конца 2021 года, выгодное предложение по кредитной ставке. Всего 5%.</p>
		<p>Подробнее можно узнать на <a href="https://www.vtb.ru/personal/ipoteka/" target="_blank">сайте</a> или <a href="https://www.vtb.ru/personal/ipoteka/" target="_blank">оформите заявку</a>.</p><br/><br/><br/>
		
		<b>Получить консультацию</b><br/><br/>
		<input type="text" placeholder="Ваше имя" class="form-control" /><br/>
		<input type="text" placeholder="Ваш телефон" class="form-control" /><br/>
		<button class="btn btn-success" type="button">Отправить заявку</button>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>




<section id="cart_content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cart-content animate__animated animate__fadeIn animate__delay-1s">
<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cart-content__info">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 banner-cart" style="<?php if ($cobj->obj_pic1 != '') { echo 'background:url('.$cobj->obj_pic1.') no-repeat;background-size:cover;background-position:center;'; } ?>"></div>
	
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt40 mb40">
		<span class="cart-title-txt" style="margin-left:0;"><?php echo $cobj->obj_title; ?></span>
		<p class="mt10 mb10"><img src="/img/icons/geo_green.png" /> <?php echo $cobj->obj_address; ?></p>
		<p><button class="btn btn-primary" type="button" data-title="Обратный звонок" data-toggle="modal" data-target="#request_modal">Позвонить</button> &nbsp;&nbsp; <button class="btn btn-primary dashed" type="button" data-title="Оставить заявку" data-toggle="modal" data-target="#request_modal">Продать свой дом</button> </p>
	</div>
	
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt50 mb40">
		<div class="mb20"><img src="/img/icons/cart/calendar.png" /> <b>Сроки сдачи</b> <span><?php echo $cobj->obj_arenda_start; ?></span></div>
		<div class="mb20"><img src="/img/icons/cart/ipoteka.png" /> <b>Ипотека</b> <span>от 8.9%</span></div>
	</div>
	
</div>


  <ul class="nav-tabs-anchors" style="justify-content: space-around;">
  <!-- Описание Галерея Характеристики Преимущества Выгода Выбор квартиры Инфраструктура Ход строительства Ипотека -->
    <li class="active"><a href="#desc" >Описание</a></li>
    <li><a href="#char" >Характеристики</a></li>
    <li><a href="#gallery" >Галерея</a></li>
    <li><a href="#ipoteka" >Ипотека</a></li>
  </ul>
  

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-tabs-anchors__item" id="desc">
		<?php echo $cobj->obj_desc; ?>
	</div>

	<!-- характеристики -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-tabs-anchors__item" id="char">



	<strong class="title mt50">Характеристики</strong>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="characterstics">
		<?php echo $cobj->obj_char; ?>
	</div>

<style>
	#characterstics table {
		width:100%;
		border:1px solid #ccc;
	}
	#characterstics table td {
	   border: 1px solid #ccc;
	   padding:10px;
	}
</style>

	</div>
	<!-- /характеристики -->
	
	<!-- галерея -->
<?php if ($cobj->obj_pic1 != '' || $cobj->obj_pic2 != '' || $cobj->obj_pic3 != '') { ?>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-tabs-anchors__item" id="gallery">
		<strong class="title">Галерея</strong>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gallery-block">
<?php if ($cobj->obj_pic1 != '') { ?>
			<div class="gallery-block__item"><a data-title="Изображение №1" data-lightbox="example-set" href="<?php echo $cobj->obj_pic1; ?>"><img src="<?php echo $cobj->obj_pic1; ?>" /></a></div>
<?php } ?>
<?php if ($cobj->obj_pic2 != '') { ?>
			<div class="gallery-block__item"><a data-title="Изображение №2" data-lightbox="example-set" href="<?php echo $cobj->obj_pic2; ?>"><img src="<?php echo $cobj->obj_pic3; ?>" /></a></div>
<?php } ?>
<?php if ($cobj->obj_pic3 != '') { ?>
			<div class="gallery-block__item"><a data-title="Изображение №3" data-lightbox="example-set" href="<?php echo $cobj->obj_pic3; ?>"><img src="<?php echo $cobj->obj_pic3; ?>" /></a></div>
<?php } ?>
		</div>
	</div>
<?php } ?>
	<!-- /галерея -->
	

	<!-- выгода -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-tabs-anchors__item" id="hod">
		<strong class="title">Выгода</strong>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 promo-slider-block">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 promo-slider-block__item">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 p0 promo-slider-block__item_pic" style="background:url('/img/promo_pic1.png') no-repeat;"></div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 promo-slider-block__item_text">
					<b>Акция</b>
					<p>Хотите купить квартиру, но без ипотеки? Для оформления рассрочки не нужны одобрение банков, подтверждение доходов и другая документация. Бронируйте квартиру на выгодных условиях!</p>
					<button class="btn btn-success" data-toggle="modal" data-target="#request_modal" data-title="Выгодное предложение" type="button">Заказать звонок</button>
				</div>
			</div>
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 promo-slider-block__item">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 p0 promo-slider-block__item_pic" style="background:url('/img/promo_pic1.png') no-repeat;"></div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 promo-slider-block__item_text">
					<b>Акция</b>
					<p>Хотите купить квартиру, но без ипотеки? Для оформления рассрочки не нужны одобрение банков, подтверждение доходов и другая документация. Бронируйте квартиру на выгодных условиях!</p>
					<button class="btn btn-success" data-toggle="modal" data-target="#request_modal" data-title="Выгодное предложение" type="button">Заказать звонок</button>
				</div>
			</div>
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 promo-slider-block__item">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 p0 promo-slider-block__item_pic" style="background:url('/img/promo_pic1.png') no-repeat;"></div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 promo-slider-block__item_text">
					<b>Акция</b>
					<p>Хотите купить квартиру, но без ипотеки? Для оформления рассрочки не нужны одобрение банков, подтверждение доходов и другая документация. Бронируйте квартиру на выгодных условиях!</p>
					<button class="btn btn-success" data-toggle="modal" data-target="#request_modal" data-title="Выгодное предложение" type="button">Заказать звонок</button>
				</div>
			</div>
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 promo-slider-block__item">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 p0 promo-slider-block__item_pic" style="background:url('/img/promo_pic1.png') no-repeat;"></div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 promo-slider-block__item_text">
					<b>Акция</b>
					<p>Хотите купить квартиру, но без ипотеки? Для оформления рассрочки не нужны одобрение банков, подтверждение доходов и другая документация. Бронируйте квартиру на выгодных условиях!</p>
					<button class="btn btn-success" data-toggle="modal" data-target="#request_modal" data-title="Выгодное предложение" type="button">Заказать звонок</button>
				</div>
			</div>

		</div>
	</div>
	<!-- /выгода -->



	<!-- ипотека -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-tabs-anchors__item" id="ipoteka">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 calc-block">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 calc-block__item">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<strong class="title">Ипотека</strong>
		</div>
		
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 calc-block__item_range">
			<label>Стоимость квартиры</label>
			<b id="sum_flat"><span>1000000</span> ₽</b>
			<input type="range" class="range-export" data-obj="#sum_flat" max="10000000" value="1000000" min="1000000">
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 calc-block__item_range">
			<label>Ставка</label>
			<b id="proc_flat"><span>5.3</span> %</b>
			<input type="range" class="range-export" data-obj="#proc_flat" min="5" value="5.3" max="13.5" step="0.1">
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 calc-block__item_range">
			<label>Ежемес. платеж</label>
			<b id="month_pay"><span>25 000</span> ₽</b>
		</div>
		
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 calc-block__item_range">
			<label>Первоначальный взнос</label>
			<b id="first_sum"><span>300000</span> ₽</b>
			<input type="range" class="range-export" data-obj="#first_sum" max="350000" value="300000" min="100000">
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 calc-block__item_range">
			<label>Срок</label>
			<b id="month_count"><span>180</span> мес.</b>
			<input type="range" class="range-export" data-obj="#month_count" min="36" value="180" max="360" step="1">
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 calc-block__item_range">
			<label>Необходимый доход</label>
			<b id="zp"><span>50 000</span> ₽</b>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 calc-block__item_range">
			<button class="btn btn-primary" data-toggle="modal" data-target="#modal_bank" type="button">Подать заявку</button>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 calc-block__item">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<strong class="title">Выбрать банк</strong>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<a href="#" data-toggle="modal" data-target="#modal_bank"><img src="/img/icons/vtb_alt.png" /></a>
		</div>
		
	</div>
</div>




<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form1-content">

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form1-content_pic">
	<img src="/img/form2.png" style="max-width:100%;" />
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<strong>Нужна помощь?</strong>
	<p>Оставьте заявку и наши специалисты помогут Вам в подборе недвижимости!</p>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 plr0 mt10">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<label>Имя</label>
		<input type="text" class="form-control" />
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<label>Телефон</label>
		<input type="text" class="form-control" />
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt10">
		<label><input type="checkbox" checked /> Согласен на обработку персональных данных</label>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt10">
		<button class="btn btn-primary" type="button">Оставить заявку</button>
	</div>
</div>
</div>

</div>

	</div>
	<!-- /ипотека -->


</div>
</section>



<style>
.nav-tabs-anchors {
    list-style: none;
    padding-left: 0;
    width: 100%;
    display: flex;
	border-top: 2px solid #EEF0F2;
	border-bottom: 2px solid #EEF0F2;
	margin-bottom:20px;
	padding-top:10px;
	padding-bottom:10px;
    overflow: auto;
    justify-content: space-between;
}
.nav-tabs-anchors li {
	padding-left:20px;
	padding-right:20px;
}
.nav-tabs-anchors li:nth-child(1) {
	padding-left:0;
}
.nav-tabs-anchors li:nth-last-child(1) {
	padding-right:0;
}
.nav-tabs-anchors li a {
	font-family: Open Sans;
	font-style: normal;
	font-weight: normal;
	font-size: 14px;
	line-height: 22px;
	color: #222;
}

.nav-tabs-anchors__item {
	margin-bottom:50px;
	padding-left:0;
	padding-right:0;
	float:left;
}

strong.title {
	width: 100%;
}

.slick-dots li button {
	border-radius:0;
}

.slick-dots li.slick-active button {
	border-radius:3px;
}

.slick-dots li:nth-child(1) button {
	border-top-left-radius:3px;
	border-bottom-left-radius:3px;
}
.slick-dots li:nth-last-child(1) button {
	border-top-right-radius:3px;
	border-bottom-right-radius:3px;
}

	.gallery-block__item img {
		max-width:100%;
	}
	.gallery-block__item {
		margin-left:5px;
		margin-right:5px;
		height:200px;
	}
	.slick-next, .slick-prev {
		display: none;
	}

	.slick-dots .slick-active button{
		background: #387DDD;
		height: 10px;
		width: 44px;
		display: block;
	}
	.slick-dots li button {
		background: #ededed;
		height: 10px;
		width: 44px;
		display: block;
	}

.modal small {
	font-size:100%;
}

.cf-right-panel {
	position:relative;
	overflow:auto;
	display:none;
}
.cf-right-panel tbody td span i {
    font-style: normal;
    text-align: center;
    display: inline-block;
    width: 59px;
	padding-top: 3px;
    height: 25px;
}
.cf-right-panel tbody td span u {
    text-decoration: none;
    text-align: center;
    display: inline-block;
    width: 18px;
	padding-top: 3px;
    height: 25px;
    vertical-align: top;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}

.cf-right-panel tbody td span {
	background: #c4c4c4;
	border-radius: 4px;
	display:block;
	width:80px;
	color:#fff;
	font-size:12px;
	padding:0;
	height:25px;
}

.cf-right-panel tbody td span.green {
	background: #679436;
	cursor:pointer;
}
.cf-right-panel tbody td span.blue {
	background: #014EBA;
	cursor:pointer;
}
.cf-right-panel tbody td span.yellow {
	background: #E6AF2E;
	cursor:pointer;
}
.cf-right-panel tbody td span.green u {
	background:#4A6A26;
}
.cf-right-panel tbody td span.yellow u {
	background:#EAA400;
}
.cf-right-panel tbody td span.blue u {
	background:#083F8C;
}



.cf-left-panel {
	padding-top:40px;
}
.cf-left-panel__item {
	display:block;
	padding:10px;
	cursor:pointer;
}
.cf-left-panel__item.active {
	background:#EEF0F2;
}
.cf-left-panel__item b {
	display:block;
}


#infro select {
	max-width:280px;
	margin-bottom:20px;
	display:block;
}

.promo-slider-block {
	
}
.promo-slider-block__item {
	background: #fff;
	box-shadow:0 0 10px rgba(0,0,0,0.1);
	border-radius: 10px;
	height:250px;
	margin-top:20px;
	margin-bottom:20px;
	margin-right:20px;
	padding-left:0;
	padding-right:0;
	transition:0.3s all;
}
.promo-slider-block__item:hover {
	box-shadow:0 0 10px rgba(0,0,0,0.3);
	transition:0.3s all;
}
.promo-slider-block__item_pic {
	height:250px;
	border-top-left-radius:10px;
	border-bottom-left-radius:10px;
	background-size:cover !important;
	background-position:center !important;
}
.promo-slider-block__item_text {
	padding-top:20px;
	padding-bottom:20px;
}
.promo-slider-block__item_text .btn {
	background: #679436;
	border-radius: 10px;
	font-size:14px;
}
.promo-slider-block__item_text p {
	font-family: Open Sans;
	font-style: normal;
	font-weight: normal;
	font-size: 14px;
	display:block;
	line-height: 19px;
	color: #222222;
}
.promo-slider-block__item_text b {
	font-family: Open Sans;
	font-style: normal;
	font-weight: 600;
	font-size: 22px;
	line-height: 30px;
	color: #222222;
	display:block;
	margin-bottom:20px;
}

.p0 {
	padding:0 !important;
}

.calc-block {
	padding-left:0;
	padding-right:0;
}
.calc-block__item_range {
	min-height:90px;
}

.calc-block__item label {
	font-family: Open Sans;
	font-style: normal;
	font-weight: normal;
	font-size: 12px;
	display:block;
	line-height: 20px;
	color: #222222;
}
.calc-block__item b span {
	font-family: Open Sans;
	font-style: normal;
}
.calc-block__item b {
	font-weight: 600;
	font-size: 18px;
	line-height: 20px;
	color: #222222;
}


@media(max-width:768px) {
promo-slider-block__item_text b {
    font-size: 20px;
    line-height: 20px;
}
.promo-slider-block__item_text p {
    font-size: 12px;
    line-height: 16px;
}

}
</style>



<?php
$script01 = <<< JS
$(document).ready(function() {
$('button[data-target="#request_modal"]').click(function() {
	var this_title = $(this).attr('data-title');
	if (this_title && this_title != '') {
		$('#request_modal_title').text(this_title);
	}
});
});

$(document).ready(function() {
$('.nav-tabs-anchors li a').click(function(){
	let anchor = $(this).attr('href');
	$('html, body').animate({
		scrollTop:  $(anchor).offset().top
	}, 600);
});
});

$(document).ready(function() {
	$('#map2').hide();$('#map3').hide();
});

$('#select_infro').change(function() {
	var this_val = $(this).val();
	
	$('#map1').hide();$('#map2').hide();$('#map3').hide();
	switch(this_val) {
		case '1': $('#map1').fadeIn(); break;
		case '2': $('#map2').fadeIn(); break;
		case '3': $('#map3').fadeIn(); break;
	}
});

    ymaps.ready(init);
    function init() {
        var myMap = new ymaps.Map("map1", {
            center: [47.323303, 39.687902],
            zoom: 16, // 0-19.
            controls: []
        });

        var myPlacemark = new ymaps.Placemark([47.323303, 39.687902], {
            hintContent: 'ЖК "Комфорт"',
            balloonContent: 'Россия, Ростов-на-Дону, переулок Андреева, 7'
        });
        myMap.geoObjects.add(myPlacemark);
    }
	
    ymaps.ready(init2);
    function init2() {
        var myMap = new ymaps.Map("map2", {
            center: [47.323345, 39.688935],
            zoom: 16, // 0-19.
            controls: []
        });

        var myPlacemark = new ymaps.Placemark([47.323345, 39.688935], {
            hintContent: 'ЖК "Комфорт"',
            balloonContent: 'Россия, Ростов-на-Дону, переулок Андреева, 8'
        });
        myMap.geoObjects.add(myPlacemark);
    }
	
    ymaps.ready(init3);
    function init3() {
        var myMap = new ymaps.Map("map3", {
            center: [47.322234, 39.688908],
            zoom: 16, // 0-19.
            controls: []
        });

        var myPlacemark = new ymaps.Placemark([47.322234, 39.688908], {
            hintContent: 'ЖК "Комфорт"',
            balloonContent: 'Россия, Ростов-на-Дону, переулок Андреева, 6'
        });
        myMap.geoObjects.add(myPlacemark);
    }


$(document).ready(function() {
$('#jk1').show();

	$('.modal-flat0').click(function() {
		var data_metr = $(this).attr('data-metr');
		var data_cost = $(this).attr('data-cost');
		var data_count = $(this).attr('data-count');
		var data_entrance = $(this).attr('data-entrance');
		var data_floor = $(this).attr('data-floor');
		var data_title = $(this).attr('data-title');
		
		$('#cf_modal_get .f-cost').text(data_cost);
		$('#cf_modal_get .f-count').text(data_count);
		$('#cf_modal_get .f-entr').text(data_entrance);
		$('#cf_modal_get .f-floor').text(data_floor);
		$('#cf_modal_get .modal-title small').text(data_metr);
		$('#cf_modal_get .modal-title .p1').text(data_title);
		$('#cf_modal_get').modal('show');
	});


$('.cf-left-panel__item').click(function() {
	var data_obj = $(this).attr('data-obj');
	$('.cf-left-panel__item').removeClass('active');
	
	$(this).addClass('active');
	$('#hod .cf-right-panel').hide();
	$(data_obj).fadeIn();
});

});


$(document).ready(function() {
	calcHypothec();
});

$('.calc-block .range-export').on('input', function() {
	var data_obj = $(this).attr('data-obj');
	var this_val = $(this).val();
	$('span', data_obj).text(this_val);
	
	calcHypothec();
});

//https://ipoteka-nedvizhimost.ru/kak-rasschitat-ipoteku/
function calcHypothec() {
	var sum_flat = 0;
	var proc_flat = 0;
	var first_sum = 0;
	var month_count = 0;
	
	var credit_sum = 0;
	var month_pay = 0;
	var zp_pay = 0;
	
	sum_flat = $('input[data-obj="#sum_flat"]').val();
	proc_flat = $('input[data-obj="#proc_flat"]').val();
	first_sum = $('input[data-obj="#first_sum"]').val();
	month_count = $('input[data-obj="#month_count"]').val();
	
	console.log(sum_flat);
	console.log(proc_flat);
	console.log(first_sum);
	console.log(month_count);
	
	credit_sum = parseFloat(sum_flat) * parseFloat(proc_flat) / 12;
	credit_sum = parseFloat(credit_sum) - parseFloat(first_sum);
	month_pay = parseFloat(credit_sum) / parseFloat(month_count);
	zp_pay = parseFloat(month_pay) * 2.1;
	
	$('#month_pay span').text(month_pay.toFixed(2)); // ежемесячный платеж
	$('#zp span').text(zp_pay.toFixed(2)); // необходимый доход
}

if($(window).width()<=768) {
    $('.promo-slider-block').slick({
        arrow: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });

    $('.gallery-block').slick({
        arrow: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });
} else {
    $('.promo-slider-block').slick({
        arrow: false,
        dots: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });

    $('.gallery-block').slick({
        arrow: false,
        dots: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });
}

$(document).ready(function() {

});
JS;
$this->registerJs($script01, yii\web\View::POS_READY);
?>



<?php } else { 
$this->title = '-';
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 materials">
<div class="container">
<p class="text-danger">Объект не найден</p>
</div>
</div>
<?php } ?>