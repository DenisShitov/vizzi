<?php
use app\models\User;
use app\models\Camps;

$model_title = '';
if ($model->uid != '') { $user_get = User::find()->where(['id'=>$model->uid])->one(); $model_title = '<a href="/admin/users/view?id='.$model->uid.'" target="_blank">'.$user_get->name.'</a>'; } else { $model_title = $model->fio_client; }

$actual_camp_cnt = '';
if ($model->camp_id != '') {
	$actual_camp_count = Camps::find()->where(['id'=>$model->camp_id])->count();
	if ($actual_camp_count > 0) { $actual_camp_get = Camps::find()->where(['id'=>$model->camp_id])->one(); $actual_camp_cnt = '<a href="/admin/objects/view?id='.$actual_camp_get->id.'" target="_blank">'.$actual_camp_get->c_name.'</a>'; }
} else {
	$actual_camp_cnt = $model->camp_name;
}


$actual_season = '-';
//0 - любой, 1 - весна, 2 - зима, 3 - лето, 4 - осень
switch ($model->season) {
	case 0: $actual_season = 'любой'; break;
	case 1: $actual_season = 'весна'; break;
	case 2: $actual_season = 'зима'; break;
	case 3: $actual_season = 'лето'; break;
	case 4: $actual_season = 'осень'; break;
}
/*
$actual_count_seats = '';
switch ($model->count_seats) {
	case 1: $actual_count_seats = '1 местный'; break;
	case 2: $actual_count_seats = '2х местный'; break;
	case 3: $actual_count_seats = '3х местный'; break;
	case 4: $actual_count_seats = '4х местный'; break;
} */

$actual_claim_status = 'открыта';
if ($model->claim_status == 1) { $actual_claim_status = 'закрыта'; }

$actual_pay_status = 'не оплачен';
if ($model->pay_status == 1) { $actual_pay_status = 'оплачен'; }

$type_client_enter = 0;
$type_camp_enter = 0;

		if ($model->fio_client != '') { 
			$type_client_enter = 0;
		} else {
			$type_client_enter = 1;
		}
		
		// пишем новый лагерь или id лагеря
		if ($model->camp_name != '') { 
			$type_camp_enter = 0;
		} else {
			$type_camp_enter = 1;
		}
?>

<div class="panel panel-default claim-block" id="claim_block<?php echo $model->id; ?>">
	<div class="panel-header">
		<h4 class="panel-title">Заявка №<?php echo $model->id; ?></h4>
	</div>
	<div class="panel-body">
		<table class="table claim-table">
			<thead>
				<tr>
					<td>Дата создания</td>
					<td>Клиент</td>
					<td>Лагерь</td>
					<td>Бюджет</td>
					<td>Сезон</td>
					<td>Кол-во мест</td>
					<td>Статус заявки</td>
					<td>Статус оплаты</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $model->date_create; ?></td>
					<td><?php echo '<span class="client-view-info">'.$model_title.'</span>'; ?></td>
					<td><?php echo '<span class="camp-view-info">'.$actual_camp_cnt.'</span>'; ?></td>
					<td><?php echo '<span class="cost-view-info">'.$model->cost.'</span>'; ?></td>
					<td><?php echo '<span class="season-view-info">'.$actual_season.'</span>'; ?></td>
					<td><?php echo '<span class="count-view-info">'.$model->count_seats.'</span>'; ?></td>
					<td><?php echo '<span class="claim-status-view-info">'.$actual_claim_status.'</span>'; ?></td>
					<td><?php echo '<span class="pay-status-view-info">'.$actual_pay_status.'</span>'; ?></td>
				</tr>
			</tbody>
		</table>
<?php /*
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:0;">
			<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
				<p><?php echo '<span class="text-info">Дата создания:</span> '.$model->date_create; ?></p>
				<p><?php echo '<span class="text-info">Клиент:</span> <span class="client-view-info">'.$model_title.'</span>'; ?></p>
				<p><?php echo '<span class="text-info">Лагерь:</span> <span class="camp-view-info">'.$actual_camp_cnt.'</span>'; ?></p>
			</div>
			<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
				<p><?php echo '<span class="text-info">Бюджет:</span> <span class="cost-view-info">'.$model->cost.'</span>'; ?></p>
				<p><?php echo '<span class="text-info">Сезон:</span> <span class="season-view-info">'.$actual_season.'</span>'; ?></p>
				<p><?php echo '<span class="text-info">Кол-во мест:</span> <span class="count-view-info">'.$model->count_seats.'</span>'; ?></p>
			</div>
			<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
				<p><?php echo '<span class="text-danger">Статус заявки:</span> <span class="claim-status-view-info">'.$actual_claim_status.'</span>'; ?></p>
				<p><?php echo '<span class="text-danger">Статус оплаты:</span> <span class="pay-status-view-info">'.$actual_pay_status.'</span>'; ?></p>
			</div>
		</div> */ ?>
	</div>
	<div class="panel-footer">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><?php echo '<span class="update-view-info text-success" title="Последнее обновление">'.$model->date_update.'</span>'; ?></div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right"><button class="btn btn-default btn-update-base" type="button" data-toggle="modal" data-target="#modal_update_claim<?php echo $model->id; ?>" data-id="<?php echo $model->id; ?>">Просмотр / редактирование</button></div>
	</div>
