app.page("task", function() {
    $(".top_main_menu a").removeClass("active");
    window.last_id_feed = 0;
    $(window).unbind('scroll');
    user_id = parseInt(window.location.pathname.split("/").pop());
    apiRequest("tasks.get", {'id': user_id}, function (response) {
        task = response.response.task[0];
        user = response.response.user[0];

        $("#taskDate").html(timeConverter(task.created_at));
        $("#taskPrice").html(task.budget);
        $("#taskBody").html(task.body);
console.log(response.response.role)
        $("#taskUserLink").attr("href", "/profile/"+user.id);
        userAvatar = "http://www.gravatar.com/avatar/"+user.id+"?d=identicon";
        $("#taskUserAvatar").css("background-image", "url('"+userAvatar+"')");
        $("#taskUserName").html(user.firstname);
        (response.response.role == 0) ? $("#closeTask").hide() : $("#closeTask").show();
        if (task.closed_at != null) $("#closeTask").hide();
    });

    function reserve() {
        apiRequest("tasks.close", {'task_id': parseInt(window.location.pathname.split("/").pop())}, function (response) {
            alert()
            if (response.hasOwnProperty("error")) {
                if (response.error.error_code == 1338) notificationCenter("Вы не успели (как и я), кто-то уже забрал эту задачу");
                setTimeout(function () {
                    document.location.href = '/feed';
                }, 3000);
            } else {
                notificationCenter("Задача зарезервирована за Вами, деньги на счет получены", 'success');
                setTimeout(function () {
                    document.location.href = '/feed';
                }, 3000);
            }
        });

    }

    $("#closeTask").on('click', function () {
        $(this).remove();
        reserve()
    });
});