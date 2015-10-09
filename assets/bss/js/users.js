
var table = $('#mainTable');

table.dataTable({
	"sDom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
});


function outbandCalls(){

	$('#agent-outbound-thistime').show();
	dateTo = $('#dateTo').val();
	dateFrom = $('#dateFrom').val();
	user = $('#userId').val();

	$.post(
		'/index.php/go_user_ce/outboundThisTime',
		{dateTo:dateTo,user:user,dateFrom:dateFrom},
		function(data){

			$(' #agent-outbound-thistime tbody').delay(1000).empty().append(data); 
			$accum = $('#agent-outbound-thistime tbody').children().size();
			
		}
		);

};


function inboundCalls(){
	dateTo = $('#dateTo').val();
	dateFrom = $('#dateFrom').val();
	user = $('#userId').val();

	$('#agent-inbound-thistime').show();

	$.post(
		'/index.php/go_user_ce/inboundThisTime',
		{dateTo:dateTo,user:user,dateFrom:dateFrom},
		function(data){
			$('#agent-inbound-thistime tbody').delay(2000).empty().append(data); 
			$accum = $('#agent-inbound-thistime tbody').children().size();
			
		}
		);

}
function agentActivity(){

	dateTo = $('#dateTo').val();
	dateFrom = $('#dateFrom').val();
	user = $('#userId').val();

	$('#agent-activity-thistime').show();
	$.post(
		'/index.php/go_user_ce/agentActivity',
		{dateTo:dateTo,user:user,dateFrom:dateFrom},
		function(data){
			$('#agent-activity-thistime tbody').delay(2000).empty().append(data); 
			$accum = $('agent-activity-thistime tbody').children().size();
		}
		);


}
function records(){

	dateTo = $('#dateTo').val();
	dateFrom = $('#dateFrom').val();
	user = $('#userId').val();

	$('#agent-recording-thistime').show();

	$.post(
		'/index.php/go_user_ce/recordingThisTime',
		{dateTo:dateTo,user:user,dateFrom:dateFrom},
		function(data){
			$('#agent-recording-thistime tbody').delay(2000).empty().append(data);

			$accum = $('#agent-recording-thistime tbody').children().size();
		}
		);

}
function leadSearch(){

	dateTo = $('#dateTo').val();
	dateFrom = $('#dateFrom').val();
	user = $('#userId').val();

	$('#agent-leadsearch-thistime').show();

	$.post(
		'/index.php/go_user_ce/leadsearchThisTime',
		{dateTo:dateTo,user:user,dateFrom:dateFrom},
		function(data){
			$('#agent-leadsearch-thistime tbody').delay(2000).empty();
			$.each($.makeArray($(data)),function(){
				if($(this).is("td")){
					$.each($.makeArray($(this).children("td")),function(){
						if($(this).hasClass('elipsis')){
							var $elipsisValue = $(this).text();
							$(this).empty();
							$(this).text($elipsisValue.substring(0,40)+"...");
						}
					});
					$('#agent-leadsearch-thistime tbody').append($(this)); 
					$('#agent-leadsearch-thistime tbody').append("<br class='spacer'/>"); 
				}
			});
			$accum = $('#agent-leadsearch-thistime tbody').children().size();
			
		}
		);

}


function manualOutband(){

	dateTo = $('#dateTo').val();
	dateFrom = $('#dateFrom').val();
	user = $('#userId').val();


	$('#agent-manualoutbound-thistime').show();

	$.post(
		'/index.php/go_user_ce/manualoutboundThisTime',
		{dateTo:dateTo,user:user,dateFrom:dateFrom},
		function(data){
			$('#agent-manualoutbound-thistime tbody').delay(2000).empty().append(data); 
			$accum = $('#agent-manualoutbound-thistime tbody').children().size();
			
		}
		);


}

