	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-content__item animate__animated animate__fadeInLeft animate__delay-2s">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-content__item_pic" style="background:url('/img/test_jk.png') no-repeat;"><a href="#"><img src="/img/icons/white_heart.png" /></a></div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-content__item_txt">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<strong><?php echo $model->c_name; ?></strong>
			<span><img src="/img/icons/geo_green.png" /> <?php echo $model->c_city; ?>, <?php echo $model->c_district; ?></span> 
			<strong>от <?php echo $model->c_price; ?> р.</strong> 
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<b><u>Строений:</u> <?php echo $model->c_count_builds; ?></b>  
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<a href="/catalog/complex/view/<?php echo $model->id; ?>" class="btn btn-primary">Подробнее</a>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
			<button class="btn btn-primary alt" type="button">Сравнить</button> 
		</div>
		</div>
	</div>