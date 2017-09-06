<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:55 PM
 */

function getByID($id, $self) {
	if (!$id) errorThrower(104);
	// не светим баланс всяким
	if ($self) {
		$user = json_decode(get('user_'.$id."_self", "users"), true);
		if (!$user) {
			$user = fetch(query("SELECT `id`, `login`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `balance`, `role`, `bdate`, `registered_at` FROM users WHERE id=?", "i", array($id), "users_read"));
			set("user_".$id."_self", json_encode($user[0], JSON_UNESCAPED_UNICODE), "users");
			return $user[0];
		}
		return $user;
	} else {
		$user = json_decode(get('user_'.$id, "users"), true);
		if (!$user) {
			$user = fetch(query("SELECT `id`, `login`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `role`, `bdate`, `registered_at` FROM users WHERE id=?", "i", array($id), "users_read"));
			set("user_".$id, json_encode($user[0], JSON_UNESCAPED_UNICODE), "users");
			return $user[0];
		}
		return $user;
	}
}

function getByIDs($ids) {
	$ids = array_unique($ids);
	$missingIds = array();
	$users = array();
	foreach ($ids as $id) {
		$user = json_decode(get('user_'.$id, "users"), true);
		($user) ? array_push($users, $user) : array_push($missingIds, $id);
	}
	$ids = $missingIds;
	//var_dump($ids);
	$data = array();
	if (count($ids) > 0) {
		$clause = implode(',', array_fill(0, count($ids), '?'));
		$types = implode('', array_fill(0, count($ids), 'i'));

		$data = fetch(query("SELECT `id`, `login`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `role`, `bdate`, `registered_at` FROM users WHERE `id` IN (" . $clause . ")", $types, $ids, "users_read"));
		foreach ($data as $user) {
			set("user_".$user["id"], json_encode($user, JSON_UNESCAPED_UNICODE), "users");
			array_push($users, $user);
		}
	}
	return $users;
}

function logout() {
	global $_USER;
	delete("user_".$_USER["id"], "users");
	deactivateSession($_COOKIE["s"]) ? responseThrower(array("success" => true)) : errorThrower(120);
}


function changeBalance($uid, $sum) {
	delete("user_".$uid, "users");
	query("UPDATE users SET balance = balance + ? WHERE id = ?", "ii", array($sum, $uid), "users_write");
	return true;
}

function changeLogin($login) {
	global $_USER;
	delete("user_".$_USER["id"], "users");
	delete("user_".$_USER["id"]."_self", "users");
	$user = fetch(query("SELECT `id` FROM users WHERE login = ?", "s", array($login), "users_read"));
	if (count($user) == 0 || $user[0]["id"] == $_USER["id"]) {
		query("UPDATE users SET login = ? WHERE id = ?", "si", array($login, $_USER["id"]), "users_write");
		return true;
	} else
		return false;
}

function changePassword($old, $new) {
	global $_USER;
	delete("user_".$_USER["id"], "users");
	delete("user_".$_USER["id"]."_self", "users");
	$user = fetch(query("SELECT `password` FROM users WHERE id = ?", "i", array($_USER["id"]), "users_read"));
	if (password_verify($old, $user[0]["password"])) {
		query("UPDATE users SET password = ? WHERE id = ?", "si", array(password_hash($new, PASSWORD_BCRYPT, array('cost' => 12)), $_USER["id"]), "users_write");
		return true;
	}
	return false;
}

function changeName($firstname, $lastname, $middlename) {
	global $_USER;
	delete("user_".$_USER["id"], "users");
	delete("user_".$_USER["id"]."_self", "users");
	query("UPDATE users SET firstname = ?, lastname = ?, middlename = ? WHERE id = ?", "sssi", array($firstname, $lastname, $middlename, $_USER["id"]), "users_write");
	return true;
}

function changePhone($phone) {
	global $_USER;
	delete("user_".$_USER["id"], "users");
	delete("user_".$_USER["id"]."_self", "users");
	$user = fetch(query("SELECT `id` FROM users WHERE phone = ?", "s", array($phone), "users_read"));
	if (count($user) == 0 || $user[0]["id"] == $_USER["id"]) {
		query("UPDATE users SET phone = ? WHERE id = ?", "si", array($phone, $_USER["id"]), "users_write");
		return true;
	} else
		return false;
}

function changeEmail($email) {
	global $_USER;
	delete("user_".$_USER["id"], "users");
	delete("user_".$_USER["id"]."_self", "users");
	$user = fetch(query("SELECT `id` FROM users WHERE email = ?", "s", array($email), "users_read"));
	if (count($user) == 0 || $user[0]["id"] == $_USER["id"]) {
		query("UPDATE users SET email = ? WHERE id = ?", "si", array($email, $_USER["id"]), "users_write");
		return true;
	} else
		return false;
}