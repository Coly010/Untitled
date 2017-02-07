<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
</head>
<body>

<nav class="navbar navbar-fixed-top uwa-nav">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="menu-header">UWebAdmin</li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="/login/logout">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-2 uwa-menu">
            <ul class="nav nav-pills nav-stacked">

                {% for item in uwa_dashboard_menu %}
                    {% if item.Header == true %}
                        <li class="menu-header">
                            {{ item.Link }}
                    {% else %}
                        <li class="menu-item">
                            <a href="{{ item.Url }}">{{ item.Link }}</a>
                    {% endif %}
                </li>
                {% endfor %}

            </ul>
        </div>
        <div class="col-sm-10 uwa-content">
            <div class="container">
                {% block content %}{% endblock %}
            </div>
        </div>

    </div>
</div>


<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
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

</body>
</html>