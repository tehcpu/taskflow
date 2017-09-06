<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:55 PM
 */

function addTransaction($from, $to, $task_id, $sum) {
	query("INSERT INTO transactions (from_id, to_id, task_id, `sum`, created_at) VALUES (?, ?, ?, ?, ?)", "iiiii", array($from, $to, $task_id, $sum, time()), "transactions_write");
}

function getList($last_id) {
	global $_USER;
	$condition = "";
	$types = "ii";
	$params = array($_USER["id"], $_USER["id"]);
	if ($last_id > 0) {
		$condition = "id < ? AND";
		$types = "iii";
		array_unshift($params, $last_id);
	}
	return fetch(query("SELECT * FROM transactions WHERE ".$condition." (from_id = ? OR to_id = ?) ORDER BY id DESC LIMIT 40", $types, $params, "transactions_read"));
}