if (typeof jQuery == 'undefined') {
    var script = document.createElement('script');
    script.type = "text/javascript";
    script.src = "//code.jquery.com/jquery-1.11.0.min.js";
    document.getElementsByTagName('head')[0].appendChild(script);
}

var link = document.createElement('link');
link.type = "text/css";
link.rel = "stylesheet";
link.media = "all";
link.href = "/engine/web/css/debugger.css";
document.getElementsByTagName('head')[0].appendChild(link);

setTimeout(function(){
	$.get("/engine/get_debug/" +  debug_id + "/get", function(data){
		$("body").append(data);
	})
} , 1000)