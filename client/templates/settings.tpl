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
                        <form class="standart_form js-personal-form">
                            <div class="fields_group">
                                <div class="field">
                                    <div class="label">
                                        <label for="login">Логин</label>
                                    </div>
                                    <div class="input">
                                        <input class="text" type="text" value="tehcpu" name="login" id="user_login">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">
                                        <label for="user_first_name">Имя</label>
                                    </div>
                                    <div class="input">
                                        <input class="text" type="text" value="Алексей" name="firstname" id="user_first_name">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">
                                        <label for="user_last_name">Фамилия</label>
                                    </div>
                                    <div class="input">
                                        <input class="text" type="text" value="Агафонов" name="lastname" id="user_last_name">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">
                                        <label for="user_middle_name">Отчество</label>
                                    </div>
                                    <div class="input">
                                        <input class="text" type="text" value="" name="middlename" id="user_middle_name">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">
                                        <label for="user_email">Эл. почта</label>
                                    </div>
                                    <div class="input">
                                        <input class="text" type="email" value="me@tehcpu.ru" name="email" id="user_email">
                                    </div>
                                </div>
                            </div>
                            <div class="buttons js-sticky-buttons">
                                <input type="submit" name="commit" value="Сохранить" class="button btn-blue">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    <div class="clear"></div>
</div>

<script>
    app.page("settings", function() {
        $(".top_main_menu a").removeClass("active");
        $(".top_main_menu a[href='/settings']").addClass("active");
    });
</script>

<script src="/controllers/settings.js"></script>