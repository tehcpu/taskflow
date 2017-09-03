<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    if (!isset($_COOKIE["s"]) && ($_SERVER["REQUEST_URI"] != "/auth" && $_SERVER["REQUEST_URI"] != "/auth?rs")) {
        header('Location: /auth');
        exit();
    } else if (isset($_COOKIE["s"]) && ($_SERVER["REQUEST_URI"] == "/" || $_SERVER["REQUEST_URI"] == "/auth"  ||$_SERVER["REQUEST_URI"] == "/auth?rs" || $_SERVER["REQUEST_URI"] == "/register")) {
        header('Location: /feed');
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Flow</title>
    <meta charset="UTF-8">
    <meta content="width = 1080" name="viewport">
    <link rel="stylesheet" href="/styles/general.css">
</head>
<body>
    <?php if (!isset($_COOKIE["s"])) { ?>
    <section id="auth" src="/templates/auth.tpl"></section>
    <section id="register" src="/templates/register.tpl"></section>
    <?php } else {
        require_once ('../server/controllers/profile.php');
        $user = getSelf()[0];
    ?>
    <div class="header">
        <div class="inner">
            <div class="right">
                <div class="user_panel">
                    <div class="dropdown user_menu">
                        <div class="balance-wrapper">
                            <a href="/transactions">
                                <span id="userBalance" class="balance">Баланс: <?=$user['balance']?> &#x20bd;</span>
                            </a>
                        </div>
                        <a id="userLink" href="/profile/<?=$user['id']?>">
                        <span class="toggler">
                            <span id="userAvatar" class="avatar" style="background-image: url('http://www.gravatar.com/avatar/<?=$user['id']?>?d=identicon')"></span>
                            <span id="userName" class="username"><?=$user['firstname']?></span>
                        </span>
                        </a>
                    </div>
                </div>
            </div>
            <a href="/feed"><h2 class="nav_logo">Task Flow</h2></a>
            <div class="top_main_menu">
                <a href="/feed">Задачи</a>
                <a href="/feed/my">Мои задачи</a>
                <!--a href="/settings">Настройки</a-->
                <?php if ($user["role"] == 0) { ?><a href="/new_task">Создать задачу</a><?php } ?>
            </div>
        </div>
    </div>
    <section id="feed" src="/templates/feed.tpl"></section>
    <section id="task" src="/templates/task.tpl"></section>
    <section id="profile" src="/templates/profile.tpl"></section>
    <section id="settings" src="/templates/settings.tpl"></section>
    <section id="transactions" src="/templates/transactions.tpl"></section>
    <section id="new_task" src="/templates/new_task.tpl"></section>
    <?php } ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/core/templater.js"></script>
    <script src="/core/utils.js"></script>
    <script src="/core/notify.js"></script>
</body>
</html>