<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:56 PM
 */

include_once ('config.php');

$Instances = array();

function getInstance($scope) {
	global $_CONFIG;
	global $Instances;

	if (array_key_exists($scope, $Instances)) {
		return $Instances[$scope];
	} else {
		if (!array_key_exists($scope, $_CONFIG["DB"]))
			errorThrower(102);
		$mCredentials = $_CONFIG["DB"][$scope];
		$mConnection = mysqli_connect($mCredentials["host"], $mCredentials["user"], $mCredentials["password"], $mCredentials["name"]);
		if (!$mConnection)
			errorThrower(103);
		mysqli_set_charset($mConnection, "utf8");
		$Instances[$scope] = $mConnection;
		return $mConnection;
	}
}

function query($sql, $types, $params, $scope) {
	$instance = getInstance($scope);
	array_unshift($params, $types);
	if ($stmt = mysqli_prepare($instance, $sql)) {
		call_user_func_array(array($stmt, 'bind_param'), ref($params));
		mysqli_stmt_execute($stmt);
		return $stmt;
	} else {
		errorThrower(105);
	}
}

function fetch($stmt) {
	$result = mysqli_stmt_get_result($stmt);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getLastInsertID($scope) {
	return mysqli_insert_id(getInstance($scope));
}

function ref($arr){
	$refs = array();
	foreach($arr as $key => $value)
		$refs[$key] = &$arr[$key];
	return $refs;
}