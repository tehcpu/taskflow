<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:55 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'].'/../server/db.php');

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


function getTask($id) {
	return fetch(query("SELECT * FROM tasks WHERE id=?", "i", array($id), "tasks_read"));
}

function getTasks($last_id) {
	$condition = "";
	$types = "i";
	$params = array(20);
	if ($last_id > 0) {
		$condition = "AND id < ?";
		$types = "ii";
		array_unshift($params, $last_id);
	}
	return fetch(query("SELECT * FROM tasks WHERE executor_id IS NULL ".$condition." ORDER BY id DESC LIMIT ?", $types, $params, "tasks_read"));
}

function getMyTasks($last_id) {
	global $_USER;
	$condition = "";
	$types = "ii";
	$params = array($_USER["id"], $_USER["id"]);
	if ($last_id > 0) {
		$condition = "id < ? AND";
		$types = "iii";
		array_unshift($params, $last_id);
	}
	return fetch(query("SELECT * FROM tasks WHERE ".$condition." (executor_id = ? OR owner_id = ?) ORDER BY id DESC LIMIT 20", $types, $params, "tasks_read"));
}

function getUserTasks($last_id, $user_id) {
	$condition = "";
	$types = "ii";
	$params = array($user_id, $user_id);
	if ($last_id > 0) {
		$condition = "id < ? AND";
		$types = "iii";
		array_unshift($params, $last_id);
	}
	return fetch(query("SELECT * FROM tasks WHERE ".$condition." (executor_id = ? OR owner_id = ?) ORDER BY id DESC LIMIT 20", $types, $params, "tasks_read"));
}

function closeTask($id, $user_id) {
	query("UPDATE tasks SET executor_id=?, closed_at=? WHERE id=?", "iii", array($user_id, time(), $id), "tasks_write");
	return true;
}

function openTask($owner_id, $title, $body, $budget) {
	query("INSERT INTO tasks (owner_id, title, body, budget, created_at) VALUES (?, ?, ?, ?, ?)", "issii", array($owner_id, $title, $body, $budget, time()), "tasks_write");
	return true;
}