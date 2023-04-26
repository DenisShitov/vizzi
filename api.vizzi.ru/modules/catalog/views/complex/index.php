<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
//use app\models\Jk;
use app\modules\catalog\models\Materials;

$this->title = 'Каталог';
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$keyq = Yii::$app->user->identity->keyq;
}
?>



<?php
/*
$query = Materials::find()->orderBy('id DESC');

$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_post',
	'summary' => '',
    'emptyText' => 'Раздел временно не доступен',
    'emptyTextOptions' => [
        'tag' => 'p',
		'class' => 'text-center'
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'col-lg-6'
    ],	
]);
*/
?>

<section id="catalog_service" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service animate__animated animate__fadeInDown animate__delay-0_5s">
<div class="container">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-title">
	<h3>Купить квартиру <button class="btn btn-default fl-right" id="show_hide_filter" type="button">Скрыть фильтр</button></h3> 
	
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-filter" data-show="1">
	<div class="catalog-service-filter__item">
		<label>Количество комнат</label> 
		<button class="btn btn-default"type="button">1</button> 
		<button class="btn btn-default"type="button">2</button> 
		<button class="btn btn-default"type="button">3</button> 
		<button class="btn btn-default"type="button">4+</button>
	</div>
	<div class="catalog-service-filter__item fields">
		<label>Цена</label> 
		<input type="text" class="form-control" placeholder="от" /> 
		<input type="text" class="form-control" placeholder="до" />
	</div>
	<div class="catalog-service-filter__item fields">
		<label>Площадь, м2</label> 
		<input type="text" class="form-control" placeholder="от" /> 
		<input type="text" class="form-control" placeholder="до" />
	</div>

	<div class="catalog-service-filter__item">
		<label>Тип недвижимости</label> 
		<select class="form-control">
			<option value="0">Новостройки</option>
			<option value="1">Вторичка</option>
		</select>
	</div>
	
	<div class="catalog-service-filter__item">
		<label>Тип строения</label> 
		<select class="form-control">
			<option value="0">Жилой комплекс</option>
			<option value="1">Частный дом</option>
		</select>
	</div>
	
	<div class="catalog-service-filter__item">
		<label>Город, район, метро</label> 
		<input type="text" class="form-control w100" />
	</div>

	<div class="catalog-service-filter__item">
		<label>&nbsp;</label> 
		<button class="btn btn-primary dashed" type="button">Выбрать область</button> &nbsp;&nbsp;
		<button class="btn btn-primary" type="button">Еще параметры</button>
	</div>
	
</div>


</div>

</div>
</section>


<section id="catalog_service_content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-content animate__animated animate__fadeIn animate__delay-1s">
<div class="container">


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-content__info">
	<span>Пoдoбpaнo: 1464 квapтиpы </span> 
	<span>5 429 предложений отсортированы <select class="select-trans"><option value="1">по умолчанию</option><option value="2">по цене</option></select></span> 
	<a href="#"><img src="/img/icons/filter1.png" /></a> 
	<a href="#"><img src="/img/icons/filter2.png" /></a> 

</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="catalog_grid_with_map">
<div class="items">


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-content__items">

<div id="spinningSquaresG"><div id="spinningSquaresG_1" class="spinningSquaresG"></div><div id="spinningSquaresG_2" class="spinningSquaresG"></div><div id="spinningSquaresG_3" class="spinningSquaresG"></div><div id="spinningSquaresG_4" class="spinningSquaresG"></div><div id="spinningSquaresG_5" class="spinningSquaresG"></div><div id="spinningSquaresG_6" class="spinningSquaresG"></div><div id="spinningSquaresG_7" class="spinningSquaresG"></div><div id="spinningSquaresG_8" class="spinningSquaresG"></div></div>

<div class="hidden">
<div class="catalog-service-content__item0">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-content__item animate__animated animate__fadeInLeft">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-content__item_pic" style="background:url('/img/test_jk.png') no-repeat;"><a href="#"><img src="/img/icons/white_heart.png" /></a></div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-content__item_txt">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<strong>ЖК "Комфорт" </strong>
			<span><img src="/img/icons/geo_green.png" /> р-н Октябрьский, мк. Суворовский, переулок Андреева,7</span> 
			<strong>от 1 922 000 р.</strong> 
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<span>Срок сдачи</span> 
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
			<span>4 кв. 2020 - 4 кв. 2021</span> 
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<b>246 квартир</b>  
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<a href="/catalog/default/view/1" class="btn btn-primary">Подробнее</a>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
			<button class="btn btn-primary alt" type="button">Сравнить</button> 
		</div>
		</div>
	</div>
