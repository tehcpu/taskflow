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

function add($data) {
	global $_USER;
	if ($stmt = mysqli_prepare(getInstance("tasks_write"), 'INSERT INTO tasks (owner_id, title, body, budget, created_at) VALUES (?, ?, ?, ?, ?)')) {
		$time = time();
		mysqli_stmt_bind_param($stmt, "issii", $_USER["id"], $data["title"], $data["body"], $data["budget"], $time);
		resultHelper($stmt);
		$task_id = mysqli_insert_id(getInstance("tasks_write"));
		if ($task_id > 0) {
			responseThrower(array("success" => true, "task_id" => $task_id));
		} else {
			errorThrower(121);
		}
	} else {
		errorThrower(105);
	}
}