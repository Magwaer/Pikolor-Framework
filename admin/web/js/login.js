toastr.options.timeOut = 1000

$(document).on("submit", "#login_form", function(){
	var obj = $(this);
	$.post(obj.attr("action"), obj.serialize(), function(data){
		if(data.error)
			toastr.error(data.error)
		else
			window.location = data.location;
	}, "json")
	
	return false;
})

$(document).ready(function() {     
	$("input[type=checkbox],input[type=radio]").iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green'
	});
});