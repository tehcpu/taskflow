<?php
//

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-type: text/html; charset=UTF-8');
//

include_once ('utils.php');

/// task.get
/// task.getByID
/// task.reserve
/// task.add
/// task.delete
/// task.edit
/// users.getByID			+
/// users.get
/// users.register		+
/// users.login			+
/// users.edit
/// transactions.get
/// transactions.add


switch ($_REQUEST["method"]) {
	case "accounts.register":
		include ('models/accounts.php');
		register($_REQUEST);
		break;
	case "accounts.login":
		include ('models/accounts.php');
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
    default: errorThrower(101);
}

?>