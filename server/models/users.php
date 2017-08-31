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
	if ($self) return fetch(query("SELECT `id`, `login`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `balance`, `role`, `bdate`, `registered_at` FROM users WHERE id=?", "i", array($id), "users_read"));
	return fetch(query("SELECT `id`, `login`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `role`, `bdate`, `registered_at` FROM users WHERE id=?", "i", array($id), "users_read"));
}

function getByIDs($ids) {
	$clause = implode(',', array_fill(0, count($ids), '?'));
	$types = implode('', array_fill(0, count($ids), 'i'));
	return fetch(query("SELECT `id`, `login`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `role`, `bdate`, `registered_at` FROM users WHERE `id` IN (" . $clause . ")", $types, $ids, "users_read"));
}

function logout() {
	deactivateSession($_COOKIE["s"]) ? responseThrower(array("success" => true)) : errorThrower(120);
}


function changeBalance($uid, $sum) {
	query("UPDATE users SET balance = balance + ? WHERE id=?", "ii", array($sum, $uid), "users_write");
	return true;
}