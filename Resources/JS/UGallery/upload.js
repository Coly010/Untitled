/**
 * Created by Colum on 16/02/2017.
 */


var form_upload = "";
var form_upload_interval = null;

function startUpload(formName){

    $("#upload_progress").show();
    $(".upload_complete_text").addClass("hidden");

    form_upload = formName;

    form_upload_interval = setInterval(getProgressUpdate, 500);

}

function getProgressUpdate(){
    $.get("/upload/progress/"+form_upload, function(data){
        var progress = JSON.parse(data);

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
            }
        }

    });
}