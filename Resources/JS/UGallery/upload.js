/**
 * Created by Colum on 16/02/2017.
 */


var form_upload = "";
var form_upload_interval = null;

function startUpload(formName){

    if($("#"+formName).val() == ""){
        $("#upload_progress").show();
        $(".upload_complete_text").addClass("hidden");

        form_upload = formName;

        form_upload_interval = setInterval(getProgressUpdate, 500);
    }

}

function getProgressUpdate(){
    $.get("/upload/progress/"+form_upload, function(data){
        var progress = JSON.parse(data);
        console.log(progress);

        if(progress.error){
            $(".upload_complete_text").text("Error, upload aborted: "+progress.error_msg);
            $(".upload_complete_text").removeClass("hidden");
            $(".upload_complete_text").removeClass("text-success");
            $(".upload_complete_text").addClass("text-danger");
            $("#upload_iframe").attr('src', 'about:blank');

            clearInterval(form_upload_interval);
        } else {
            $("#upload_progress_bar").width(progress.progress+"%");
            $("#upload_progress_bar").attr("aria-valuenow", progress.progress);
            $(".upload_progress_text").text(progress.progress+"%");

            if(progress.done){
                clearInterval(form_upload_interval);
                $(".upload_complete_text").removeClass("hidden");

                if(progress.image){
                    progress.files.forEach(function(file, index) {
                        $(".thumbnail-holder").append("<img src='"+file+"' width='120' class='img-thumbnail' />");
                    });
                }

                $("#upload_file_input").val("");
                $("#addToAlbum_Check").attr("checked", false);

            }
        }

    });
}

function toggleAlbumChoice(){
    $("#chooseAlbumUpload").slideToggle();
}

document.addEventListener("DOMContentLoaded", function(event) {
    $(".selectable-item").click(function () {
        var itemId = $(this).attr("data-media-id");
        var option = $(".select_item_"+itemId);
        if(option.is(":selected")){
            option.removeAttr("selected");
            $(this).find(".selectable").removeClass("selectable-selected");
        } else {
            option.attr("selected", "selected");
            $(this).find(".selectable").addClass("selectable-selected");
        }

    });
});