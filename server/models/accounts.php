<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 23/08/2017
 * Time: 7:28 PM
 */

include_once ('./db.php');
include_once ('sessions.php');

function _middleware() {
	if (isset($_COOKIE["s"]) && validateSession($_COOKIE["s"])) errorThrower(114);
}
_middleware();

function register($data) {
	if (!isset($data["firstname"]) || !isset($data["middlename"]) || !isset($data["lastname"]) ||
		!isset($data["login"]) || !isset($data["password"]) || !isset($data["role"])) errorThrower(107);

	if ($stmt = mysqli_prepare(getInstance("users_read"), 'SELECT `login` FROM users WHERE login=?')) {
		mysqli_stmt_bind_param($stmt, "s", $data["login"]);
		$result = resultHelper($stmt);
		if (count($result) > 0) errorThrower(108);
		if ($stmt = mysqli_prepare(getInstance("users_write"), 'INSERT INTO users (firstname, middlename, lastname, login, password, role, registered_at) VALUES (?, ?, ?, ?, ?, ?, ?)')) {
			$time = time();
			$hash = encodePassword($data["password"]);
			mysqli_stmt_bind_param($stmt, "sssssii", $data["firstname"], $data["middlename"], $data["lastname"], $data["login"], $hash, $data["role"], $time);
			resultHelper($stmt);
			$user_id = mysqli_insert_id(getInstance("users_write"));
			if ($user_id > 0) {
				responseThrower(array("success" => true, "user_id" => $user_id));
			} else {
				errorThrower(109);
			}
		} else {
			errorThrower(105);
		}
	} else {
		errorThrower(105);
	}
}

function login($data)
{
	if (!isset($data["login"]) || !isset($data["password"])) errorThrower(110);

	if ($stmt = mysqli_prepare(getInstance("users_read"), 'SELECT `login`, `password`, `id` FROM users WHERE login=?')) {
		mysqli_stmt_bind_param($stmt, "s", $data["login"]);
		$result = resultHelper($stmt);
		if (count($result) == 0) errorThrower(111);
		if (checkPassword($data["password"], $result[0]["password"])) {
			include ('sessions.php');
			createSession($result[0]["id"]);
		} else {
			errorThrower(112);
		}
	} else {
		errorThrower(105);
	}
}