<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 30/08/2017
 * Time: 12:38 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/../server/models/sessions.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../server/models/users.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../server/models/tasks.php');

function _middleware() {
	if (!isset($_COOKIE["s"]) || !validateSession($_COOKIE["s"])) errorThrower(119);
}
_middleware();

function getFeed($data) {
	$last_id = 0;
	if (isset($data["last_id"]) && $data["last_id"] > 0) $last_id = $data["last_id"];
	$tasks = getTasks($last_id);
	if (count($tasks) == 0) {
		responseThrower(array("tasks" => $tasks, "profiles" => array()));
		return;
	}
	$profilesID = array();
	foreach ($tasks as $task) {
		array_push($profilesID, $task["owner_id"]);
	}
	$profiles = getByIDs($profilesID);
	responseThrower(array("tasks" => $tasks, "profiles" => $profiles));
}

function getMyFeed($data) {
	$last_id = 0;
	if (isset($data["last_id"]) && $data["last_id"] > 0) $last_id = $data["last_id"];
	$tasks = getMyTasks($last_id);
	if (count($tasks) == 0) {
		responseThrower(array("tasks" => $tasks, "profiles" => array()));
		return;
	}
	$profilesID = array();
	foreach ($tasks as $task) {
		array_push($profilesID, $task["owner_id"]);
	}
	$profiles = getByIDs($profilesID);
	responseThrower(array("tasks" => $tasks, "profiles" => $profiles));
}

function getUserFeed($data) {
	$last_id = 0;
	if (isset($data["last_id"]) && $data["last_id"] > 0) $last_id = $data["last_id"];
	$tasks = getUserTasks($last_id, $data["user_id"]);
	if (count($tasks) == 0) {
		responseThrower(array("tasks" => $tasks, "profiles" => array()));
		return;
	}
	$profilesID = array();
	foreach ($tasks as $task) {
		array_push($profilesID, $task["owner_id"]);
	}
	$profiles = getByIDs($profilesID);
	responseThrower(array("tasks" => $tasks, "profiles" => $profiles));
}