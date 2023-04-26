<div class="panel panel-default">
	<div class="panel-header">
	<h4 class="panel-title"><?php echo $model->req_date; ?></h4>
	</div>
	<div class="panel-body">
		<p>Имя: <?php echo $model->r_name; ?></p>
		<p>Телефон: <?php echo $model->r_phone; ?></p>
		<p>Email: <?php if ($model->r_email == '') { echo '-'; } else { echo $model->r_email; } ?></p>
	</div>
</div>