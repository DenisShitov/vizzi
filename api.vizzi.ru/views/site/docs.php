<?php
$this->title = 'Docs';
?>

	<link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@4.5.0/swagger-ui.css" />
  <div id="swagger-ui"></div>
  <script src="https://unpkg.com/swagger-ui-dist@4.5.0/swagger-ui-bundle.js" crossorigin></script>
  <script src="https://unpkg.com/swagger-ui-dist@4.5.0/swagger-ui-standalone-preset.js" crossorigin></script>
  <script src="/web/assets0/jquery.js" crossorigin></script>
  <script>
  window.onload = () => {
    window.ui = SwaggerUIBundle({
      url: 'https://www.api.vizzi.ru/openapi.json',
      dom_id: '#swagger-ui',
    });
  };
  
  
  var arr_updates = [['05.08.2022','обновлен функционал и обновлены модели'],['02.08.2022','добавлены фильтры для отзывов'],['01.08.2022','добавлена модель Reviews + метод reviews'],['29.07.2022','добавлена модель ChildData + метод childs'],['28.07.2022','реализована регистрация пользователя по API + обновлен функционал'],['28.07.2022','обновлен метод и модель User'],['27.07.2022','обновлен метод User'],['26.07.2022','добавлена модель и метод User'],['26.07.2022','обновлен метод Camps + обновление функционала'],['25.07.2022','рефакторинг'],['21.07.2022','расширен функционал API'],['20.07.2022','обновлен метод Camps (добавлены дополнительные поля)'],['19.07.2022','обновлен функционал фильтров'],['18.07.2022','обновлен метод Campsfiles + обновлен функционал'],['15.07.2022','добавлен модель и метод Campsfiles']];
  $(document).ready(function() {
	setTimeout(function() {
		setUpdateInfo();
	},500);
  });
  function setUpdateInfo() {
	$('.information-container .description').html('<div id="updates_block_new"><b>Последние обновления:</b><br/><ul></ul></div>');
	arr_updates.forEach((item, index, array) => {
		$('#updates_block_new ul').append('<li>'+item[1]+' <i>'+item[0]+'</i></li>');
	});
  }
  </script>
  
  <style>
	#updates_block_new ul {
		height:60px;
		overflow:auto;
	}
	#updates_block_new i {
		color:#aba6a6;
		font-style:normal;
	}
  </style>