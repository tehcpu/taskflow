<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:55 PM
 */

include_once('../server/db.php');

function getTask($id) {
	$data = json_decode(get('task_'.$id, "tasks"), true);
	if (!$data) {
		$data = fetch(query("SELECT * FROM tasks WHERE id=?", "i", array($id), "tasks_read"));
		set("task_".$id, json_encode($data[0], JSON_UNESCAPED_UNICODE), "tasks");
		return $data[0];
	}
	return $data;
}

function getTasks($last_id) {
	$data = json_decode(get('feed_'.$last_id, "feed"), true);
	if (!$data) {
		$condition = "";
		$types = "i";
		$params = array(20);
		if ($last_id > 0) {
			$condition = "AND id < ?";
			$types = "ii";
			array_unshift($params, $last_id);
		}
		$data = fetch(query("SELECT * FROM tasks WHERE executor_id IS NULL " . $condition . " ORDER BY id DESC LIMIT ?", $types, $params, "tasks_read"));
		// cache this sequence
		$cacheIDS = array();
		foreach ($data as $task) {
			set("task_".$task["id"], json_encode($task, JSON_UNESCAPED_UNICODE), "tasks");
			array_push($cacheIDS, $task["id"]);
		}
		set("feed_".$last_id, json_encode($cacheIDS, JSON_UNESCAPED_UNICODE), "feed");
		return $data;
	} else {
		$tasks = array();
		$closed_tasks = 0;
		foreach ($data as $task_id) {
			$task = json_decode(get("task_".$task_id, "tasks"), true);
			if (!$task) {
				$task = getTask($task_id);
				(!$task["executor_id"]) ? array_push($tasks, $task) : $closed_tasks++;
			} else {
				(!$task["executor_id"]) ? array_push($tasks, $task) : $closed_tasks++;
			}
		}
		if (ceil(count($tasks)/2) <= $closed_tasks) {
			// этот кэш протух, завозите новый (маловероятный исход, но будет неприятно, если не захандлить)
			delete("feed_".$last_id, "feed");
			getTask($last_id);
		}
		return $tasks;
	}
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
	delete("feed_0", "feed");
	delete("user_".$id, "users");
	delete("user_".$id."_self", "users");
	query("UPDATE tasks SET executor_id=?, closed_at=? WHERE id=?", "iii", array($user_id, time(), $id), "tasks_write");
	return true;
}

function openTask($owner_id, $title, $body, $budget) {
	query("INSERT INTO tasks (owner_id, title, body, budget, created_at) VALUES (?, ?, ?, ?, ?)", "issii", array($owner_id, $title, $body, $budget, time()), "tasks_write");
	delete("feed_0", "feed");
	delete("user_".$owner_id, "users");
	delete("user_".$owner_id."_self", "users");
	return true;
}