app.page("feed", function() {
    $("#tasks_list").html("");
    var method = "feed.get";
    window.last_id_feed = 0;
    $(window).unbind('scroll');
    if (document.location.href.indexOf("my") > 0) {
        $(".top_main_menu a").removeClass("active");
        $(".top_main_menu a[href='/feed/my']").addClass("active");
        $("#feedTitle").html("Мои задачи");
        method = 'feed.my';
    } else {
        $(".top_main_menu a").removeClass("active");
        $(".top_main_menu a[href='/feed']").addClass("active");
        $("#feedTitle").html("Активные задачи");
        method = 'feed.get';
    }

    getFeed(method, window.last_id_feed, "tasks_list");

    window.feedListener = $(window).scroll(function () {
        if (!window.lock) {
            console.log(method);
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
                getFeed(method, window.last_id_feed, "tasks_list");
            }
        }
    });
});