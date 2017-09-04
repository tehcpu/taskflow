app.page("settings", function() {
    apiRequest("settings.get", null, function (response) {
        user = response.response.user;
        if (user.login != null) $("#settings_login").val(user.login);
        if (user.firstname != null) $("#settings_first_name").val(user.firstname);
        if (user.lastname != null) $("#settings_last_name").val(user.lastname);
        if (user.middlename != null) $("#settings_middle_name").val(user.middlename);
        if (user.email != null) $("#settings_email").val(user.email);
        var phone = user.phone+"";
        if (user.phone != null) $("#settings_phone").val(phone.substring(2));
    });

    function save(field) {
        var data;
        switch (field) {
            case 'login':
                data = {"login" : $("#settings_login").val()};
                break;
            case 'name':
                if ($("#settings_last_name").val().length < 2 || $("#settings_first_name").val().length < 2) {
                    notificationCenter("Введите свои настоящие имя и фамилию", 'error');
                    break;
                }
                data = {"firstname": $("#settings_first_name").val(), "lastname": $("#settings_last_name").val(), "middlename": $("#settings_middle_name").val()};
                break;
            case 'password':
                if ($("#settings_password_new").val() != $("#settings_password_new_again").val()) {
                    notificationCenter("Новый пароль и его подтверждение не сходятся. Проверьте раскладку и состояние клавиши Caps Lock", 'error');
                    break;
                }
                data = {"password": $("#settings_password").val(), "password_new": $("#settings_password_new").val()};
                break;
            case 'email':
                data = {"email": $("#settings_email").val()};
                break;
            case 'phone':
                data = {"phone": $("#settings_phone").val()};
                break;
            default:
                notificationCenter("WTF?", 'error');
                break;
        }

        data.mode = field;

        // clear pass fields
        $("#settings_password_new").val("");
        $("#settings_password_new_again").val("");
        $("#settings_password").val("");

        apiRequest("settings.save", data, function (response) {
            if (response.hasOwnProperty("response")) {
                notificationCenter("Данные успешно обновлены", 'success');
            } else {
                error_code = response.error.error_code;
                switch (error_code) {
                    case 108:
                        notificationCenter("Этот логин уже используется другим пользователем", 'error');
                        break;
                    case 123:
                        notificationCenter("Введен неверный текущий пароль. Проверьте раскладку и состояние клавиши Caps Lock", 'error');
                        break;
                    case 124:
                        notificationCenter("Этот адрес электронной почты уже используется другим пользователем", 'error');
                        break;
                    case 125:
                        notificationCenter("Этот номер телефона уже используется другим пользователем", 'error');
                        break;
                    default:
                        notificationCenter("Что-то пошло не так", 'error');
                        break;
                }
            }
        });
    }

    $(".commit_section").unbind("click").on('click', function () {
        save($(this).attr("scope"));
    });

    $("#logoutBtn").on('click', function () {
        apiRequest("profile.logout", null, function (response) {});
        setTimeout(function () {
            document.location.reload(true);
        }, 100); // dirtyfix of session invalidation
    });
});