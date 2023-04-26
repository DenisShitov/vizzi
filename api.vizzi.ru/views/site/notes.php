<?php
use app\models\Notes;
use yii\helpers\Url;
$this->title = "Мои заметки";

$user_id = Yii::$app->user->identity->id;
$user_keyq = Yii::$app->user->identity->keyq;
$date_create = date('Y').'-'.date('m').'-'.date('d');
$thishref = Url::to(['/app/notes/']);

// date, uid, name, text
$date = isset($_GET['date']) ? $_GET['date'] : null;
$uid = isset($_GET['uid']) ? $_GET['uid'] : null;
$key = isset($_GET['key']) ? $_GET['key'] : null;
$theme = isset($_GET['theme']) ? $_GET['theme'] : null;
$text = isset($_GET['text']) ? $_GET['text'] : null;


$script_add_note = <<<JS
 	$('#add_new_note').submit(function(){
 	  var form_new_note = $('#add_new_note').serialize();
	  var thisparent = $('#add_new_note');
	  //$('.loading').fadeIn();
        $.ajax({
          type: 'GET',
          url: '/app/notes',
          data: form_new_note,
          success: function(data) {
			//$('.loading').fadeOut();
			$('div',thisparent).hide();
			thisparent.prepend('<p class="text-success msg-status">Заметка успешно добавлена!</p>');	
			$('.msg-status',thisparent).fadeIn();
			setTimeout(function() {
				$('.msg-status',thisparent).remove();
				$('div',thisparent).fadeIn();
				location.reload();
			}, 3000);
          },
          error: function() {
			thisparent.html('<p class="text-danger">При добавлении заметки возникла ошибка. Попробуйте позже.</p>');
			//$('.loading').fadeOut();
          }
        });
    });

function DB_Ajax() {
	$('.notes').html('');
        $.ajax({
          type: 'GET',
          url: '/app/notes',
          data: {act: 'go_data_notes'},
          success: function(result){
			var ajax_content_1 = result;
			console.log(ajax_content);
			var ajax_content0 = $('.notes', result);
			console.log(ajax_content0);
			var ajax_content = ajax_content0.html();
			console.log(ajax_content);
			$('.notes').html(ajax_content);
          },
          error: function(){
			return false;
          }
});
}

//
//$('.note_delete').click(function() {
$('body').on('click', '.note_delete', function() {
var note_id = $(this).attr('data-note-id');
var this_parent = $(this).parent().parent();
$.ajax({
type: 'POST',
url: '/app/notes',
data: {delete_node: note_id},
success: function(result) {
this_parent.addClass('bg-success').html('<p>Заметка удалена.</p>');
setTimeout(function() {
this_parent.fadeOut();
this_parent.remove();
}, 3000);
},
error: function() {
this_parent.addClass('bg-danger').html('<p>Возникла ошибка при удалении заметки. Попробуйте позже.</p>');
location.reload();
}
});
});
JS;
$this->registerJs($script_add_note, yii\web\View::POS_READY);
?>
<div class="col-lg-12 ol-md-12 col-sm-12 col-xs-12 noteadd_main">
<?
$delete_node = isset($_POST['delete_node']) ? $_POST['delete_node'] : null;

if ($delete_node != '') {
$notedel = Notes::findOne($delete_node);
$notedel->delete();
}

if ($date != '' && $uid == $user_id && $key == $user_keyq && $theme != '' && $text != '') {
Yii::$app->db->createCommand()->insert('notes', [
    'uid' => $uid,
    'theme' => $theme,
	'text' => $text,
	'date' => $date
])->execute();
}

$act = isset($_GET['act']) ? $_GET['act'] : null;
if ($act == "go_data_notes") {
$notes_user = Notes::find()->where(['uid'=>$user_id])->all();
foreach ($notes_user as $note_user):
$theme_enter = $note_user->theme;
$text_enter = $note_user->text;
$date_enter = $note_user->date;
echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 note">
<h3>'.$theme_enter.'</h3>
<span>'.$date_enter.'</span>
<p>'.$text_enter.'</p>
</div>'; 
endforeach;
}
?>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="position:relative;">
<form method="GET" style="position:fixed;width:350px;display:block;" id="add_new_note" action="javascript:void(null);">
<input type="hidden" value="<? echo $user_id; ?>" name="uid" />
<input type="hidden" value="<? echo $date_create; ?>" name="date" />
<input type="hidden" value="<? echo $user_keyq; ?>" name="key" />
<div>
<label>Тема: </label> <input type="text" value="<? echo $date_create; ?>" name="theme" placeholder="Тема заметки" class="form-control" required="" />
<br/><br/>
<label>Заметка: </label> <textarea name="text" placeholder="Текст заметки" class="form-control" required="" rows="4" autofocus=""></textarea>
<div style="text-align:left;padding-top:40px;">
<button class="btn btn-default" type="submit">Добавить заметку</button>
</div>
</div>
</form>
</div>
<?
$notes_user_count = Notes::find()->where(['uid'=>$user_id])->count();
echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 notes">';
if ($notes_user_count > 0) {
$notes_user = Notes::find()->where(['uid'=>$user_id])->all();
foreach ($notes_user as $note_user):
$note_id = $note_user->id;
$theme_enter = $note_user->theme;
$text_enter = $note_user->text;
$date_enter = $note_user->date;

echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 note">
<div style="position:absolute;right:10px;top:10px;font-weight:bold;"><button type="button" class="note_delete" data-note-id="'.$note_id.'" style="background:none;border:none;">x</button></div>
<h3>'.$theme_enter.'</h3>
<span>'.$date_enter.'</span>
<p>'.$text_enter.'</p>
</div>'; 

endforeach;
}
echo '</div>';
?>
</div>
<style>
.note {
	border-radius: 6px;
    background: #f9f9f9;
    padding-left: 15px;
    margin-bottom: 10px;
    border: 1px solid #d0d0d0;
}
.note span {
	color:#969696;
}
</style>