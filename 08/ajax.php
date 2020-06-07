<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>ajax and json</title>
    </head>
    <body>
        <dl>
            <dt>name</dt>
            <dd id="name"></dd>
            <dt>age</dt>
            <dd id="age"></dd>
        </dl>
        <button id="button1">click</button>
        <script src="./js/jquery.js"></script>
        <script>
            $("#button1").on("click", function(e) {
                $.ajax("ajax-data.php")
                    .done(function(data) {
                        var json = JSON.parse(data);
                        $("#name").html(json.name);
                        $("#age").html(json.age);
                    })
            })
        </script>
    </body>
</html>