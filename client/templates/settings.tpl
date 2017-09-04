<div class="settings_content">
    <div class="settings_sidebar left">
        <div class="section user_settings_menu_profile">
            <div class="menu">
                <a class="active" href="/settings">Личная информация</a>
                <a href="/transactions">Транзакции</a>
            </div>
        </div>
    </div>
    <div class="settings_main right">
        <div class="section">
            <div class="head">
                <div class="title">Личная информация</div>
            </div>
            <div class="body">
                <div class="standart_form js-personal-form">
                    <div class="fields_group">
                        <!-- login section -->
                        <div class="field">
                            <div class="label">
                                <label for="login">Логин</label>
                            </div>
                            <div class="input">
                                <input class="text" type="text" name="login" id="settings_login">
                            </div>
                        </div>
                        <button name="commit" id="commitLogin" scope="login" class="button btn-blue commit_section">Сохранить</button>
                        <div class="devider"></div>

                        <!-- name section -->
                        <div class="field">
                            <div class="label">
                                <label for="user_first_name">Имя</label>
                            </div>
                            <div class="input">
                                <input class="text" onkeypress="return lettersOnly(event)" type="text" name="firstname" id="settings_first_name">
                            </div>
                        </div>
                        <div class="field">
                            <div class="label">
                                <label for="user_last_name">Фамилия</label>
                            </div>
                            <div class="input">
                                <input class="text" type="text" onkeypress="return lettersOnly(event)" name="lastname" id="settings_last_name">
                            </div>
                        </div>
                        <div class="field">
                            <div class="label">
                                <label for="user_middle_name">Отчество</label>
                            </div>
                            <div class="input">
                                <input class="text" type="text" onkeypress="return lettersOnly(event)" name="middlename" id="settings_middle_name">
                            </div>
                        </div>
                        <button name="commit" id="commitName" scope="name" class="button btn-blue commit_section">Сохранить</button>
                        <div class="devider"></div>

                        <!-- password section -->
                        <div class="field">
                            <div class="label">
                                <label for="user_email">Текущий пароль</label>
                            </div>
                            <div class="input">
                                <input class="text" type="password" name="password" id="settings_password">
                            </div>
                        </div>
                        <div class="field">
                            <div class="label">
                                <label for="user_email">Новый пароль</label>
                            </div>
                            <div class="input">
                                <input class="text" type="password" name="password_new" id="settings_password_new">
                            </div>
                        </div>
                        <div class="field">
                            <div class="label">
                                <label for="user_email">Новый пароль (еще раз)</label>
                            </div>
                            <div class="input">
                                <input class="text" type="password" name="password_new_again" id="settings_password_new_again">
                            </div>
                        </div>
                        <button name="commit" id="commitPassword" scope="password" class="button btn-blue commit_section">Сохранить</button>
                        <div class="devider"></div>

                        <!-- email section -->
                        <div class="field">
                            <div class="label">
                                <label for="user_email">Эл. почта</label>
                            </div>
                            <div class="input">
                                <input class="text" type="email" value="me@tehcpu.ru" name="email" id="settings_email">
                            </div>
                        </div>
                        <button name="commit" id="commitName" scope="email" class="button btn-blue commit_section">Сохранить</button>
                        <div class="devider"></div>

                        <!-- phone section -->
                        <div class="field">
                            <div class="label">
                                <label for="login">Телефон</label>
                            </div>
                            <div class="input">
                                <input class="text" minlength="10" maxlength="10" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Например: 9998887766" name="phone" id="settings_phone">
                            </div>
                        </div>
                        <button name="commit" id="commitName" value="Сохранить" scope="phone" class="button btn-blue commit_section">Сохранить</button>
                    </div>
                    <div class="buttons js-sticky-buttons">
                        <button name="commit" id="logoutBtn" scope="logout" class="button btn-orange">Выход</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<script src="/controllers/settings.js"></script>