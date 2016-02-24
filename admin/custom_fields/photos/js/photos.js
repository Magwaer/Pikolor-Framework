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