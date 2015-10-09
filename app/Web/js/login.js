
var loginPage = {
	
	doLogin: function()
	{
		var form_data = $("#login_form").serialize();
		$.post("/login" , form_data , function(data){
			if (data.wrong)
			{
				toastr.error(data.wrong);
				return;
			}
			if (data.login)
				window.location = "/";
			if (data.register)
			{
				$("#register_modal").modal("show");
				$("#reg_phone_number").val($("#phone_number").val())
				$("#reg_password").val($("#password").val())
			}
		} , "json")
	},
	
	doRegister: function()
	{
		var form_data = $("#register_form").serialize();
		$.post("/login" , form_data , function(data){
			if (data.wrong)
			{
				toastr.error(data.wrong);
				return;
			}
			if (data.login)
				window.location = "/";
		} , "json")
	}
}




$(function() {
	// campaign list
	$(document).on("submit" , "#login_form" , function(){
		loginPage.doLogin();
		return false;
	})
	$(document).on("submit" , "#register_form" , function(){
		loginPage.doRegister();
		return false;
	})
	$(document).on("click" , "#register_but" , function(){
		loginPage.doRegister();
		return false;
	})
})