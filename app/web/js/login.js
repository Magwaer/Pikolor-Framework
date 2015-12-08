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