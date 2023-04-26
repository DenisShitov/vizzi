<?php
$script0 = <<< JS

$('#block_head').remove();

$(document).ready(function() {
	setTimeout(function() {
		$('#spinningSquaresG').fadeOut();
	}, 1000);
	setTimeout(function() {
		$('.container').css('opacity','1');
	}, 1500);
});

$(document).ready(function() {
	memoryTab();
});

$(document).ready(function() {
	selectDataVal();
});

function selectDataVal() {
	$(function(){
		$('select[data-val]').each(function (index, element) {
			$('option',$(element)).removeAttr('selected');
			var this_val = $(element).attr('data-val');
			$('option[value="'+this_val+'"]',$(element)).attr('selected','selected');
		});
	});	
}

$('.nav-tabs:not(.notsaving) li a').click(function() {
	var this_mt = $(this).attr('aria-controls');
	localStorage.setItem('mtab',this_mt);
});

	function memoryTab() {
		var mtab = localStorage.getItem('mtab');
		
		if($('#'+mtab).length > 0) {
			$('.nav-tabs li a[aria-controls="'+mtab+'"]').tab('show');
		}

	}

JS;
$this->registerJs($script0, yii\web\View::POS_READY);
?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<div id="spinningSquaresG"><div class="lds-ripple"><div></div><div></div></div></div>

<style>
.container {
	opacity:0;
}

#spinningSquaresG {
    position: fixed !important;
    left: 0;
	top:20px;
    right: 0;
	text-align: center;
}

.lds-ripple {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ripple div {
  position: absolute;
  border: 4px solid #222;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 0;
  }
  4.9% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 0;
  }
  5% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: 0px;
    left: 0px;
    width: 72px;
    height: 72px;
    opacity: 0;
  }
}


.panel-header {
	padding:15px;
	border-bottom:1px solid #ccc;
}
.panel-footer {
	min-height:55px;
}

.chosen-single {
	background: #fff !important;
    height: 34px !important;
    padding: 4px 12px !important;
    border-color: #ccc !important;
    box-shadow: none !important;
}
.chosen-container-single .chosen-single div b {
	background-position: 0 7px !important;
}


body {
	background: #f3f3f3;
}

.admin-block {
	min-height:500px;
}
</style>