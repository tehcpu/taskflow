<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:55 PM
 */

$_USER["id"] = null;

function createSession($uid) {
	if ($stmt = mysqli_prepare(getInstance("sessions_write"), 'INSERT INTO sessions (user_id, user_ip, hash, created_at, expired_at) VALUES (?, ?, ?, ?, ?)')) {
		$created_at = time();
		$user_ip = getClientIP();
		$expired_at = $created_at + (86400 * 31 * 12);
		$hash = bin2hex(random_bytes(16));
		mysqli_stmt_bind_param($stmt, "issii", $uid, $user_ip, $hash, $created_at, $expired_at);
		resultHelper($stmt);
		$session_id = mysqli_insert_id(getInstance("sessions_write"));
		if ($session_id > 0) {
			$session = $session_id.".".$hash;
			cookieSetter("s", $session);
			responseThrower(array("success" => true, "session" => $session));
		} else {
			errorThrower(113);
		}
	} else {
		errorThrower(105);
	}
}

function deactivateSession($session) {
	if ($stmt = mysqli_prepare(getInstance("sessions_write"), 'UPDATE sessions SET deactivated_at=? WHERE id=?')) {
		$deactivated_at = time();
		$sid = explode(".", $session)[0];
		mysqli_stmt_bind_param($stmt, "ii", $deactivated_at, $sid);
		if (!resultHelper($stmt)) {
			cookieRemover("s");
			return true;
		}
		return false;
	} else {
		errorThrower(105);
	}
}

function validateSession($session) {
	global $_USER;
	$parts = explode(".", $session);
	if (count($parts) != 2) errorThrower(115);
	$id = $parts[0];
	$hash = $parts[1];
	if ($stmt = mysqli_prepare(getInstance("sessions_read"), 'SELECT * FROM sessions WHERE id=?')) {
		mysqli_stmt_bind_param($stmt, "i", $id);
		$data = resultHelper($stmt);
		if (count($data) == 0) errorThrower(116);
		if ($hash != $data[0]["hash"]) errorThrower(115);
		if (time() > $data[0]["expired_at"]) errorThrower(117);
		if ($data[0]["deactivated_at"] > 0) errorThrower(118);
		$_USER["id"] = $data[0]["user_id"];
		return true;
	} else {
		errorThrower(105);
	}
}