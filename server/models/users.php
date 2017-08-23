<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:55 PM
 */

include_once ('./db.php');

function _middleware() {
	if (!isset($_COOKIE["s"]) || !validateSession($_COOKIE["s"])) errorThrower(119);
}
_middleware();

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

function logout() {
	deactivateSession($_COOKIE["s"]) ? responseThrower(array("success" => true)) : errorThrower(120);
}