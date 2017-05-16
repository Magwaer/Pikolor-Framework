console.log("photos are loaded");


function upload_file(folder , input_id) {
    
    $.ajaxFileUpload({
        url:'/admin/custom_fields/photos/upload.php?folder=' + folder ,
        secureuri:false,
        fileElementId:input_id,
        dataType: 'json',
        success: function (data, status)
        {
            if(typeof(data.error) != 'undefined')
            {
                if(data.error != '')
                {
                    alert(data.error);
                }else
                {
                    var photo = data.photo
                    var l = $("#" + input_id).parent().parent().find(".new_request_image_block").length;


                    var new_photo = "<div class='new_request_image_block' >";
                    new_photo += "<img src='"+photo+"' class='new_request_image_block_image' />";
                    new_photo += "<input name='data["+input_id+"][]' type='hidden' value='" + data.id +"' />";
                    new_photo += "<a href='#' class='new_request_image_delete'";
                    new_photo += "onclick='delete_file("+data.id+" , $(this) , 0 , \""+folder+"\" , \""+input_id+"\"); return false'>delete</a>";
					new_photo += "<br /> <a onclick=\"edit_photo('" + photo + "' , " + data.id + " , $(this))  ; return false\" class=\"new_request_image_delete edit_img\" href=\"#\">Edit</a>";
                    new_photo += "</div>";


                    $("#" + input_id).parent().before(new_photo);

                }
            }
        },
        error: function (data, status, e)
        {
            alert(e);
        }
    })

    return false;

}

function delete_file(photo_id , obj , id , folder , field){
    /*
	if (confirm('Are you sure ?')){
        $.get("/admin/ajax" , {
            "ac" : "del_file" ,
            "id" : photo_id ,
            "folder" : folder,
            "node_id" : id,
            "field" : field
        }, function(data){
     */       obj.parent(".new_request_image_block").remove();
     /*   })
    }*/
}
function edit_photo(path , id,  obj ){
	var x = '<input type="button" onclick="save_img(\'' + path + '\', ' + id +'); return false" value="Save"/>';

	$("#ajax_modal .modal-body").html("<img src='" + path + "?t=" + (new Date).getTime() +"' id='cropping' style='max-width:100%'/>" + x);
	
	$('#ajax_modal').modal();
	$(".modal-dialog").width(700);
	
	setTimeout(function(){
		$('#cropping').cropper({
			aspectRatio: 1 / 1,
			crop: function(e) {
				// Output the result data for cropping image.
				console.log(e.x);
				console.log(e.y);
				console.log(e.width);
				console.log(e.height);
				console.log(e.rotate);
				console.log(e.scaleX);
				console.log(e.scaleY);
			}
		});
		/*$(".ci-image-wrapper").append("<div class='b1'></div>");
		$(".ci-image-wrapper").append("<div class='b2'></div>");
		$(".ci-image-wrapper").append("<div class='b3'></div>");
		$(".ci-image-wrapper").append("<div class='b4'></div>");
		*/
	}, 1000)
	$('.btn-crop').click(function() {
		
	//	$('#preview-image').attr('src', 'script.php?w=' + $('#w').val() + '&h=' + $('#h').val() + '&x=' + $('#x').val() + '&y=' + $('#y').val() + '&ts=' + (new Date).getTime());
	});
}

function save_img(path, id)
{
	var photo_data = $("#cropping").cropper("getData");
	$.post('/admin/custom_fields/photos/resize.php', {"src" : path, "data" : photo_data, "id" : id}, function(data){
		toastr.success('Fotografia a fost salvata');
		data.result;
		
		var img = $(".new_request_image_block img[src='" + path + "']");
		var p = img.parent();
		img.attr("src", data.result + "?t=" + (new Date).getTime());
		p.find(".edit_img").attr("onclick", "edit_photo('" + data.result + "' , $(this))  ; return false");
		$("#ajax_modal").modal("hide");
	}, "json")
}