</div>
</div>

</div>

</div>


<div id="map" class="hidden-sm hidden-xs animate__animated animate__fadeInRight"><div class="cursor-zone" data-act="0"></div><div class="map_content"></div></div>


</div>
</div>



</section>







<section id="form1_content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12  animate__animated animate__fadeInUp animate__delay-0_5s">
<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form1-content">

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form1-content_pic">
	<img src="/img/consult.png" style="max-width:100%;" />
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<strong>Нужна помощь в подборе лучших предложений?</strong>
	<p>Оставьте заявку, и риэлторы подберут недвижимость согласно вашим требованим в кратчайшие сроки</p>
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
</section>


<style>
.catalog_grid_with_map {
    display: flex;
    flex-direction: row;
}
.catalog_grid_with_map .items {
    flex: 0 0 auto;
    min-width: 30%;
    max-width: 80%;
    width: 80%;
}

.catalog-service-content__items {
	display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    grid-column-gap: 16px;
    grid-row-gap: 30px;
}
.catalog-service-content__item0 {
	display: flex;
    flex-direction: column;
}

#map {
    min-width: 20%;
    width: 20%;
    max-width: 70%;
    flex: 1 1 auto;
    margin-left:50px;
    background: #fff;
	box-shadow:0 0 10px rgba(0,0,0,0.2);
    height: 1500px;
    position: relative;
}
.active-map {
	position:relative !important;
	right:0 !important;
}

#map .cursor-zone {
    cursor: col-resize;
	height:inherit;
	position:absolute;
	left:0;
	top:0;
	width:80px;
	z-index:2222;
}

.catalog-service-content__item .btn {
    margin-bottom: 10px;
}

@media(max-width:768px) {
	.catalog_grid_with_map .items {
		max-width: 100%;
		width: 100%;
	}
}

#map .map_content {
    display: inline-block;
    width: 100%;
    height: 100%;
}
#map .map_content iframe {
    display: inline-block;
    width: 100%;
    height: 100%;
}

@media(max-width:768px) {
#show_hide_filter {
    font-size: 12px;
    display: block;
    width: 100%;
    margin-top: 10px;
    margin-bottom: 15px;
}
    
}
</style>

<?php
$script01 = <<< JS
/*
$('#map .cursor-zone').click(function() {
	var data_act = $(this).attr('data-act');
	if (data_act == '0') {
		$('#map').addClass('active-map col-lg-12 col-md-12');
		$(this).attr('data-act','1');
		$('.catalog-service-content__item0').hide();
	}
	if (data_act == '1') {
		$('#map').removeClass('active-map col-lg-12 col-md-12');
		$(this).attr('data-act','0');
		$('.catalog-service-content__item0').fadeIn();
	}
});
*/

$('#show_hide_filter').click(function() {
	var data_show = $('.catalog-service-filter').attr('data-show');
	
	if (data_show == '1') {
		$('.catalog-service-filter').hide();
		$('.catalog-service-filter').attr('data-show','0');
		$(this).text('Показать фильтр');
		$(this).addClass('btn-primary');
	}
	if (data_show == '0') {
		$('.catalog-service-filter').fadeIn();
		$('.catalog-service-filter').attr('data-show','1');
		$(this).text('Скрыть фильтр');
		$(this).removeClass('btn-primary');
	}
});


	$(document).ready(function() {
		setTimeout(function() {
			$('#spinningSquaresG2').remove();
			$('#map .map_content').append('<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A63dd8166274f62688b6ba9ed946e506eeb4fc7ccdbf33242ceb519e39982a763&amp;source=constructor" class="animate__animated animate__fadeInRight" frameborder="0"></iframe>');
		},2000);
		setTimeout(function() {
			startGenItems();
			$('#spinningSquaresG').remove();
		},4000);
	});
	
	function startGenItems() {
		var item = $('.catalog-service-content__items .catalog-service-content__item0');
		var parent_block = $('.catalog-service-content__items');
		for (var ii=0;ii<12;ii++) {
			//var time_delay = ii/2;
			//time_delay = 'animate__delay-'+time_delay+'s';
			item.clone().appendTo(parent_block);
		}
	}
	
    $(".catalog_grid_with_map > .items").resizable({
        handleSelector: "#map .cursor-zone",
        resizeHeight: false,
        onDragEnd: function(e, eel, opt) {
            console.log(e);
            console.log(eel);
            console.log(opt);

        }
    });
	
JS;
$this->registerJs($script01, yii\web\View::POS_READY);
?>