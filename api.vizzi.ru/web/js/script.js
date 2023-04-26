$('.dynamic_content_btns li').click(function() {
var datacnt = $(this).attr('data-content');
if (datacnt) {
event.preventDefault();
$('.dynamic_content_btns li').removeClass('active');
$(this).addClass('active');

$('.dynamic_content div').hide();
$('.dynamic_content div[data-show='+datacnt+']').show();
}
else {
event.preventDefault();	
}
});

$('.carou_btns span.prev').click(function() {
event.preventDefault();
carouUpdate('prev');
});

$('.carou_btns span.next').click(function() {
event.preventDefault();
carouUpdate('next');
});

function carouUpdate(type) {
var count_all = parseInt($('.carou_content div').length);
var actual_cnt = parseInt($('.carou_content').attr('data-actual'));
var actual_class = 'fadeIn';
var aclass1 = 'fadeInLeft';
var aclass2 = 'fadeInRight';
var new_cnt = 0;

if (type === "next") {
new_cnt = actual_cnt + 1;
$('.carou_btns span.prev').removeClass('text-muted');
if (new_cnt >= count_all) {
$('.carou_btns span.next').addClass('text-muted');	
new_cnt = count_all;
}
actual_class = aclass2;
}

if (type === "prev") {
new_cnt = actual_cnt - 1;
$('.carou_btns span.next').removeClass('text-muted');
if (new_cnt <= 1) {
$('.carou_btns span.prev').addClass('text-muted');
new_cnt = 1;	
}
actual_class = aclass1;	
}

console.log(new_cnt);
$('.carou_content').attr('data-actual',new_cnt);
$('.carou_content div').hide();
$('.carou_content div').removeClass(aclass1);
$('.carou_content div').removeClass(aclass2);
$('.carou_content div[data-show='+new_cnt+']').addClass(actual_class);
$('.carou_content div[data-show='+new_cnt+']').show();	
}



/**
 *
 */
let hexToRgba = function(hex, opacity) {
  let result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  let rgb = result ? {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16)
  } : null;

  return 'rgba(' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ', ' + opacity + ')';
};

/**
 *
 */
$(document).ready(function() {
  /** Constant div card */
  const DIV_CARD = 'div.card';

  /** Initialize tooltips */
  $('[data-toggle="tooltip"]').tooltip();

  /** Initialize popovers */
  $('[data-toggle="popover"]').popover({
    html: true
  });

  /** Function for remove card */
  $('[data-toggle="card-remove"]').on('click', function(e) {
    let $card = $(this).closest(DIV_CARD);

    $card.remove();

    e.preventDefault();
    return false;
  });

  /** Function for collapse card */
  $('[data-toggle="card-collapse"]').on('click', function(e) {
    let $card = $(this).closest(DIV_CARD);

    $card.toggleClass('card-collapsed');

    e.preventDefault();
    return false;
  });

  /** Function for fullscreen card */
  $('[data-toggle="card-fullscreen"]').on('click', function(e) {
    let $card = $(this).closest(DIV_CARD);

    $card.toggleClass('card-fullscreen').removeClass('card-collapsed');

    e.preventDefault();
    return false;
  });

  /**  */
  if ($('[data-sparkline]').length) {
    let generateSparkline = function($elem, data, params) {
      $elem.sparkline(data, {
        type: $elem.attr('data-sparkline-type'),
        height: '100%',
        barColor: params.color,
        lineColor: params.color,
        fillColor: 'transparent',
        spotColor: params.color,
        spotRadius: 0,
        lineWidth: 2,
        highlightColor: hexToRgba(params.color, .6),
        highlightLineColor: '#666',
        defaultPixelsPerValue: 5
      });
    };

    require(['sparkline'], function() {
      $('[data-sparkline]').each(function() {
        let $chart = $(this);

        generateSparkline($chart, JSON.parse($chart.attr('data-sparkline')), {
          color: $chart.attr('data-sparkline-color')
        });
      });
    });
  }

  /**  */
  if ($('.chart-circle').length) {
    require(['circle-progress'], function() {
      $('.chart-circle').each(function() {
        let $this = $(this);

        $this.circleProgress({
          fill: {
            color: tabler.colors[$this.attr('data-color')] || tabler.colors.blue
          },
          size: $this.height(),
          startAngle: -Math.PI / 4 * 2,
          emptyFill: '#F4F4F4',
          lineCap: 'round'
        });
      });
    });
  }
});


function tooltipStart() {
$('body').tooltip({
    selector: '[data-toggle="tooltip"]'
});	
}


$(document).ready(function() {

  $('body').on('click', '.card-options-fullscreen', function(e) {
	var thisparent = $(this).parent().parent().parent();
	thisparent.toggleClass('fullscreen-card');
		
    e.preventDefault();
    return false;		
  });
  
});

$('.audio').click(function(e) {
	e.preventDefault();
	return false;
});


$('#age').keypress(function(e) {
      e = e || event;

      if (e.ctrlKey || e.altKey || e.metaKey) return;

      var chr = getChar(e);

      if (chr == null) return;

      if (chr < '0' || chr > '9') {
        return false;
      }
});

$('#age').change(function() {
	var thisval = $(this).val();
	if (thisval <= 0 && thisval != '') {
		$(this).val(12);
		return false;
	}
	if (thisval > 100 && thisval != '') {
		$(this).val(100);
		return false;
	}	
});
$('#age').keyup(function() {
	var thisval = $(this).val();
	if (thisval <= 0 && thisval != '') {
		$(this).val(12);
		return false;
	}
	if (thisval > 100 && thisval != '') {
		$(this).val(100);
		return false;
	}
});

    function getChar(event) {
      if (event.which == null) {
        if (event.keyCode < 32) return null;
        return String.fromCharCode(event.keyCode);
      }

      if (event.which != 0 && event.charCode != 0) {
        if (event.which < 32) return null;
        return String.fromCharCode(event.which);
      }

      return null;
    }
	

function getRandomInRange(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

$(document).ready(function() {
	var bgrand = getRandomInRange(0, 2);
	var gobg = 'bg-youtube';
	
	switch (bgrand) {
		case 0: gobg = 'bg-youtube'; break;
		case 1: gobg = 'bg-instagram'; break;
		case 2: gobg = 'bg-vk'; break;
	}
	$('.pace-progress').addClass(gobg);
	
});


$(function() {
  $(document.body).on('appear', '.after-stars-bg', function(e, $affected) {
    $(this).removeClass("visible-off");
  });
  $('.after-stars-bg').appear({force_process: true});

  $(document.body).on('appear', '.after-bg-instagram', function(e, $affected) {
    $(this).removeClass("visible-off");
  });
  $('.after-bg-instagram').appear({force_process: true});
});