function logout() {
	$('#emergency').click(function(){ 
           // magic begins here first things first the user
           var $user = $('#userId').val();
           $.post(
           	'/index.php/go_user_ce/emergencylogout',
           	{user:$user},
           	function(data){
           		alert(data);
           		if(data.indexOf('complete') !== -1){
           			location.reload();
           		}
           	}
           	); 
       });
	
}
function leadinfo(leadelem){

	$.post(
		'/index.php/go_search_ce/leadinfo',
		{leadid:leadelem},
		function(data){

			if(data.indexOf("Error") === -1){
				var $result  = JSON.parse(data);
				$(".lead_id").empty().append($result[0].lead_id);
				$(".list_id").empty().append($result[0].list_id);
				$(".address1").empty().append(($result[0].address1 === "")?'&nbsp;': $result[0].address1);
				$(".phone_code").empty().append(($result[0].phone_code === "")?'&nbsp;': $result[0].phone_code);
				$(".phone_number").empty().append(($result[0].phone_number === "")?'&nbsp;': $result[0].phone_number);
				$(".city").empty().append(($result[0].city === "")?'&nbsp;': $result[0].city);
				$(".state").empty().append(($result[0].state === "")?'&nbsp;': $result[0].state);
				$(".postal_code").empty().append(($result[0].postal_code === "")?'&nbsp;': $result[0].postal_code);
				$(".comment").empty().append(($result[0].comment === "") ? '&nbsp;' : $result[0].comment);
				$(".overlay-leadinfo").fadeIn();
				$(".leadinfo").animate({top:60});
			} else {
				alert("Error: No Lead info!");
			}

		}
		);

}

function optionCheck(){
	var list = document.getElementsByClassName("collapse");
	for (var i = 0; i < list.length; i++) {
		list[i].style.display="none";
	}
	var e = document.getElementById("generate_phone");
	var select = e.options[e.selectedIndex].getAttribute('data-target');
	document.getElementById(select).style.display = "block";
}

function next(){
	$.post(
		'/go_user_ce/userwizard',
		{
			accountNum:$('#accountNum').val(),
			hidcount:$('#hidcount').val(),
			txtSeats:$('#txtSeats').val(),
			skip:$('#txtSeats').val(),
			generate_phone:$('#generate_phone').val(),
			start_phone_exten:$('#start_phone_exten').val()
		},
		function(data){
			var result = JSON.parse(data);
			var layout = result.display;

			$('.userCreate').html(layout.content.right);
		});	
}


function digitsOnly(event) {

	if( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
		// Allow: Ctrl+A
		(event.keyCode == 65 && event.ctrlKey === true) || 
				// Allow: Ctrl+X
				(event.keyCode == 88 && event.ctrlKey === true) || 
				// Allow: Ctrl+C
				(event.keyCode == 67 && event.ctrlKey === true) || 
				// Allow: Ctrl+V
				(event.keyCode == 86 && event.ctrlKey === true) || 
				// Allow: Ctrl+Z
				(event.keyCode == 90 && event.ctrlKey === true) || 
				// Allow: Ctrl+Y
				(event.keyCode == 89 && event.ctrlKey === true) || 
				// Allow: home, end, left, right
				(event.keyCode >= 35 && event.keyCode <= 39)) {
				// let it happen, don't do anything
			return true;
		}else{
			if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
				event.preventDefault(); 
			}
		}
	}

	function checkPhoneIfExist() {
		var phoneExten = $('.start_phone_exten').val();
		var seat = $('.txtSeats option:selected').val();
		$.post(
			'/go_user_ce/checkphone',
			{phone: phoneExten, seat: seat},
			function(data){
				// console.log(data);
				$('.eloading').html(data);
			});
	}


	$(document).ready(function (){
		var currentDate = new Date();  

		$('.datepicker-container').live('click', function(event) {
			/* Act on the event */
			$("#dateFrom").datepicker({dateFormat: 'yy-mm-dd'});
			$("#dateTo").datepicker({dateFormat: 'yy-mm-dd'});
		});





	});
