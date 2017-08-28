<!DOCTYPE html>
<html>
<head>
    <title>TaskFlow</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="client/core/templater.js"></script>

    <style>

        body {
            background: #F4F7F9;
            margin: 0;
            padding: 0;
            font: 10pt sans-serif;
        }

        /* visibility rules */

        /* all sections are off by default */
        body > section { display:none; }

        body.auth           > section#auth,
        body.register        > section#register,
        body.contact-details > section#contact-details { display:block; }

        /* nav styling */
        nav     { background:#555; padding:10px 10px 0 10px; }
        nav > a { display:inline-block; color: white; padding:4px 10px; }

        /* nav highlightion rules */
        body.auth           > nav > a[href="#auth"],
        body.register        > nav > a[href="#register"],
        body.contact-details > nav > a[href="#contact-details"] { background:white; color:black; }

/*
========
 */
        .form-signin {
            padding-top: 100px;
            max-width: 330px;
            margin: 0 auto;
        }

        .form-signin h2 {
            text-align: center;
            padding-bottom: 0.5em;
        }

        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin .checkbox {
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">TaskFlow</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Меню">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="navbar-nav form-inline my-2 my-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="#register">Регистрация</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#auth">Вход</a>
            </li>
        </ul>
    </div>
</nav>

<section id="auth" src="client/templates/auth.tpl"></section>
<section id="register" src="client/templates/register.tpl"></section>
<section id="task-list" src="client/templates/task-list.tpl"></section>
<section id="task-full" src="client/templates/auth"></section>
<section id="profile" src="client/templates/auth"></section>
<section id="profile-edit" src="client/templates/auth"
<section id="settings-general" src="client/templates/auth"></section>
<section id="settings-transactions" src="client/templates/auth"></section>

</body>
</html>