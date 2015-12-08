$(document).ready(function(){
	
	
	$(".lang_switcher").each(function(){
		var obj = $(this);
		obj.find(".lang:gt(0)").hide();
		obj.find(".langs select").on("change" , function(){
			obj.find(".lang[data-lang!='" + $(this).val() + "']").hide();
			obj.find(".lang[data-lang='" + $(this).val() + "']").show();
		})
	})
	
})