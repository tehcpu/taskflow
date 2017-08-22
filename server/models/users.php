<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:55 PM
 */

include ('./db.php');

function getByID($id) {
	if (!$id) errorThrower(104);
	if ($stmt = mysqli_prepare(getInstance("users_read"), 'SELECT * FROM users WHERE id=?')) {
		mysqli_stmt_bind_param($stmt, "i", $id);
		$data = resultHelper($stmt);
		(count($data) > 0) ? responseThrower(resultHelper($stmt)) : errorThrower(106);
	} else {
		errorThrower(105);
	}
}

function register($data) {
	if (!isset($data["firstname"]) || !isset($data["middlename"]) || !isset($data["lastname"]) ||
		 !isset($data["phone"]) || !isset($data["password"]) || !isset($data["role"])) errorThrower(107);

	if ($stmt = mysqli_prepare(getInstance("users_read"), 'SELECT `phone` FROM users WHERE email=?')) {
		mysqli_stmt_bind_param($stmt, "s", $data["phone"]);
		$result = resultHelper($stmt);
		foreach ($result as $user) {
			if ($user["phone"] == $data["phone"]) errorThrower(108);
		}
		//(count($data) > 0) ? responseThrower(resultHelper($stmt)) : errorThrower(106);
	} else {
		errorThrower(105);
	}
}