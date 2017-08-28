<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:55 PM
 */

function _middleware() {
	if (!isset($_COOKIE["s"]) || !validateSession($_COOKIE["s"])) errorThrower(119);
}
_middleware();

function getByID($id, $self) {
	if (!$id) errorThrower(104);

	if ($self) return fetch(query("SELECT `id`, `login`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `balance`, `role`, `bdate`, `registered_at` FROM users WHERE login=?", "i", array($id), "users_read"));
	fetch(query("SELECT `id`, `login`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `role`, `bdate`, `registered_at` FROM users WHERE login=?", "i", array($id), "users_read"));
}

function logout() {
	deactivateSession($_COOKIE["s"]) ? responseThrower(array("success" => true)) : errorThrower(120);
}

function edit($data) {
	global $_USER;
	if (!isset($data["firstname"]) || !isset($data["middlename"]) || !isset($data["lastname"]) ||
		!isset($data["login"]) || !isset($data["password"])) errorThrower(107);

}