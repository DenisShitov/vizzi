<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Jk;

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$keyq = Yii::$app->user->identity->keyq;
}

$jk_obj_cnt = Jk::find()->where(['id' => $id])->count();

if ($jk_obj_cnt > 0) {
	
$jk_obj = Jk::find()->where(['id' => $id])->one();

$this->title = $jk_obj->title;
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
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 banner-cart" style=""></div>
	
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt40 mb40">
		<span class="balls">8,5</span> <span class="cart-title-txt">ЖК "Комфорт"</span>
		<div class="rating-stars"><img src="/img/icons/cart/star.png" /> <img src="/img/icons/cart/star.png" /> <img src="/img/icons/cart/star.png" /> <img src="/img/icons/cart/star.png" /> <img src="/img/icons/cart/star.png" class="gray" /></div>
		<p class="mt10 mb10"><img src="/img/icons/geo_green.png" /> Ростовская область, Ростов-на-Дону, р-н Октябрьский, мкр. Суворовский, переулок Андреева, 7</p>
		<p><button class="btn btn-primary" type="button" data-title="Обратный звонок" data-toggle="modal" data-target="#request_modal">Позвонить</button> &nbsp;&nbsp; <button class="btn btn-primary dashed" type="button" data-title="Оставить заявку" data-toggle="modal" data-target="#request_modal">Продать свой дом</button> </p>
	</div>
	
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt50 mb40">
		<div class="mb20"><img src="/img/icons/cart/calendar.png" /> <b>Сроки сдачи</b> <span>3 кв. 2021, 3 кв. 2022</span></div>
		<div class="mb20"><img src="/img/icons/cart/ipoteka.png" /> <b>Ипотека</b> <span>от 8.9%</span></div>
		<div class="mb20"><img src="/img/icons/cart/layers.png" /> <b>Вариант отделки</b> <span>Предчистовая отделка</span></div>
		<div class="mb20"><img src="/img/icons/cart/stroy.png" /> <b>Застройщик</b> <span>МСК Московская Строительная Компания</span></div>
	</div>
	
</div>


  <ul class="nav-tabs-anchors">
  <!-- Описание Галерея Характеристики Преимущества Выгода Выбор квартиры Инфраструктура Ход строительства Ипотека -->
    <li class="active"><a href="#desc" >Описание</a></li>
    <li><a href="#char" >Характеристики</a></li>
    <li><a href="#gallery" >Галерея</a></li>
    <li><a href="#preim" >Преимущества</a></li>
    <li><a href="#infro" >Инфраструктура</a></li>
    <li><a href="#preim" >Выгода</a></li>
    <li><a href="#choose" >Выбор квартиры</a></li>
    <li><a href="#hod" >Ход строительства</a></li>
    <li><a href="#ipoteka" >Ипотека</a></li>
  </ul>
  

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-tabs-anchors__item" id="desc">
		 <p>Жилой комплекс «Комфорт» - станет драгоценностью среди новостроек Ростова комфорт-класса. Застройщик Московская Строительная Компания (МСК) умеет гармонично вписать новые дома в обжитую городскую среду: три дома комфорт-класса разной этажности дополнят пейзаж Кировского района.</p>
		<p>На закрытой территории комплекса запланированы:
		<ul>
		<li>собственное футбольное поле и спортивные площадки;</li>
		<li>детские площадки, имеющие безопасное покрытие современными материалами;</li>
		<li>благоустроенный внутренний двор с пешеходными дорожками, скамейками, высаженными кустарниками и цветами;</li>
		<li>зоны барбекю для отдыха в приятной компании друзей и соседей;</li>
		<li>крупный торгово-развлекательный комплекс, куда можно попасть, не выходя за пределы комплекса.</li>
		</ul>
		</p>
		<p>Квартиры эргономичных планировок имеют панорамное остекление, благодаря которым открываются шикарные виды.</p>
		<p>Несомненным преимуществом ЖК «Рубин» будет его расположение: центр города со множеством магазинов, ресторанов и кафе. Вокруг комплекса – 3 кинотеатра, 7 фитнес-клубов, 4 парка, 11 школ, 16 детских садов. Одним словом, все, что нужно для жизни современного человека.</p>
		<p>Дизайнерская отделка входных групп, просторный подземный паркинг и привлекательная облицовка фасадов влюбляют в «Рубин» еще больше.</p>
		<p>Цены на квартиры вполне соответствуют качеству и начинаются от 1,8 млн. руб.</p>
	</div>

	<!-- характеристики -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-tabs-anchors__item" id="char">
		<strong class="title">Рейтинг</strong>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<span class="balls">8,5</span> <span class="cart-title-txt">ЖК "Комфорт"</span>
		<div class="rating-stars"><img src="/img/icons/cart/star.png" /> <img src="/img/icons/cart/star.png" /> <img src="/img/icons/cart/star.png" /> <img src="/img/icons/cart/star.png" /> <img src="/img/icons/cart/star.png" class="gray" /></div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
		<label>Расположение</label>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
			<span class="sr-only">60% Complete</span>
		  </div>
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
		<label>Цена</label>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 55%;">
			<span class="sr-only">55% Complete</span>
		  </div>
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
		<label>Ипотека</label>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
			<span class="sr-only">40% Complete</span>
		  </div>
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
		<label>Инфраструктура</label>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
			<span class="sr-only">50% Complete</span>
		  </div>
		</div>
	</div>
	
	</div>



	<strong class="title mt50">Характеристики</strong>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb20">
			<b>Тип жилья</b><br/>
			<span>новостройка</span>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb20">
			<b>Тип дома</b><br/>
			<span>монолитный</span>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb20">
			<b>Площадь комнат</b><br/>
			<span>14.63 м2</span>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb20">
			<b>Парковка</b><br/>
			<span>подземная</span>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb20">
			<b>Санузел</b><br/>
			<span>1 совмещенный</span>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb20">
			<b>Лифты</b><br/>
			<span>1 пассажирский</span>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb20">
			<b>Балкон/лоджия</b><br/>
			<span>1 лоджия</span>
		</div>
		
	</div>

	</div>
	<!-- /характеристики -->
	
	<!-- галерея -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-tabs-anchors__item" id="gallery">
		<strong class="title">Галерея</strong>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gallery-block">
			<div class="gallery-block__item"><a data-title="Галерея №1" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/1.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Галерея №2" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/2.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Галерея №3" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/3.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Галерея №4" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/4.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Галерея №5" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/1.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Галерея №6" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/2.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Галерея №7" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/3.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Галерея №8" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/4.png" /></a></div>
		</div>
	</div>
	<!-- /галерея -->
	

	
	<!-- преимущества -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-tabs-anchors__item" id="preim">
		<strong class="title">Преимущества</strong>

		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pre-block mb20">
			<img src="/img/icons/cart/pre/camera.png" />
			<span>Камеры в доме</span>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pre-block mb20">
			<img src="/img/icons/cart/pre/door.png" />
			<span>Входная группа</span>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pre-block mb20">
			<img src="/img/icons/cart/pre/transport.png" />
			<span>Транспортная доступность</span>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pre-block mb20">
			<img src="/img/icons/cart/pre/child.png" />
			<span>Детская площадка</span>
		</div>
	
	</div>
	<!-- /преимущества -->

	<!-- инфраструктура -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-tabs-anchors__item" id="infro">
		<strong class="title">Инфраструктура</strong>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<select class="form-control" id="select_infro">
			<option value="1">Инфраструктура №1</option>
			<option value="2">Инфраструктура №2</option>
			<option value="3">Инфраструктура №3</option>
		</select>
			<div id="map1" style="width:100%;height:400px;"></div>
			<div id="map2" style="width:100%;height:400px;"></div>
			<div id="map3" style="width:100%;height:400px;"></div>
		</div>
	</div>
	<!-- /инфраструктура -->

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

	<!-- выбор квартиры -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-tabs-anchors__item" id="hod">
		<strong class="title">Выбор квартиры</strong>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 cf-left-panel">
			<div class="cf-left-panel__item active" data-obj="#jk1"><b>ГП-9, дом Монако (290 квартир)</b><span>сдан</span></div>
			<div class="cf-left-panel__item" data-obj="#jk2"><b>ГП-2, Дом «Неаполь» (177 квартир)</b><span>будет сдан 16.02.2021</span></div>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 cf-right-panel" id="jk1">
			<table class="table">
				<thead>
					<tr>
						<td></td>
						<td>33.75 м²</td>
						<td>36 м²</td>
						<td>64 м²</td>
						<td>74.50 м²</td>
						<td>85 м²</td>
						<td>93 м²</td>
						<td>101 м²</td>
						<td>113 м²</td>
						<td>125.33 м²</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>5</td>
						<td><span class="green modal-flat0" data-title="ГП-9, дом Монако" data-metr="33.75" data-cost="2 472 000" data-count="2" data-entrance="1" data-floor="5"><i>2 472 т.р</i> <u>2</u></span></td>
						<td><span class="yellow modal-flat0" data-title="ГП-9, дом Монако" data-metr="36" data-cost="2 472 000" data-count="2" data-entrance="1" data-floor="5"><i>2 472 т.р</i> <u>2</u></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span class="yellow modal-flat0" data-title="ГП-9, дом Монако" data-metr="85" data-cost="3 472 000" data-count="3" data-entrance="1" data-floor="5"><i>3 472 т.р</i> <u>3</u></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span class="green modal-flat0" data-title="ГП-9, дом Монако" data-metr="125.33" data-cost="5 765 000" data-count="2" data-entrance="1" data-floor="5"><i>5 765 т.р</i> <u>2</u></span></td>
					</tr>
					<tr>
						<td>4</td>
						<td><span class="green modal-flat0" data-title="ГП-9, дом Монако" data-title="ГП-9, дом Монако" data-metr="33.75" data-cost="2 472 000" data-count="2" data-entrance="1" data-floor="4"><i>2 472 т.р</i> <u>2</u></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span class="blue modal-flat0" data-title="ГП-9, дом Монако" data-metr="85" data-cost="3 472 000" data-count="3" data-entrance="1" data-floor="4"><i>3 472 т.р</i> <u>3</u></span></td>
						<td><span></span></td>
						<td><span class="blue modal-flat0" data-title="ГП-9, дом Монако" data-metr="101" data-cost="4 272 000" data-count="2" data-entrance="1" data-floor="4"><i>4 272 т.р</i> <u>2</u></span></td>
						<td><span></span></td>
						<td><span></span></td>
					</tr>
					<tr>
						<td>3</td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span class="blue modal-flat0" data-title="ГП-9, дом Монако" data-metr="74.50" data-cost="3 472 000" data-count="3" data-entrance="1" data-floor="3"><i>3 472 т.р</i> <u>3</u></span></td>
						<td><span class="green modal-flat0" data-title="ГП-9, дом Монако" data-metr="85" data-cost="3 472 000" data-count="3" data-entrance="1" data-floor="3"><i>3 472 т.р</i> <u>3</u></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
					</tr>
					<tr>
						<td>2</td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span class="green modal-flat0" data-title="ГП-9, дом Монако" data-metr="113" data-cost="2 472 000" data-count="2" data-entrance="1" data-floor="2"><i>2 472 т.р</i> <u>2</u></span></td>
						<td><span></span></td>
					</tr>
					<tr>
						<td>1</td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span class="yellow modal-flat0" data-title="ГП-9, дом Монако" data-metr="85" data-cost="3 472 000" data-count="2" data-entrance="1" data-floor="1"><i>3 472 т.р</i> <u>3</u></span></td>
						<td><span></span></td>
						<td><span class="yellow modal-flat0" data-title="ГП-9, дом Монако" data-metr="101" data-cost="4 272 000" data-count="2" data-entrance="1" data-floor="1"><i>4 272 т.р</i> <u>2</u></span></td>
						<td><span></span></td>
						<td><span></span></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 cf-right-panel" id="jk2">
			<table class="table">
				<thead>
					<tr>
						<td></td>
						<td>33.75 м²</td>
						<td>36 м²</td>
						<td>64 м²</td>
						<td>74.50 м²</td>
						<td>85 м²</td>
						<td>93 м²</td>
						<td>101 м²</td>
						<td>113 м²</td>
						<td>125.33 м²</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>5</td>
						<td><span class="blue modal-flat0" data-title="ГП-2, Дом «Неаполь»" data-metr="33.75" data-cost="2 472 000" data-count="2" data-entrance="1" data-floor="5"><i>2 472 т.р</i> <u>2</u></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span class="green modal-flat0" data-title="ГП-2, Дом «Неаполь»" data-metr="85" data-cost="3 472 000" data-count="3" data-entrance="1" data-floor="5"><i>3 472 т.р</i> <u>3</u></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span class="yellow modal-flat0" data-title="ГП-2, Дом «Неаполь»" data-metr="125.33" data-cost="5 765 000" data-count="2" data-entrance="1" data-floor="5"><i>5 765 т.р</i> <u>2</u></span></td>
					</tr>
					<tr>
						<td>4</td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span class="blue modal-flat0" data-title="ГП-2, Дом «Неаполь»" data-metr="85" data-cost="4 272 000" data-count="2" data-entrance="1" data-floor="4"><i>4 272 т.р</i> <u>2</u></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
					</tr>
					<tr>
						<td>3</td>
						<td><span></span></td>
						<td><span class="blue modal-flat0" data-title="ГП-2, Дом «Неаполь»" data-metr="36" data-cost="3 472 000" data-count="3" data-entrance="1" data-floor="3"><i>3 472 т.р</i> <u>3</u></span></td>
						<td><span class="green modal-flat0" data-title="ГП-2, Дом «Неаполь»" data-metr="64" data-cost="3 472 000" data-count="3" data-entrance="1" data-floor="3"><i>3 472 т.р</i> <u>3</u></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
					</tr>
					<tr>
						<td>2</td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span class="green modal-flat0" data-title="ГП-2, Дом «Неаполь»" data-metr="85" data-cost="2 472 000" data-count="2" data-entrance="1" data-floor="2"><i>2 472 т.р</i> <u>2</u></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
					</tr>
					<tr>
						<td>1</td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span class="yellow modal-flat0" data-title="ГП-2, Дом «Неаполь»" data-metr="85" data-cost="3 472 000" data-count="2" data-entrance="1" data-floor="1"><i>3 472 т.р</i> <u>3</u></span></td>
						<td><span class="green modal-flat0" data-title="ГП-2, Дом «Неаполь»" data-metr="93" data-cost="4 272 000" data-count="2" data-entrance="1" data-floor="1"><i>4 272 т.р</i> <u>2</u></span></td>
						<td><span></span></td>
						<td><span></span></td>
						<td><span></span></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!-- /выбор квартиры -->
	


	<!-- ход строительства -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-tabs-anchors__item" id="hod">
		<strong class="title">Ход строительства</strong>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gallery-block">
			<div class="gallery-block__item"><a data-title="Ход строительства №1" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/1.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Ход строительства №2" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/2.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Ход строительства №3" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/3.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Ход строительства №4" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/4.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Ход строительства №5" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/1.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Ход строительства №6" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/2.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Ход строительства №7" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/3.png" /></a></div>
			<div class="gallery-block__item"><a data-title="Ход строительства №8" data-lightbox="example-set" href="/img/jk_cart_bg.png"><img src="/img/gallery_cart/4.png" /></a></div>
		</div>
	</div>
	<!-- /ход строительства -->

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
<p class="text-danger">Материал не найден</p>
</div>
</div>
<?php } ?>