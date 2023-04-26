<?php
switch ($model->active) {
	case 0: $activity_class = 'text-warning'; $activity = 'Не активен'; break;
	case 1: $activity_class = 'text-success'; $activity = 'Активен'; break;
	case 2: $activity_class = 'text-danger'; $activity = 'Заблокирован'; break;
}

if ($model->email_confirm == 1) {
	$email_confirm = '<i class="fe fe-mail text-success" data-toggle="tooltip" data-original-title="Email подтвержден"></i>';
} else {
	$email_confirm = '<i class="fe fe-mail text-danger" data-toggle="tooltip" data-original-title="Email не подтвержден"></i>';
}
?>
<div class="panel panel-default" id="user<?php echo $model->id; ?>">
	<div class="panel-body">
		<h4 class="panel-title"><span class=""><?php echo $model->name; ?></span> <span class="text-primary email-block"><?php echo $model->email; ?></span></h4>
	</div>
	<div class="panel-footer">
		<a class="btn btn-default btn-sm" href="/admin/users/view?id=<?php echo $model->id; ?>">Подробнее / модерация</a> 
	</div>
</div>