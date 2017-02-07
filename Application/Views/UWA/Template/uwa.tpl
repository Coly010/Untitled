<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Untitled Web Admin</title>

    <script src="https://use.fontawesome.com/5318d08ea2.js"></script>
</head>
<body>

<div class="container-fluid">
    {% block content %}{% endblock %}
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>


<script type="text/javascript">
    function validateOnSubmit(title, message, cancelBtn, confirmBtn, callback){
        bootbox.confirm({
            title: title,
            message: message,
            buttons: {
                cancel: {
                    label: cancelBtn
                },
                confirm: {
                    label: confirmBtn
                }
            },
            callback: callback
        });
    }
</script>
</body>
</html>