app.page("profile", function() {
    $(".top_main_menu a").removeClass("active");
    $("#tasks_list_profile").html("");
    $(".profile_sidebar").remove();
    var method = "feed.user";
    window.last_id_feed = 0;
    $(window).unbind('scroll');
    user_id = parseInt(window.location.pathname.split("/").pop());

    apiRequest("profile.get", {'id': user_id}, function (response) {
        console.log(response);
        if (response.hasOwnProperty("response")) {
            user = response.response.user[0];

            role = (user.role == 0) ? "Заказчик" : 'Исполнитель';
            data ='<div class="profile_sidebar left">' +
                    '<div class="section user_info">' +
                    '<a class="avatar" href="/profile/'+user.id+'">' +
                    '<img alt="'+user.login+'" src="http://www.gravatar.com/avatar/'+user.id+'?d=identicon">' +
                    '</a>' +
                    '<div class="user_name">' +
                    '<a href="/profile/'+user.id+'">'+user.firstname+' '+user.lastname+'</a>' +
                    '</div>' +
                    '<div class="profession">Зарегистрирован: '+timeConverter(user.registered_at)+'</div>' +
                    '<div class="homepage"><b>'+role+'</b></div>' +
                    '<div class="salary">' +
                    '<div class="status userEmail">' +
                    '<a href="mailto:'+user.email+'">'+user.email+'</a>' +
                    '</div>' +
                    '<div class="status userPhone"> ' +
                    '<a href="tel:'+user.phone+'">'+user.phone+'</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            $("#profileInfo").prepend(data);

            if (!user.email) $(".userEmail").remove();
            if (!user.phone) $(".userPhone").remove();
            if (!user.email && !user.phone) $(".salary").remove();
        } else {
            notificationCenter("Что-то пошло совсем не так :(", 'error')
        }
    })

    getFeed(method, window.last_id_feed, "tasks_list_profile", user_id);

    window.feedListener = $(window).scroll(function () {
        if (!window.lock) {
            console.log(method);
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
                getFeed(method, window.last_id_feed, "tasks_list_profile", user_id);
            }
        }
    });
});