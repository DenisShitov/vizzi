<?php
include(Yii::getAlias('@app/modules/admin/views/_parts/c_iso_arr.php'));
$c_iso = '';

$c_desc = strip_tags($model->c_desc);
?>

<div class="panel panel-default">
	<div class="panel-header">
	<h4 class="panel-title"><?php echo $model->c_name; ?></h4>
	</div>
	<div class="panel-body">
		<p><?php echo $c_desc; ?></p>
	</div>
	<div class="panel-footer">
		<span><?php echo $c_iso; ?></span> <a class="btn btn-default fl-right" href="/admin/objects/view?id=<?php echo $model->id; ?>">Редактировать</a>
	</div>
</div>