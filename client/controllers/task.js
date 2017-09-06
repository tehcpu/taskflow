app.page("task", function() {
    user_id = parseInt(window.location.pathname.split("/").pop());
    var price = 0;
    apiRequest("tasks.get", {'id': user_id}, function (response) {
        console.log(response);
        task = response.response.task[0];
        user = response.response.user[0];

        $("#taskDate").html(timeConverter(task.created_at));
        $("#taskPrice").html(task.budget);
        price = task.budget;
        $("#taskBody").html(task.body);
        $("#taskUserLink").attr("href", "/profile/"+user.id);
        userAvatar = "http://www.gravatar.com/avatar/"+user.id+"?d=identicon";
        $("#taskUserAvatar").css("background-image", "url('"+userAvatar+"')");
        $("#taskUserName").html(user.firstname);
        (response.response.role == 0) ? $("#closeTask").hide() : $("#closeTask").show();
        if (task.closed_at != null) $("#closeTask").hide();
    });

    function reserve() {
        apiRequest("tasks.close", {'task_id': parseInt(window.location.pathname.split("/").pop())}, function (response) {
            if (response.hasOwnProperty("error")) {
                if (response.error.error_code == 1338) notificationCenter("Вы не успели (как и я), кто-то уже забрал эту задачу");
                setTimeout(function () {
                    document.location.href = '/feed';
                }, 3000);
            } else {
                notificationCenter("Задача зарезервирована за Вами, деньги на счет получены", 'success');
                balanceUpdater(Math.round(price*0.9));
                setTimeout(function () {
                    document.location.href = '/feed';
                }, 3000);
            }
        });

    }

    $("#closeTask").unbind("click").on('click', function () {
        $(this).remove();
        reserve()
    });
});