<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Untitled Framework Homepage">
    <meta name="author" content="Colum Ferry">

    <title>{{ page_name }} - Untitled Web Admin</title>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- UWA -->
    <link rel="stylesheet" href="/Resources/CSS/UWA.css" type="text/css" />
    <link rel="stylesheet" href="/Resources/CSS/UCard.css" type="text/css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://use.fontawesome.com/5318d08ea2.js"></script>
    <link rel="stylesheet" href="/Resources/JS/SCE/minified/themes/default.min.css" />
    <link rel="stylesheet" href="/Resources/JS/Lightbox/css/lightbox.min.css" />
</head>
<body>

<div class="container-fluid">
    {% block content %}{% endblock %}
</div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script src="/Resources/JS/UWA/UWA.js"></script>
<script src="/Resources/JS/SCE/minified/jquery.sceditor.bbcode.min.js"></script>
<script src="/Resources/JS/Lightbox/js/lightbox.min.js"></script>

<script>
    $(function() {
        // Replace all textarea tags with SCEditor
        var instance = $('.bbcode-editor').sceditor({
            plugins: 'bbcode',
            toolbarExclude: "subscript,superscript,cut,copy,paste,pastetext,email,youtube,print",
            emoticonsRoot: "/Resources/JS/SCE/",
            bbcodeTrim: true,
            style: '/Resources/JS/SCE/minified/jquery.sceditor.default.min.css'
        });
    });
</script>
</body>
</html>