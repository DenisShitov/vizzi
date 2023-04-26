<?php
use app\modules\favorites\models\Favorites;
//use app\modules\blogers\models\BlogersCart;

$this->title = 'Избранное';
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->user->identity) {
$user_id = Yii::$app->user->identity->id;
$keyq = Yii::$app->user->identity->keyq;
}

$count_fav = Favorites::find()->where(['uid'=>$user_id])->count();

if ($count_fav > 0) {
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fav_blocks">
<div class="container">
<h2>Избранное</h2>
<p class="text-primary curhelp"><i class="fe fe-alert-triangle"></i>&nbsp;&nbsp;Здесь отображаются сохраненные Вами блогеры и материалы. Доступно для добавления 100 блогеров/материалов.</p>

<?php
$fav_flds = Favorites::find()->orderBy('id DESC')->all();
foreach ($fav_flds as $fld):
$id = $fld->id;
$type = $fld->type;
$fid = $fld->fid;

/*
if ($type == 1) {
$fcnt_count = BlogersCart::find()->where(['id'=>$fid])->count();

if ($fcnt_count > 0) {
$fcnt = BlogersCart::find()->where(['id'=>$fid])->one();

switch ($fcnt->net) {
case 1: $icon_net = 'fa fa-youtube'; $net_text = 'Youtube'; break;
case 2: $icon_net = 'fa fa-instagram'; $net_text = 'Instagram'; break;
case 3: $icon_net = 'fa fa-vk'; $net_text = 'ВКонтакте'; break;
}


switch ($fcnt->city) {
case 1: $text_city = 'Москва'; break;
case 2: $text_city = 'Санкт-Петербург'; break;
case 74: $text_city = 'Челябинск'; break;
}

if ($fcnt->rating < 10) {
	$text_rating = '<span><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i></span>';
} else if ($fcnt->rating >= 10) {
	$text_rating = '<span><i class="fe fe-star text-primary"></i><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i></span>';
} else if ($fcnt->rating >= 50) {
	$text_rating = '<span><i class="fe fe-star text-primary"></i><i class="fe fe-star text-primary"></i><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i></span>';
} else if ($fcnt->rating >= 100) {
	$text_rating = '<span><i class="fe fe-star text-primary"></i><i class="fe fe-star text-primary"></i><i class="fe fe-star text-primary"></i><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i></span>';
} else if ($fcnt->rating >= 500) {
	$text_rating = '<span><i class="fe fe-star text-primary"></i><i class="fe fe-star text-primary"></i><i class="fe fe-star text-primary"></i><i class="fe fe-star text-primary"></i><i class="fe fe-star text-muted"></i></span>';
} else if ($fcnt->rating >= 1000) {
	$text_rating = '<span><i class="fe fe-star text-primary"></i><i class="fe fe-star text-primary"></i><i class="fe fe-star text-primary"></i><i class="fe fe-star text-primary"></i><i class="fe fe-star text-primary"></i></span>';
} else {
	$text_rating = '<span><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i><i class="fe fe-star text-muted"></i></span>';
}


if ($fcnt->age < 20) {
$text_age = $fcnt->age.' лет';
}
else if ($fcnt->age >= 22 && $fcnt->age < 25 || $fcnt->age >= 32 && $fcnt->age < 35 || $fcnt->age >= 42 && $fcnt->age < 45 || $fcnt->age >= 52 && $fcnt->age < 55 || $fcnt->age >= 62 && $fcnt->age < 65 || $fcnt->age >= 72 && $fcnt->age < 75 || $fcnt->age >= 82 && $fcnt->age < 85 || $fcnt->age >= 92 && $fcnt->age < 95) {
	$text_age = $fcnt->age.' года';
}
else if ($fcnt->age >= 25 && $fcnt->age <= 30 || $fcnt->age >= 35 && $fcnt->age <= 40 || $fcnt->age >= 45 && $fcnt->age <= 50 || $fcnt->age >= 55 && $fcnt->age <= 60 || $fcnt->age >= 65 && $fcnt->age <= 70 || $fcnt->age >= 75 && $fcnt->age <= 80 || $fcnt->age >= 85 && $fcnt->age <= 90) {
	$text_age = $fcnt->age.' лет';
}

else {
	$text_age = $fcnt->age.' год';
}
?>


<div class="col-lg-6 animated fadeIn" id="fav_<?php echo $id; ?>">
                <div class="card card-aside">
                  <a href="/blogers/default/profile/<?php echo $fcnt->id; ?>" class="card-aside-column" style="background-image: url(<?php echo $fcnt->net_ava; ?>)"></a>
                  <div class="card-body d-flex flex-column">
                    <h4><i class="<?php echo $icon_net; ?>" title="<?php echo $net_text; ?>" aria-hidden="true"></i> <a href="/blogers/default/profile/<?php echo $fcnt->id; ?>"><?php if($fcnt->name != '') { echo $fcnt->name; } else { echo $fcnt->net_id; } ?></a></h4>
                    <div class="text-muted"><?php echo $text_city; ?>, <?php echo $text_age; ?></div>
                    <div class="d-flex align-items-center pt-5 mt-auto">
                      <div class="user-info">
                        <span data-toggle="tooltip" data-original-title="Подписчики"><i class="fe fe-user"></i> <b><?php echo $fcnt->net_subs; ?></b></span> 
						<span class="pl15" data-toggle="tooltip" data-original-title="Качество аккаунта"><?php echo $text_rating; ?></span>
                      </div>
                      <div class="ml-auto text-muted">
                        <a href="javascript:void(0)" data-content="<?php echo $id; ?>" data-main="fav_<?php echo $id; ?>" title="Удалить" class="icon d-none d-md-inline-block ml-3 favremove"><i class="fe fe-x mr-1"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
</div>

<?php
$csrfq = Yii::$app->request->getCsrfToken();
$script = <<< JS
$('.favremove').click(function() {
var btnthis = $(this);
var mainblock = $(this).attr('data-main');
var fid = $(this).attr('data-content');
//$('.loading').fadeIn();
  $.ajax({
       url: '/favorites/default/removefav',
       type: 'post',
       data: {
                 id: fid,
                 key: '$keyq',
                 _csrf : '$csrfq'
       },
       success: function (data) {
		   //$('.loading').hide();
			if (data == "Success") {
				$('#'+mainblock).remove();
				var favblocks = $('.fav_blocks .container div').length;
				if (favblocks < 1) {
				$('.fav_blocks .container').append('<p class="animated fadeIn">Ваш список избранного пуст</p>');
				}	
			}
			else {
				btnthis.addClass('text-danger');
				btnthis.attr('data-original-title','Ошибка при удалении');
				btnthis.attr('disabled','disabled');
			}
       },
	   error: function() {
		   $('.loading').hide();
		   console.log('Error');
	   }
  });

});
JS;
$this->registerJs($script, yii\web\View::POS_READY);

?>


<?php
}
else {
	echo '';	
}

}
*/
// /if_bloger

endforeach;

echo '</div></div>';
}
else {
echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">
<h2>Избранное</h2>
<p>Ваш список избранного пуст</p>
</div></div>';
}
?>