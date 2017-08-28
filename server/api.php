<?php
//

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-type: text/html; charset=UTF-8');
//

include_once ('db.php');
include_once ('utils.php');
require_once ('models/sessions.php');

/// task.get
/// task.getByID
/// task.reserve
/// task.add				+
/// task.revoke
/// task.edit
/// users.getByID			+
/// users.get
/// users.register		+
/// users.login			+
/// users.edit
/// transactions.get
/// transactions.add


switch ($_REQUEST["method"]) {
	case "account.register":
		include('controllers/account.php');
		register($_REQUEST);
		break;
	case "account.login":
		include('controllers/account.php');
		login($_REQUEST);
		break;
	case "users.logout":
		include ('models/users.php');
		logout();
		break;
	case "users.getByID":
		include ('models/users.php');
		getByID($_REQUEST["id"]);
		break;
	case "tasks.add":
		include ('models/tasks.php');
		add($_REQUEST);
		break;
    default: errorThrower(101);
}

?>