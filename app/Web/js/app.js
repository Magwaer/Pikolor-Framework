var app = {
	
	my_id : 0,
	socketIp : '2rent.cargos.eu:443',
	
	initApp: function()
	{
		
		console.log("app is init " + app.my_id);
		
		var socket = io.connect('http://' + app.socketIp, {secure: false});
			 
		socket.on('connect', function (success) {  
			
			console.log(app.my_id + " connected");     
			
			socket.once('disconnect', function() {   
				console.log(app.my_id + " disconnected");   
				socket.disconnect();
				
				//var r = confirm("{/literal}{#nodejs_server_disconnect#}{literal}");         
				//window.location.href = "index.php?action=logout";	
			}); 
						
			socket.emit('set_id', { id: app.my_id }, function(success) {
				console.log(app.my_id + " set as nickname");  
				
				if(!success) {
					console.log(app.my_id + "is already use!")
				}   
			});
			
			socket.on('in_msg', function(data) {    
				toastr.success(data.msg);
				
				socket.emit('read_msg', { id: data.id }, function(success) {
					console.log(data.id + " is read");  
					
				});
			});
				 
		});  
	}
	
}

jQuery(document).ready(function() {
	
})