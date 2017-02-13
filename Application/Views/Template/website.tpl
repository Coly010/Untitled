<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>{{page_name}} - {{application_name}}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="Resources/CSS/uwa.css" rel="stylesheet" type="text/css" />
    <link href="Resources/CSS/UCard.css" rel="stylesheet" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<textarea id="sce-fix" class="hidden"></textarea>

<div class="container-fluid">

    <div class="newspage">
        <div class="container">

            {% block content %}
            {% endblock %}
        </div>

    </div>

</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script src="/Resources/JS/SCE/minified/jquery.sceditor.bbcode.min.js"></script>
<script>
    function BootboxConfirm(title, msg, cancelBtn, confirmBtn, callback){
        bootbox.confirm({
            title: title,
            message: msg,
            buttons: {
                confirm: confirmBtn,
                cancel: cancelBtn
            },
            callback: callback
        });
    }
</script>

<script>
    $(function() {
        // Replace all textarea tags with SCEditor
        var instance = $('.bbcode-editor').sceditor({
            plugins: 'bbcode',
            toolbarExclude: "subscript,superscript,cut,copy,paste,pastetext,email,youtube,print",
            emoticonsRoot: "/Resources/JS/SCE/",
            bbcodeTrim: true,
            style: 'Resources/JS/SCE/minified/jquery.sceditor.default.min.css'
        });

        $("#sce-fix").sceditor({
            plugins: 'bbcode',
            toolbarExclude: "subscript,superscript,cut,copy,paste,pastetext,email,youtube,print",
            emoticonsRoot: "/Resources/JS/SCE/",
            bbcodeTrim: true,
            style: 'Resources/JS/SCE/minified/jquery.sceditor.default.min.css'
        });
    });
</script>

</body>
</html>
