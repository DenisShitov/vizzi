var polls = "photo_id, verified, sex, bdate, city, country, home_town, has_photo, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, domain, has_mobile, contacts, site, education, universities, schools, status, last_seen, followers_count, common_count, occupation, nickname, relatives, relation, personal, connections, exports, activities, interests, music, movies, tv, books, games, about, quotes, can_post, can_see_all_posts, can_see_audio, can_write_private_message, can_send_friend_request, is_favorite, is_hidden_from_feed, timezone, screen_name, maiden_name, crop_photo, is_friend, friend_status, career, military, blacklisted, blacklisted_by_me";

$(document).ready(function() {
GoTop();	
});	

VK.init({
    apiId: 6688201
});

$("#go_top_enter").click(function() {
GoTop();
});	


/* --- поиск по странам и городам --- */

// QjSearch(поле ввода,блок фильтра), без учета регистра

$("#country_search_input").keyup(function() {
QjSearch(this,"#modal_country .content .checkbox");	
});	

function QjSearch(q_tval, q_block) {
var tval = $(q_tval).val();

$(q_block).hide();

$.expr[":"].Contains = $.expr.createPseudo(function(arg) {
    return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});

$(q_block+':Contains("'+tval+'")').show();
}

/* --- /поиск по странам и городам --- */

function GoTop() {
var s_country = $("#modal_country .checkbox input:checked").val();	
var s_app_count_result = $("#app_count_result").val();	
	
VK.Api.call('users.search', {country: s_country, count:s_app_count_result, fields: polls, v:"5.73"}, function(r) {

  if(r.response) {
  var rr = r.response;
  
  var count = rr.count;
  var items = rr.items;
  
	$(".results .items tbody").html("");
  
  $.each(items, function( key, value ) {

// Последняя активность 
  if(value.last_seen) {
  var last_seen = value.last_seen.time; // последняя активность время
  }
  else {
  var last_seen = "-";
  }	  
  
  var a = new Date(last_seen * 1000);
  var months = ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  var hour = a.getHours();
  var min = a.getMinutes();
  var sec = a.getSeconds();
  var ls_time = date + ' ' + month + ' ' + year + ', ' + hour + ':' + min;
  
  
	var sex = value.sex;
	if (sex == 1) {
	sex = "женский";	
	}	
	else if (sex == 2) {
	sex = "мужской";	
	}	
	else {
	sex = "-";	
	}	
	
	if (value.followers_count != undefined) {
	var s_followers_count = value.followers_count; //.replace(/(\d)(?=(\d{3})+(\D|$))/g, '$1 ');
	}	
	else {
	var s_followers_count = "-";
	}	
	
	
  if (value.facebook) {
  var facebook = '<a href="https://facebook.com/'+value.facebook+'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
  }
  else {
  var facebook = '';
  }	
  if (value.twitter) {
  var twitter = '<a href="https://twitter.com/'+value.twitter+'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
  }
  else {
  var twitter = '';
  }
  if (value.instagram) {
  var instagram = '<a href="https://instagram.com/'+value.instagram+'" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>';
  }
  else {
  var instagram = '';
  }  

  if (value.mobile_phone) {
  var mobile_phone = '<i class="fa fa-mobile" aria-hidden="true"></i> '+value.mobile_phone;
  }
  else {
  var mobile_phone = "";
  }
  
  if (value.home_phone) {
  var home_phone = '<i class="fa fa-phone" aria-hidden="true"></i> '+value.home_phone;
  }
  else {
  var home_phone = "";
  }  
		
	var num = key + 1;	
	
	$(".results .items tbody").append('<tr id="user_id_'+value.id+'"><td>'+num+'</td><td><a href="https://vk.com/im?sel='+value.id+'" target="_blank"><i class="fa fa-envelope-o" aria-hidden="true"></i></a> <a href="https://vk.com/id'+value.id+'" target="_blank">'+value.id+'</a></td><td>'+value.first_name+'</td><td>'+value.last_name+'</td><td class="poll">'+sex+'</td><td class="count_friends"></td><td>'+s_followers_count+'</td><td>'+ls_time+'</td><td>'+instagram+' '+facebook+' '+twitter+'</td><td>'+mobile_phone+'<br>'+home_phone+'</td></tr>');
	
	GetFriends(value.id,"#user_id_"+value.id+" .count_friends");

  });
  
  
  }
  else {
	alert("Не удается выполнить запрос");  
  }  

}); 
}

/* --- отображение друзей пользователя --- */

function GetFriends(quser_id,tab_user_id) {
VK.Api.call('friends.get', {user_id: quser_id,fields:polls, v:"5.73"}, function(r) {
	
$(tab_user_id).text("");	
if(r.response) {
	var rr = r.response;
	var fri_count = rr.count;
	$(".loader").fadeIn();	
	if (fri_count == "") {
	$(tab_user_id).text("-");   
	}
	else {
	$(tab_user_id).text(fri_count);  
	}  
}
else {
  $(tab_user_id).text("-");	
}

$(".loader").fadeOut();	
 
}); 
}

/* --- /отображение друзей пользователя --- */

$("#app_country").click(function() {
$("#modal_country").modal("show");	
});

$("#modal_country .checkbox").click(function() {
var modalist = $("#modal_country .checkbox input:checked");
var descer = $(".start_content #parse_nickname");

var name = modalist.parent().text();
descer.val(name);
console.log(name);
});