<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 23/08/2017
 * Time: 7:28 PM
 */

function _middleware() {
	if (isset($_COOKIE["s"]) && validateSession($_COOKIE["s"])) errorThrower(114);
}
_middleware();

function register($data) {
	if (!isset($data["firstname"]) || !isset($data["middlename"]) || !isset($data["lastname"]) ||
		!isset($data["login"]) || !isset($data["password"]) || !isset($data["role"])) errorThrower(107);

	$result = fetch(query("SELECT `login` FROM users WHERE login=?", "s", array($data["login"]), "users_read"));
	if (count($result) > 0) errorThrower(108);
	query("INSERT INTO users (firstname, middlename, lastname, login, password, role, registered_at) VALUES (?, ?, ?, ?, ?, ?, ?)", "sssssii", array($data["firstname"], $data["middlename"], $data["lastname"], $data["login"], encodePassword($data["password"]), $data["role"], time()), "users_write");
	responseThrower(array("success" => true, "user_id" => getLastInsertID("users_write")));
}

function login($data) {
	if (!isset($data["login"]) || !isset($data["password"])) errorThrower(110);

	$result = fetch(query("SELECT `login`, `password`, `id` FROM users WHERE login=?", "s", array($data["login"]), "users_read"));
	if (count($result) == 0) errorThrower(111);
	if (checkPassword($data["password"], $result[0]["password"])) {
		createSession($result[0]["id"]);
	} else {
		errorThrower(112);
	}
}