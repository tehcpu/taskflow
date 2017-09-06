<?php
//

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-type: text/html; charset=UTF-8');

include_once('../server/utils.php');

switch ($_REQUEST["method"]) {
	case "account.register":
		include('../server/controllers/account.php');
		register($_REQUEST);
		break;
	case "account.login":
		include('../server/controllers/account.php');
		login($_REQUEST);
		break;
	case "feed.get":
		include('../server/controllers/feed.php');
		getFeed($_REQUEST);
		break;
	case "feed.my":
		include('../server/controllers/feed.php');
		getMyFeed($_REQUEST);
		break;
	case "feed.user":
		include('../server/controllers/feed.php');
		getUserFeed($_REQUEST);
		break;
	case "profile.self":
		include('../server/controllers/profile.php');
		getSelf();
		break;
	case "profile.logout":
		include('../server/controllers/profile.php');
		logoutUser();
		break;
	case "profile.get":
		include('../server/controllers/profile.php');
		getProfile($_REQUEST);
		break;
	case "tasks.get":
		include('../server/controllers/task.php');
		getTaskByID($_REQUEST);
		break;
	case "tasks.close":
		include('../server/controllers/task.php');
		executeTask($_REQUEST);
		break;
	case "tasks.open":
		include('../server/controllers/task.php');
		createTask($_REQUEST);
		break;
	case "settings.get":
		include('../server/controllers/settings.php');
		getSettings();
		break;
	case "settings.save":
		include('../server/controllers/settings.php');
		saveSettings($_REQUEST);
		break;
	case "settings.transactions":
		include('../server/controllers/settings.php');
		getTransactions($_REQUEST);
		break;
    default: errorThrower(101);
}