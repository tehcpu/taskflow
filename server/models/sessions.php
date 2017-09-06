<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:55 PM
 */

include_once('../server/db.php');
include_once('../server/cache.php');

$_USER = null;

function createSession($uid) {
	$created_at = time();
	$user_ip = getClientIP();
	$expired_at = $created_at + (86400 * 31 * 12);
	$hash = bin2hex(random_bytes(16));

	query("INSERT INTO sessions (user_id, user_ip, hash, created_at, expired_at) VALUES (?, ?, ?, ?, ?)", "issii", array($uid, $user_ip, $hash, $created_at, $expired_at), "sessions_write");

	$session_id = getLastInsertID("sessions_write");
	$session = $session_id.".".$hash;

	cookieSetter("s", $session);
	responseThrower(array("success" => true, "session" => $session));
}

function deactivateSession($session) {
	$deactivated_at = time();
	$sid = explode(".", $session)[0];
	query("UPDATE sessions SET deactivated_at=? WHERE id=?", "ii", array($deactivated_at, $sid), "sessions_write");
	delete('session_'.$sid, "sessions");
	cookieRemover("s");
	return true;
}

function validateSession($session) {
	global $_USER;
	$parts = explode(".", $session);
	if (count($parts) != 2) errorThrower(115);
	$id = $parts[0];
	$hash = $parts[1];
	$data = json_decode(get('session_'.$id, "sessions"), true);
	if (!$data) {
		$data = fetch(query("SELECT * FROM sessions WHERE id=?", "i", array($id), "sessions_read"));
		set('session_'.$id, json_encode($data, JSON_UNESCAPED_UNICODE), "sessions");
	}
	if (count($data) == 0) errorThrower(116);
	if ($hash != $data[0]["hash"]) errorThrower(115);
	if (time() > $data[0]["expired_at"]) errorThrower(117);
	if ($data[0]["deactivated_at"] > 0) errorThrower(118);
	$_USER["id"] = $data[0]["user_id"];
	return true;
}