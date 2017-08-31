app.page("auth", function() {
    function authUser() {
        var login = $("#user_login").val();
        var password = $("#user_password").val();
        if (login && password) {
            apiRequest('account.login', {'login': login, 'password': password}, function (response) {
                if (!response.hasOwnProperty('error')) {
                    location.reload();
                } else {
                    notificationCenter('Пользователь с такими данными не найден. Попробуйте еще раз.', 'error');
                    $("#user_password").val('');
                }
            });
        } else {
            notificationCenter('Пожалуйста, заполните все поля', 'error');
            $("#user_password").val('');
        }
    }



    // handlers

    $("#authUserButton").unbind('click').on('click', function (e) {
        e.preventDefault();
        authUser();
    })

    if (document.location.search == "?rs") {
        // fake notify fix
        setTimeout(function () {
            notificationCenter('Регистрация прошла успешно. Теперь вы можете войти со своим аккаунтом', 'success');
        }, 500);
    }
});