<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 30/08/2017
 * Time: 9:08 PM
 */

require_once('../server/models/sessions.php');
require_once('../server/models/users.php');
require_once('../server/models/tasks.php');

function _middleware() {
	if (!isset($_COOKIE["s"]) || !validateSession($_COOKIE["s"])) errorThrower(119);
}
_middleware();

function getSelf() {
	global $_USER;
	return getByID($_USER["id"], true);
}

function getProfile($data) {
	$user = getByID($data["id"], false);
	responseThrower(array("user" => array($user)));
}

function logoutUser() {
	logout();
	responseThrower(array("success" => true));
}