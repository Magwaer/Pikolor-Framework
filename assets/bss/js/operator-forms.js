//Remove this in production
EJS.config({cache: false});

var operatorForm = {
	setAppointmentDate: function(date)
	{
		$('#appointment-date').val(moment(date).format('YYYY-MM-DD'));
	},

	setAppointmentDuration: function(duration)
	{
		$('#appointment-duration').val(duration);
	},

	schedulerSetCurrentDate: function() {
		var curr_date = $('#scheduler-date').val();
		if (!curr_date)
		{
			var date = moment().format('YYYY-MM-DD');
		}
		else
			var date = curr_date;
		$('#scheduler-date').val(date);
		operatorForm.setAppointmentDate(date);
	},

	reloadScheduler: function() {
		var isExpanded = $('#get-scheduler').hasClass('collapse');
		if (isExpanded) {
			var date = $('#appointment-date').val();
			var listId = $('#list-id').val();
			var campaignId = $('#campaign-id').val();
			operatorForm.getScheduler(date, listId, campaignId);
		} else {
			$('#get-scheduler').click();
		}
	},

	getScheduler: function(date, listId, campaignId) {
		var reload = $('#scheduler-portlet').attr('data-reload');

		if (reload == 1) {
			Metronic.blockUI({
				target: '#scheduler',
				animate: true,
	            overlayColor: 'none'
			});

			$.ajax({
				url: '/operator-form/get-appointments',
				method: 'POST',
				data: {date: date, listId: listId, campaignId: campaignId}
			})
			.done(function(res) {
				$('#scheduler-portlet').attr('data-reload', 0);
				var data = JSON.parse(res);

				var html = new EJS({url: 'assets/bss/ejs_templates/scheduler.ejs'}).render(data);
				$('#scheduler').html(html);

				Metronic.unblockUI('#scheduler');
			});
		}
	},

	resetAppointmentTime: function() {
		$('#appointment-hour').val('');
		$('#appointment-minutes').val('');
		$('#appointment-agent').val('');
	},

	selectAppointmentSlot: function(el) {
		var takenAppointments = $(el).attr('data-taken-appointments') * 1;
		var maxAppointments = $(el).attr('data-max-appointments') * 1;
		var totalTakenAppointments = $(el).attr('data-total-taken-appointments') * 1;
		var appointmentsTarget = $(el).attr('data-appointments-target') * 1;
		var appointmentsOverbooking = $(el).attr('data-overbooking') * 1;
		var appointmentDuration = $(el).attr('data-app-duration') * 1;

		operatorForm.setAppointmentDuration(appointmentDuration);

		if (totalTakenAppointments < (appointmentsTarget + appointmentsOverbooking)) {
			//if (operatorForm.verifyAppConditions(el) === true) {
				$('.appointment-slot').not('.idle').each(function(key, el) {
					$(el).removeClass('selected');

					var takenAppointments = $(el).attr('data-taken-appointments') * 1;
					var maxAppointments = $(el).attr('data-max-appointments') * 1;
					$(el).children('.appointments').text(takenAppointments + '/' + maxAppointments);
				});


				$(el).addClass('selected');
				$(el).children('.appointments').text((takenAppointments + 1) + '/' + maxAppointments);

				var appointmentHour = $(el).attr('data-hour');
				var appointmentMinutes = $(el).attr('data-minutes');
				var appointmentAgent = $(el).attr('data-agent');
				$('#appointment-hour').val(appointmentHour);
				$('#appointment-minutes').val(appointmentMinutes);
				$('#appointment-agent').val(appointmentAgent);
			//} else {
			//	toastr['warning']($.i18n._("The appointment can't be scheduled at this time"), $.i18n._('Warning'));
			//}
		} else {
			toastr['warning']($.i18n._('The appointments target for this day was reached.'), $.i18n._('Warning'));
		}
	},

	resetAppointmentSlot: function() {
		$('.appointment-slot').not('.idle').each(function(key, el) {
			$(el).removeClass('selected');

			var takenAppointments = $(el).attr('data-taken-appointments') * 1;
			var maxAppointments = $(el).attr('data-max-appointments') * 1;
			$(el).children('.appointments').text(takenAppointments + '/' + maxAppointments);

			operatorForm.resetAppointmentTime();
		});
	},

	verifyAppConditions: function(el) {
		var distMinFromCall = $(el).attr('data-min-dist-from-call') * 60,
			distMaxFromCall = $(el).attr('data-max-dist-from-call') * 60,
			appointmentDate = $('#appointment-date').val(),
			appointmentHour = $(el).attr('data-hour'),
			appointmentMinutes = $(el).attr('data-minutes'),
			appDatetimeUnix = moment(appointmentDate + ' ' + appointmentHour + ':' + appointmentMinutes).unix();

		var epoch =moment(new Date() , 'x');
		console.log(epoch + distMinFromCall )

		if (distMinFromCall == 0 && distMaxFromCall == 0) {
			return true;
		} else {
			if (epoch + distMinFromCall >= appDatetimeUnix || epoch + distMaxFromCall <= appDatetimeUnix) {
				return false;
			} else {
				return true;
			}
		}
	},

	initScheduler: function() {
		$(document).on('click', '#get-scheduler', function(e) {
			var date = $('#appointment-date').val();
			var listId = $('#list-id').val();
			var campaignId = $('#campaign-id').val();
			operatorForm.getScheduler(date, listId, campaignId);
		});

		$(document).on('click', '.appointment-slot.free', function(e) {
			operatorForm.selectAppointmentSlot(this);
			return false;
		});
		$(document).on('click', '.appointment-reset', function(e) {
			operatorForm.resetAppointmentSlot();
		});
	},

	initDateOfBirthDatePicker: function() {
		if (jQuery().datepicker) {
		    $('#date-of-birth').datepicker({
		        orientation: "left",
		        autoclose: true,
		        format: "yyyy-mm-dd",
		        todayBtn: true
		    });
		}
	},
	initCallbackDatePicker: function() {
		if (jQuery().datepicker) {
		    $('#callback_date').datepicker({
		        orientation: "left",
		        autoclose: true,
		        format: "yyyy-mm-dd",
		        todayBtn: true
		    });
		}
		$('.timepicker').timepicker();
		$(".bs-select").selectpicker();
	},

	initSchedulerDatePicker: function() {
		if (jQuery().datepicker) {
			var schedulerDatePicker = $('#scheduler-date').datepicker({
			    orientation: "left",
			    opens: 'left',
			    autoclose: true,
			    format: "yyyy-mm-dd",
			    todayBtn: true,
			    todayHighlight: true
			})
			.on('changeDate', function(e) {
				$('#scheduler-portlet').attr('data-reload', 1);
				operatorForm.setAppointmentDate(e.date);
				operatorForm.resetAppointmentTime();
				operatorForm.reloadScheduler();
			});

			$(document).on('click', '.change-scheduler-date', function() {
				var dateDirection = $(this).attr('data-direction');
				var date = $('#scheduler-date').val();

				if (dateDirection === 'previous') {
					date = moment(date).subtract(1, 'd').format('YYYY-MM-DD');
				} else if (dateDirection === 'next') {
					date = moment(date).add(1, 'd').format('YYYY-MM-DD');
				}

				schedulerDatePicker.datepicker('update', date);
				$('#scheduler-portlet').attr('data-reload', 1);
				operatorForm.setAppointmentDate(date);
				operatorForm.resetAppointmentTime();
				operatorForm.reloadScheduler();
			});
		}
	},

	initDatePickers: function() {
		operatorForm.initDateOfBirthDatePicker();
		operatorForm.initSchedulerDatePicker();
		operatorForm.initCallbackDatePicker();		
	},
	
	initShortcuts: function() {
		$(document).on( "click" , ".shortcut" , function(){
			var status = $(this).attr("data-status");
			if (status == "CALLBK")
			{
				if (!$("#callback_portlet .portlet-body").is(":visible"))
				{
					$("#callback_portlet .portlet-body").removeClass("display-hide").show();
					$("#callback_portlet .portlet-title .tools a").attr("class" , "collapse");
					$('html, body').animate({
						scrollTop: $("#callback_portlet").offset().top
					}, 200);
				}
				return false;
			}
			if (status == "SALE")
			{
				var agent = $("#appointment-agent").val();
				if (!agent)
				{
					if ($("#scheduler-portlet .expand").length)
					{
						$("#scheduler-portlet .expand").trigger("click");
						$('html, body').animate({
							scrollTop: $("#scheduler-portlet").offset().top
						}, 200);
					}
					else
						toastr['warning']($.i18n._("Please select an appointment time cell"), $.i18n._('Warning'));
				}
				else
					operatorForm.setStatus("SALE");
				return false;
			}
			operatorForm.setStatus(status);
			return false;
		})	
		
		// Set callback Status
		$(document).on("click" , "#add_callback" , function(){
			operatorForm.setStatus("CALLBK");
		})	
	},
	
	setStatus: function(status){
		$("#call-status").val(status);
		var url = self.location.href;
		var form_data = $("#call_form").serialize();
		
		Metronic.blockUI({
			target: '#call_form',
			boxed: true
		});
		
		$.post(url , form_data , function(){
			Metronic.unblockUI('#call_form');
			operatorForm.nextCall();
		})
	},
	
	nextCall: function(){
		pm({
			target: window.parent,
			type: "nextCall",
			data:{nextCall:"1"},
			success: function(data) {

			}
		});
	},
	
	sendStartLog: function(){
		var form_data = $("#call_form").serialize();
		$.post("/index.php/bss_operator_form/start_history" , form_data ,function(data){
			$("#log_id").val(data.id)
		}, "json")
	},
	
	initHistory: function(){
		$(document).on('click', '#get-history', function(e) {
			var lead_id = $('#lead_id').val();
			var log_id = $('#log_id').val();
			operatorForm.getHistory(lead_id , log_id);
		});
	},
	
	getHistory: function(lead_id , log_id) {
		var reload = $('#history-portlet').attr('data-reload');

		if (reload == 1) {
			Metronic.blockUI({
				target: '#history',
				animate: true,
	            overlayColor: 'none'
			});

			$.ajax({
				url: '/index.php/bss_operator_form/get_history',
				method: 'POST',
				data: {lead_id : lead_id , log_id : log_id}
			})
			.done(function(res) {
				$('#history-portlet').attr('data-reload', 0);
				var data = JSON.parse(res);

				var html = new EJS({url: 'assets/bss/ejs_templates/history.ejs'}).render(data);
				$('#history').html(html);

				Metronic.unblockUI('#history');
			});
		}
	},
}

$(function() {
	operatorForm.schedulerSetCurrentDate();
	operatorForm.initDatePickers();
	operatorForm.initScheduler();
	operatorForm.initShortcuts();
	operatorForm.sendStartLog();
	operatorForm.initHistory();
});