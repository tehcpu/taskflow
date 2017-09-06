app.page("feed", function() {
    var method = "";
    if (document.location.href.indexOf("my") > 0) {
        $("#feedTitle").html("Мои задачи");
        method = 'feed.my';
    } else {
        $("#feedTitle").html("Активные задачи");
        method = 'feed.get';
    }

    getFeed(method, window.list_last_id, "tasks_list");

    $(window).scroll(function () {
        if (!window.lock) {
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
                getFeed(method, window.list_last_id, "tasks_list");
            }
        }
    });
});