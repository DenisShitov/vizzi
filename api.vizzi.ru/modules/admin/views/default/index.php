<?php
$this->title = 'Администрирование';

include(Yii::getAlias('@app/modules/admin/views/_parts/fadmin.php'));
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb20">
<h1>Администрирование</h1>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt20 admin-panels">

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<div class="panel panel-default">
<div class="panel-header">
<h3 class="panel-title">Лагеря</h3>
</div>
<div class="panel-body">
Добавление и редактирование лагерей.<br/><br/>
</div>
<div class="panel-footer">
<a href="/admin/objects/" class="btn btn-primary btn-block fff">Перейти</a>
</div>
</div>
</div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<div class="panel panel-default">
<div class="panel-header">
<h3 class="panel-title">Заявки</h3>
</div>
<div class="panel-body">
Заявки менеджера.<br/><br/>
</div>
<div class="panel-footer">
<a href="/admin/claims/" class="btn btn-primary btn-block fff">Перейти</a>  <!--/admin/default/requests/-->
</div>
</div>
</div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<div class="panel panel-default">
<div class="panel-header">
<h3 class="panel-title">Отзывы</h3>
</div>
<div class="panel-body">
Отзывы от пользователей.<br/><br/>
</div>
<div class="panel-footer">
<a href="/admin/reviews/" class="btn btn-block btn-primary fff">Перейти</a> 
</div>
</div>
</div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<div class="panel panel-default">
<div class="panel-header">
<h3 class="panel-title">Пользователи</h3>
</div>
<div class="panel-body">
Информация о пользователях.<br/><br/>
</div>
<div class="panel-footer">
<a href="/admin/users/" class="btn btn-primary btn-block fff">Перейти</a> 
</div>
</div>
</div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<div class="panel panel-default">
<div class="panel-header">
<h3 class="panel-title">Отчеты</h3>
</div>
<div class="panel-body">
Формирование и выгрузка отчета по продажам.<br/><br/>
</div>
<div class="panel-footer">
<a href="#" class="btn btn-primary btn-block fff">Перейти</a> 
</div>
</div>
</div>


</div>

</div>
</div>




<style>
.panel {
    margin-bottom: 30px;
}

.panel-header {
	padding:15px;
	border-bottom:1px solid #ccc;
}

.admin-panels .btn {
	min-width:49%;
}
.admin-panels .btn-inline {
	min-width:auto;
}
.admin-panels .panel-body {
	min-height:120px;
}
</style>