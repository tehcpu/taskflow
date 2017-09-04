<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 04/09/2017
 * Time: 1:44 AM
 */


require_once('../server/models/sessions.php');
require_once('../server/models/users.php');
require_once('../server/models/transactions.php');
require_once('../server/utils.php');

function _middleware() {
	if (!isset($_COOKIE["s"]) || !validateSession($_COOKIE["s"])) errorThrower(119);
}
_middleware();

function getSettings() {
	global $_USER;
	responseThrower(array("user" => getByID($_USER["id"], true)[0]));
}

function saveSettings($data) {
	$mode = $data["mode"];
	switch ($mode) {
		case "login":
			(changeLogin($data["login"])) ? responseThrower(array("success" => true)) : errorThrower(108);
			break;
		case "password":
			(changePassword($data["password"], $data["password_new"])) ? responseThrower(array("success" => true)) : errorThrower(123);
			break;
		case "name":
			(changeName($data["firstname"], $data["lastname"], $data["middlename"])) ? responseThrower(array("success" => true)) : errorThrower(100);
			break;
		case "phone":
			(changePhone("+7".$data["phone"])) ? responseThrower(array("success" => true)) : errorThrower(125);
			break;
		case "email":
			(changeEmail($data["email"])) ? responseThrower(array("success" => true)) : errorThrower(124);
			break;
		default:errorThrower(101);
	}
}

function getTransactions($data) {
	$last_id = 0;
	if (isset($data["last_id"]) && $data["last_id"] > 0) $last_id = $data["last_id"];
	$transactions = getList($last_id);
	responseThrower(array("transactions" => $transactions));
	return;
}