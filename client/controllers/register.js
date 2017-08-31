app.page("register", function() {
    function registerUser() {
        var login = $("#new_user_login").val();
        var password = $("#new_user_password").val();
        var lastname = $("#new_user_lastname").val();
        var firstname = $("#new_user_firstname").val();
        var middlename = $("#new_user_middlename").val();
        var password_confirm = $("#new_user_password_confirm").val();
        var role = $("#new_user_role").val();
        if (login && password && lastname && firstname && middlename && password_confirm && role != -1) {
            if (password_confirm != password) {
                notificationCenter('Пароли не совпадают, попробуйте снова', 'error')
                $("#new_user_password").val('');
                $("#new_user_password_confirm").val('');
            } else {
                apiRequest('account.register', {
                    'login': login,
                    'password': password,
                    'role': role,
                    'lastname': lastname,
                    'firstname': firstname,
                    'middlename': middlename
                }, function (response) {
                    if (response.hasOwnProperty('error')) {
                        (response.error.error_code == 108) ?
                            notificationCenter('Пользователь с таким логином уже существует. Пожалуйста, используйте другой логин', 'error')
                            : notificationCenter('Произошла ошибка. Попробуйте снова через некоторое время', 'error')
                        $("#new_user_password").val('');
                        $("#new_user_password_confirm").val('');
                    } else {
                        document.location.href = "/auth?rs";
                    }
                });
            }
        } else {
            notificationCenter('Все поля обязательны к заполнению', 'error');
            $("#new_user_password").val('');
            $("#new_user_password_confirm").val('');
        }
    }



    // handlers

    $("#registerUserButton").unbind('click').on('click', function (e) {
        e.preventDefault();
        registerUser();
    })
});