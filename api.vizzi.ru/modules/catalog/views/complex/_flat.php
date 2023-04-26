<div class="panel panel-default">
	<div class="panel-header">
	<h4 class="panel-title"><?php echo $model->flat_count_rooms; ?>-комн. квартира</h4>
	</div>
	<div class="panel-body">
		<div style="height:45px;overflow:auto;"><?php echo $model->flat_info; ?></div>
		<span><u>Площадь:</u> <?php echo $model->flat_square_full; ?> кв.м.</span><br/>
		<span><u>Цена:</u> <?php echo $model->flat_price; ?> руб.</span> <br/>

	</div>
	<div class="panel-footer">
		<button class="btn btn-info btn-block" data-title='Забронировать "<?php echo $model->flat_count_rooms; ?>-комн. квартиру"' data-toggle="modal" data-target="#request_modal" type="button">Забронировать</button>
	</div>
</div>