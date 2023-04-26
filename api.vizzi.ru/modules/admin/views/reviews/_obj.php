<?php
use app\models\User;
use app\models\Camps;

$moderate_css = '';
if ($model->r_moderate == 1) { $moderate_css = '<span class="text-success review-status" title="Прошел модерацию">&bull;</span>'; } else { $moderate_css = '<span class="text-danger review-status" title="Не промодерирован">&bull;</span>'; }

$model_title = '';
if ($model->uid != '') { $user_get = User::find()->where(['id'=>$model->uid])->one(); $model_title = $user_get->name; } else { $model_title = $model->r_user_name; }

$actual_camp_cnt = '';
$actual_camp_count = Camps::find()->where(['id'=>$model->r_camp_id])->count();
if ($actual_camp_count > 0) { $actual_camp_get = Camps::find()->where(['id'=>$model->r_camp_id])->one(); $actual_camp_cnt = '<a href="/admin/objects/view?id='.$actual_camp_get->id.'" target="_blank">'.$actual_camp_get->c_name.'</a>'; }
?>

<div class="panel panel-default review-block" id="review_block<?php echo $model->id; ?>">
	<div class="panel-header">
		<h4 class="panel-title"><?php echo $model_title.' '.$moderate_css; ?></h4>
	</div>
	<div class="panel-body">
		<?php echo $model->r_text; ?>
	</div>
	<div class="panel-footer">
		<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 review-block-camp"><div class="marquee"><?php echo $actual_camp_cnt; ?></div></div>
		<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 pr0"><button class="btn btn-default fl-right btn-moderate-base" type="button" data-id="<?php echo $model->id; ?>" data-moderate="<?php echo $model->r_moderate; ?>">Модерация</button> </div>
	</div>
</div>
