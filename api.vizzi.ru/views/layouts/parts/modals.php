<div class="modal fade" id="request_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content module-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-left" id="request_modal_title">Получить консультацию</h4>
      </div>
      <div class="modal-body">
		<input type="text" placeholder="Ваше имя" class="form-control" /><br/>
		<input type="text" placeholder="Ваш телефон" class="form-control" /><br/>
		<button class="btn btn-success" type="button">Отправить заявку</button>
		
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>


<?php
$script01 = <<< JS

$(document).ready(function() {
$('button[data-target="#request_modal"]').click(function() {
	var this_title = $(this).attr('data-title');
	if (this_title && this_title != '') {
		$('#request_modal_title').text(this_title);
	}
});
});

$(document).ready(function() {
$('.nav-tabs-anchors li a').click(function(){
	let anchor = $(this).attr('href');
	$('html, body').animate({
		scrollTop:  $(anchor).offset().top
	}, 600);
});
});

$('.main-filter .select-button .dropdown-menu li').click(function(e) {
	e.preventDefault();
	var this_text = $(this).text();
	var this_val = $(this).attr('data-val');
	var this_par = $(this).parent().parent();
	
	$('button[data-toggle="dropdown"]',this_par).attr('data-val',this_val);
	$('button[data-toggle="dropdown"] u',this_par).text(this_text);
});


$('.jacore-link').click(function(){
	let anchor = $(this).attr('data-target');
	$('html, body').animate({
		scrollTop:  $(anchor).offset().top
	}, 600);
});


JS;
$this->registerJs($script01, yii\web\View::POS_READY);
?>


<style>
.search-filter {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

@media(max-width:768px) {
.search-filter {
    flex-wrap: wrap;
}
.main-filter .btn-group {
    border-bottom: 1px solid #ccc;
}

}

.main-filter .btn-group {

}
.main-filter .btn-group .btn {
	border:1px solid #ccc  !important;
	outline:none;
	border-radius:10px;
}

.main-filter .btn-group.fin input {
    border-radius:0;
	outline:none;
	border-left:1px solid #ccc;
}
.main-filter input {
	border:0;
}
</style>