</div>



<div class="modal fade" id="modal_update_claim<?php echo $model->id; ?>" data-id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content module-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-left">Редактировать заявку №<?php echo $model->id; ?></h4>
      </div>
		<div class="modal-footer" style="text-align: left !important;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Тип клиента <a href="#" data-html="true" data-container="body" data-toggle="tooltip" data-placement="right" data-original-title="<b class='text-info'>Из БД</b> - заявка будет связана с пользователем который зарегистрирован. <br/><br/><b class='text-info'>Новый</b> - заявка не связана с пользователем из БД, вся информация о новом клиенте хранится только в текущей заявке (доп.информацию можно указать в комментарий).">?</a></label>
						<select data-block="#client_block<?php echo $model->id; ?>" data-id="type_client" data-val="<?php echo $type_client_enter; ?>" class="form-control sel-control-show">
							<option value="0">Новый</option>
							<option value="1">Из БД</option>
						</select>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form" id="client_block<?php echo $model->id; ?>">
						<label>Клиент </label>
						<select data-id="uid" data-val="<?php echo $model->uid; ?>" class="form-control start-hide" data-block-item="1">
						</select>
						<input type="text" value="<?php echo $model->fio_client; ?>" class="form-control" data-id="fio_client" placeholder="ФИО" data-block-item="0" />
					</div>
					
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Тип лагеря <a href="#" data-html="true" data-container="body" data-toggle="tooltip" data-placement="right" data-original-title="<b class='text-info'>Из БД</b> - заявка будет связана с лагерем который внесен в базу данных. <br/><br/><b class='text-info'>Новый</b> - заявка не связана с лагерем из БД, вся информация о новом лагере хранится только в текущей заявке (доп.информацию можно указать в комментарий).">?</a></label>
						<select data-block="#camp_block<?php echo $model->id; ?>" data-id="type_camp" data-val="<?php echo $type_camp_enter; ?>" class="form-control sel-control-show">
							<option value="0">Новый</option>
							<option value="1">Из БД</option>
						</select>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form" id="camp_block<?php echo $model->id; ?>">
						<label>Лагерь </label>
						<div data-block-item="1" class="start-hide">
						<select data-id="camp_id" data-val="<?php echo $model->camp_id; ?>" class="form-control">
						</select>
						</div>
						<input type="text" class="form-control" value="<?php echo $model->camp_name; ?>" data-id="camp_name" placeholder="Название лагеря" data-block-item="0" />
					</div>
					
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Кол-во мест</label>
						<input type="number" class="form-control" value="<?php echo $model->count_seats; ?>" data-id="count_seats" />
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Бюджет</label>
						<input type="text" class="form-control" value="<?php echo $model->cost; ?>" data-id="cost" />
					</div>		
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Размещение</label>
						<select data-id="accommodation" data-val="<?php echo $model->accommodation; ?>" class="form-control">
							<option value="1">1 местный</option>
							<option value="2">2х местный</option>
							<option value="3">3х местный</option>
							<option value="4">4х местный</option>
						</select>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Сезон</label>
						<select data-id="season" data-val="<?php echo $model->season; ?>" class="form-control">
							<option value="3">Лето</option>
							<option value="2">Зима</option>
							<option value="1">Весна</option>
							<option value="4">Осень</option>
							<option value="0">Любой</option>
						</select>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Питание</label>
						<select data-id="nutrition" data-val="<?php echo $model->nutrition; ?>" class="form-control">
							<option value="1">Завтрак</option>
							<option value="2">Полупансион</option>
							<option value="3">Полный пансион</option>
							<option value="0">Полное</option>
						</select>
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Описание / комментарий</label>
						<textarea class="form-control" data-id="comment" rows="4"><?php echo $model->comment; ?></textarea>
					</div>
					
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Статус заявки</label>
						<select data-id="claim_status" data-val="<?php echo $model->claim_status; ?>" class="form-control">
							<option value="0">Открыта</option>
							<option value="1">Закрыта</option>
						</select>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 r-form">
						<label>Статус оплаты</label>
						<select data-id="pay_status" data-val="<?php echo $model->pay_status; ?>" class="form-control">
							<option value="0">Не оплачено</option>
							<option value="1">Оплачено</option>
						</select>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 r-form p0">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pr0">
						<button class="btn btn-success btn-update-claim" data-parent="#modal_update_claim<?php echo $model->id; ?>" data-id="<?php echo $model->id; ?>" type="button">Обновить</button>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pl0 text-right">
						<button class="btn btn-danger btn-remove-claim" data-parent="#modal_update_claim<?php echo $model->id; ?>" data-id="<?php echo $model->id; ?>" type="button">Удалить</button>
					</div>
					</div>
				</div>
		</div>
    </div>
  </div>
</div>