app.page("profile", function() {
    user_id = parseInt(window.location.pathname.split("/").pop());
    apiRequest("profile.get", {'id': user_id}, function (response) {
        if (response.hasOwnProperty("response")) {
            console.log(response)
            user = response.response.user[0];
            role = (user.role == 0) ? "Заказчик" : 'Исполнитель';
            phone = user.phone+"";

            data ='<div class="profile_sidebar left">' +
                    '<div class="section user_info">' +
                    '<a class="avatar" href="/profile/'+escapeHTML(user.id)+'">' +
                    '<img alt="'+escapeHTML(user.login)+'" src="http://www.gravatar.com/avatar/'+escapeHTML(user.id)+'?d=identicon">' +
                    '</a>' +
                    '<div class="user_name">' +
                    '<a href="/profile/'+escapeHTML(user.id)+'">'+escapeHTML(user.firstname)+' '+escapeHTML(user.lastname)+'</a>' +
                    '</div>' +
                    '<div class="profession">Зарегистрирован: '+timeConverter(user.registered_at)+'</div>' +
                    '<div class="homepage"><b>'+role+'</b></div>' +
                    '<div class="salary">' +
                    '<div class="status userEmail">' +
                    '<a class="pseudo" href="mailto:'+escapeHTML(user.email)+'">'+escapeHTML(user.email)+'</a>' +
                    '</div>' +
                    '<div class="status userPhone"> ' +
                    '<a class="pseudo" href="tel:'+escapeHTML(user.phone)+'">'+escapeHTML(phone.replace(/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/, '$1 ($2) $3 $4 $5'))+'</a>' +
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
    });

    getFeed("feed.user", window.list_last_id, "tasks_list_profile", user_id);

    $(window).scroll(function () {
        if (!window.lock) {
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
                getFeed("feed.user", window.list_last_id, "tasks_list_profile", user_id);
            }
        }
    });
});