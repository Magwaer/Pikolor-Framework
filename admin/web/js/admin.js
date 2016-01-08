var Admin = {
	global : {},
	
	init : function(){
		this.init_lang_switcher();
		this.init_checkbox();
		this.init_select();
		this.init_menu();
		this.init_ajax_forms();
		this.init_custom_fields();
		
		$('body').on('hidden.bs.modal', '.modal', function () {
			$(this).removeData('bs.modal');
		});
	},
	
	init_lang_switcher : function(){
		$(document).on("change" , "#lang_switcher", function(){
			var v = $(this).val();
			$("*[role=lang][data-lang!='" + v + "']").hide();
			$("*[role=lang][data-lang='" + v + "']").show();
		})
		$("#lang_switcher").trigger("change");
	},
	
	init_checkbox : function(){
		$("input[type=checkbox],input[type=radio]").iCheck({
			checkboxClass: 'icheckbox_flat-green',
			radioClass: 'iradio_flat-green'
		});
	},
	
	init_select : function(){
		$('.bs-select ').selectpicker();
	},
	
	init_menu : function(){
		$(document).on("click" , ".nav_menu li", function(){
			$(".nav_menu li.active").not($(this)).removeClass("active").find(".arr").removeClass("fa-caret-up").addClass("fa-caret-down");
			if ($(this).find(".sub-menu"))
			{
				if ($(this).hasClass("active"))
				{
					$(this).removeClass("active");
					$(this).find(".arr").removeClass("fa-caret-up").addClass("fa-caret-down");
				}
				else
				{
					$(this).addClass("active");
					$(this).find(".arr").addClass("fa-caret-up").removeClass("fa-caret-down");
				}
			}
		})
	},
	
	init_ajax_forms : function(){
		$(document).on("submit" , ".ajax_form", function(){
			var adr = $(this).attr("action");
			var callback = $(this).attr("data-callback");
			
			$.post(adr, $(this).serialize(), function(data){
				if (data.error)
					toastr.error(data.error)
				else
				{
					eval(callback);
					if (data.success)
						toastr.success(data.success);
					if (data.location)
						window.location = data.location;
				}
			},'json')
			return false;
		})
	},
	
	hide_modal: function(size)
	{
		if (size == "long")
			$('#ajax_modal_long').modal('hide')
		else
			$('#ajax_modal').modal('hide')
	},
	
	init_custom_fields : function()
	{
		$(document).on("change" , "#custom_field_type", function(){
			var v = $(this).val();
			$(".field_options[data-type!='" + v + "']").hide();
			$(".field_options[data-type='" + v + "']").show();
		})
		$("#custom_field_type").trigger("change");
	}
}	

$(document).ready(function(){
	Admin.init();
})