<div class="layout">
    <h1 class="logo">
        Task Flow
    </h1>
    <div class="content">
        <div class="section">
            <div class="head">
                <div class="title">Регистрация</div>
            </div>
            <div class="body">
                <div class="login_with">
                    <div class="info_text">Укажите необходимую информацию. Все поля обязательны к заполнению.</div>
                    <div class="standart_form js-signin-form" id="register_user" method="post">
                        <div class="fields_group">
                            <div class="field">
                                <div class="input">
                                    <input tabindex="1" class="text" placeholder="Логин" type="text" name="login" id="new_user_login">
                                </div>
                            </div>
                            <div class="field">
                                <div class="input">
                                    <input tabindex="2" class="text" placeholder="Фамилия" type="text" name="lastname" id="new_user_lastname">
                                </div>
                            </div>
                            <div class="field">
                                <div class="input">
                                    <input tabindex="3" class="text" placeholder="Имя" type="text" name="firstname" id="new_user_firstname">
                                </div>
                            </div>
                            <div class="field">
                                <div class="input">
                                    <input tabindex="4" class="text" placeholder="Отчество" type="text" name="middlename" id="new_user_middlename">
                                </div>
                            </div>
                            <div class="field">
                                <div class="input">
                                    <input tabindex="5" class="text" placeholder="Пароль" type="password" name="password" id="new_user_password">
                                </div>
                            </div>
                            <div class="field">
                                <div class="input">
                                    <input tabindex="6" class="text" placeholder="Пароль (еще раз)" type="password" name="password_confirm" id="new_user_password_confirm">
                                </div>
                            </div>
                            <div class="field">
                                <select tabindex="7" class="custom_select" id="new_user_role">
                                    <option value="-1">- выберите роль на сайте -</option>
                                    <option value="0">Я исполнитель</option>
                                    <option value="1">Я заказчик</option>
                                </select>
                            </div>
                        </div>
                        <div class="buttons_wide">
                            <a class="button btn-blue" href="#" id="registerUserButton" tabindex="8">Зарегистрироваться</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="registrate_button">
            <a href="/auth">Войти</a> со своим аккаунтом
        </div>
    </div>
</div>
<script src="../controllers/register.js"></script>