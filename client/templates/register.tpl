<div class="container">

    <form class="form-signin">
        <h2 class="form-signin-heading">Регистрация</h2>
        <label for="inputEmail" class="sr-only">Логин</label>
        <input minlength="4" maxlength="64" id="inputEmail" class="form-control" placeholder="Логин" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" required="">
        <button class="btn btn-lg btn-primary btn-block">Вход</button>
    </form>

</div>

<script>
    app.page("auth", function()
    {

    });
</script>