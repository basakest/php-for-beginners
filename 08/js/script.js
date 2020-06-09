$("a.delete").on("click", function(e) {
    e.preventDefault();
    if (confirm("Are you sure?")) {
        let form = $("<form>");
        form.attr("method", "POST");
        form.attr("action", $(this).attr("href"));
        form.appendTo("body");
        form.submit();
    }
});

$.validator.addMethod("dateTime", function(value, element) {
    return (value == "") || !isNaN(Date.parse(value));
}, "Must be a valid datetime");

$("#formArticle").validate({
    rules: {
        title: {
            required: true
        },
        content: {
            required: true
        },
        published_at: {
            dateTime: true
        }
    }
});

$("button.publish").on("click", function(e) {
    let id = $(this).data("id");
    let button = $(this);
    $.ajax({
        url: '/08/admin/publish_article.php',
        type: 'POST',
        data: {id: id}
    })
    .done(function(data) {
        button.parent().html(data);
    }).fail(function (data) {
        alert("an error occured");
    });
});

$("#published_at").datetimepicker({
    format: "Y-m-d H:i:s"
});

$("#email-form").validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        subject: {
            required: true
        },
        content: {
            required: true
        }
    }
});