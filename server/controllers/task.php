<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 31/08/2017
 * Time: 11:48 AM
 */

require_once('../server/models/sessions.php');
require_once('../server/models/users.php');
require_once('../server/models/tasks.php');
require_once('../server/models/transactions.php');

// // // // // // // // // // // //
// Commission amount size (in %) //
// // // // // // // // // // // //
$_AMOUNT = 10;

function _middleware() {
	if (!isset($_COOKIE["s"]) || !validateSession($_COOKIE["s"])) errorThrower(119);
}
_middleware();

function getTaskByID($data) {
	global $_USER;
	$task = getTask($data["id"]);
	if (count($task) > 0) {
		$user = getByID($task[0]["owner_id"], false);
		$me = getByID($_USER["id"], false);
		responseThrower(array("task" => $task, "user" => $user, "role" => $me[0]["role"]));
		return;
	}
	errorThrower(120);
}

function executeTask($data) {
	global $_USER, $_AMOUNT;
	$task = getTask($data["task_id"])[0];
	if ($task["closed_at"] > 0) errorThrower(1338);
	closeTask($data["task_id"], $_USER["id"]);
	changeBalance($_USER["id"], $task["budget"]*(1 - $_AMOUNT/100));
	addTransaction($task["owner_id"], $_USER["id"], $task["id"], $task["budget"]*(1 - $_AMOUNT/100));
	responseThrower(array("success" => true));
}

function createTask($data) {
	global $_USER;
	$user = getByID($_USER["id"], true)[0];

	if ($user["balance"] < $data["budget"]) errorThrower(121);

	openTask($_USER["id"], $data["title"], $data["body"], $data["budget"]);
	$task_id = getLastInsertID("tasks_write");
	changeBalance($_USER["id"], -$data["budget"]);
	addTransaction($_USER["id"], 0, $task_id, $data["budget"]);
	responseThrower(array("task_id" => $task_id));
}