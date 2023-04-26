$(document).ready(function() {
$("#search_user_block").hide();
});

$("#upload_users").click(function() {
JsonInfo();
});

$(".menu button").click(function() {
$(this).addClass("btn-active");
$(".menu button").not(this).removeClass("btn-active");
});

$("#info_user").click(function() {
$("#search_user_block").hide();
$(".table-block2").addClass("hide");
$(".table-block").show();
$("#info_user_block").fadeIn();
});

$("#search_user").click(function() {
$("#info_user_block").hide();
$(".table-block2").removeClass("hide");
$(".table-block").hide();
$("#search_user_block").fadeIn();
});


$("#parse_submit").click(function() {
if ($("#parse_nickname").val() == "") {
alert("Заполните поле");
}
else {
GetUser();  
$(".filters button").removeClass("btn-active");
$(".filters").removeClass("hide");
}
});

// https://www.googleapis.com/youtube/v3/search?key=AIzaSyBnjX961LAW0djgNZ8d7LJHkUNI1vGZ484&part=id,snippet&publishedAfter=2014-12-09T00:00:00Z&publishedBefore=2014-12-11T00:00:00Z&videoCategoryId=GCSG93LXRvICYgRElZ&type=video&maxResults=50

/* --- выводим json файл --- */
function JsonInfo() {
$("#parse_nickname").val("");
	$.ajax({
    method:"GET", 
	dataType: 'json',
    url:"/web/js/data/youtube_channels.json",
    success:function(response){
	for (i=0;i<response.channels.length;i++) {
	var users_name = response.channels[i].user.name;
	var users_id = response.channels[i].user.id;

	if (users_name == "") {
	AddUserJson(users_id);
	}
	else {
	AddUserJson(users_name);
	}

	}
	console.log("Success! Results: "+response.channels.length);
	},
	error:function() {
	console.log("Error!");	
	}
	});	

function AddUserJson(users_name) {
	var cur_val = $("#parse_nickname").val();
	
	if (cur_val) {
	$('#parse_nickname').val(cur_val + "," + users_name);
	}
	else {
	$('#parse_nickname').val(users_name);	
	}	
}
}
/* --- /выводим json файл --- */


function GetUser() {
var user_name = $("#parse_nickname").val();
$(".content tbody").html("");

var users_names = user_name.split(',');

for (var i=0;i<users_names.length;i++){
	AjaxSuccess(i,users_names);
}
}


function AjaxSuccess(i,users_names) {

	$.ajax({
    method:"GET", 
	dataType: 'json',
    url: "https://www.googleapis.com/youtube/v3/channels?part=statistics,brandingSettings&key=AIzaSyBnjX961LAW0djgNZ8d7LJHkUNI1vGZ484&forUsername="+users_names[i],
    success:function(response){
	if (response.pageInfo.totalResults == 0) {
	poID();
	}
	else {
	AddToTable(response);
	}
    },
	error:function() {
	console.log("Error");
	}
   }); 

function poID() {
	$.ajax({
    method:"GET", 
	dataType: 'json',
    url: "https://www.googleapis.com/youtube/v3/channels?part=statistics,brandingSettings&key=AIzaSyBnjX961LAW0djgNZ8d7LJHkUNI1vGZ484&id="+users_names[i],
    success:function(response){
	AddToTable(response,i);
    }  
   });   
}
   
}

function AddToTable(response,i) {
	var user_id = response.items[0].id;
	var subs0 = response.items[0].statistics.subscriberCount;
	var subs = subs0.replace(/(\d)(?=(\d{3})+(\D|$))/g, '$1 ');
	
	var user_name = response.items[0].brandingSettings.channel.title;
	
	var user_img = response.items[0].brandingSettings.image.bannerMobileLowImageUrl;
	
	var views0 = response.items[0].statistics.viewCount;
	var views = views0.replace(/(\d)(?=(\d{3})+(\D|$))/g, '$1 ');
	
	var video_count0 = response.items[0].statistics.videoCount;	
	var video_count = video_count0.replace(/(\d)(?=(\d{3})+(\D|$))/g, '$1 ');
	
	var content = '<tr class="user_tr" id="user_'+user_id+'" data-fcount="'+subs0+'" data-vcount="'+views0+'" data-vcount2="'+video_count0+'"><td>'+i+'</td><td><a href="https://www.youtube.com/channel/'+user_id+'" target="_blank"><img src="'+user_img+'" style="width:50px;" /> '+user_name+'</a></td><td>'+subs+'</td><td>'+views+'</td><td>'+video_count+'</td></tr>';
	
	$(".table-block .content tbody").append(content);
	numExe();
	
	$(".table-block").removeClass("hide");
}

/*
function AjaxSuccess2() {
   $.ajax({
    method:"GET", 
	dataType: 'json',
	url: "https://www.googleapis.com/youtube/v3/search?part=snippet&q=ShootingStars&key=AIzaSyBnjX961LAW0djgNZ8d7LJHkUNI1vGZ484",
    success:function(response){
	//console.log(response);
	
	var user_id = response.items[0].channelId;
	var user_title = response.items[0].title;
	var user_desc = response.items[0].description;
	
	var content = '<tr><td>'+user_id+'</td><td>'+user_title+'</td><td>'+user_desc+'</td></tr>';
	
	$(".table-block2 .content tbody").append(content);
	
	$(".table-block2 .content").removeClass("hide");
    }  
   }); 
}
*/


$(".filters button").click(function() {
$(this).addClass("btn-active");
$(".filters button").not(this).removeClass("btn-active");
});

$("#filter_subs").click(function() {
SortResults("data-fcount");
$('.table-block .content tbody tr td').removeClass("active");
$('.table-block .content tbody tr td:nth-child(3)').addClass("active");
});
$("#filter_view").click(function() {
SortResults("data-vcount");
$('.table-block .content tbody tr td').removeClass("active");
$('.table-block .content tbody tr td:nth-child(4)').addClass("active");
});
$("#filter_videos").click(function() {
SortResults("data-vcount2");
$('.table-block .content tbody tr td').removeClass("active");
$('.table-block .content tbody tr td:nth-child(5)').addClass("active");
});

	function SortResults(prm) {
    var elements = $('.table-block .content tbody tr');
    var target = $('.table-block .content tbody');
	
    elements.sort(function (a, b) {
        return parseInt($(a).attr(prm), 10) > parseInt($(b).attr(prm), 10) ? -1: 1;
    }).appendTo(target);

	numExe();
	
	}

function numExe() {
$('.table-block .content tbody tr').each(function(i) {
var number1 = i + 1;
$(this).find('td:first').text(number1+".");
$("#results_db").html("Количество результатов: <b>"+number1+"</b>");
});	
}	
/*
var elements = response.items;

for (var i=0;i<elements.length;i++){
  var post = {};
  var element = elements[i];
  post.user_id = element.id;
  post.subs = element.statistics.subscriberCount;                                               
  console.log(post);
}	
*/