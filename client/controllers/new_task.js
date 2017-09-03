app.page("new_task", function() {
    $("#startTask").unbind("click");
    $(".top_main_menu a").removeClass("active");
    $(".top_main_menu a[href='/new_task']").addClass("active");

    function start() {
        body = $("#newTaskBody").val();
        title = $("#newTaskTitle").val();
        budget = $("#newTaskBudget").val();
        if (body.length > 0 && title.length > 0 && budget > 0) {
            apiRequest("tasks.open", {'body': body, "budget": budget, "title": title}, function (response) {
                console.log(response)
                $("#startTask").show();
                if (response.hasOwnProperty("error")) {
                    if (response.error.error_code == 121) notificationCenter("Недостаточно средств");
                } else {
                    document.location.href = "/task/"+response.response.task_id;
                }
            });
        } else {
            $("#startTask").show();
            notificationCenter("Все поля обязательны к заполнению");
        }

    }

    $("#startTask").on('click', function () {
        $(this).hide();
        start();
    });
});