	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-content__item animate__animated animate__fadeInLeft animate__delay-2s">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-content__item_pic" style="background:url('<?php echo $model->obj_pic1; ?>') no-repeat;"><a href="#"><img src="/img/icons/white_heart.png" /></a></div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog-service-content__item_txt">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<strong><?php echo $model->obj_title; ?></strong>
			<span><img src="/img/icons/geo_green.png" /> <?php echo $model->obj_address; ?></span> 
			<strong><?php echo $model->obj_cost; ?> р.</strong> 
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<span>Срок сдачи</span> 
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
			<span><?php echo $model->obj_arenda_start; ?></span> <br/><br/>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<a href="/catalog/default/view/<?php echo $model->id; ?>" class="btn btn-primary">Подробнее</a>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
			<button class="btn btn-primary alt" type="button">Сравнить</button> 
		</div>
		</div>
	</div>