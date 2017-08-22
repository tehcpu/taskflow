<?php
//

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//

/// task.get
/// task.getByID
/// task.reserve
/// task.add
/// task.delete
/// task.edit
/// users.getByID
/// users.get 				+
/// users.register
/// users.login
/// users.edit
/// transactions.get
/// transactions.add

$cookie_name = "qwe1";
$cookie_value = "123";
setcookie($cookie_name, $cookie_value, time() + (86400 * 31 * 12), "/", "taskflow.net", false, true); // 86400 = 1 day



//

switch ($_REQUEST["method"]) {
	case "users.getByID":
		include ('models/users.php');
    	getByID($_REQUEST["id"]);
    	break;
	case "users.register":
		include ('models/users.php');
		register($_REQUEST);
		break;
    default: errorThrower(101);
}

?>