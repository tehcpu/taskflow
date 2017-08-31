<div class="layout">
    <h1 class="logo">
        Task Flow
    </h1>
    <div class="content">
        <div class="section">
            <div class="head">
                <div class="title">Вход</div>
            </div>
            <div class="body">
                <div class="login_with">
                    <div class="info_text">Пройдите авторизацию или зарегистрируйте новоый аккаунт для пользования сервисом</div>
                    <form class="standart_form js-signin-form" id="new_user" method="post">
                        <div class="fields_group">
                            <div class="field">
                                <div class="input">
                                    <input tabindex="1" class="text" placeholder="Логин" type="text" name="login" id="user_login">
                                </div>
                            </div>
                            <div class="field">
                                <div class="input">
                                    <input tabindex="2" class="text" placeholder="Пароль" type="password" name="password" id="user_password">
                                </div>
                            </div>
                        </div>
                        <div class="buttons_wide">
                            <a class="button btn-blue" id="authUserButton" tabindex="3">Войти</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            <div class="registrate_button">
                <a href="/register">Зарегистрируйте</a> новый аккаунт
            </div>
        </div>
</div>
<script src="/controllers/auth.js"></script>