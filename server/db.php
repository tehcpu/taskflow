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

function resultHelper($stmt) {
	mysqli_stmt_execute($stmt);
	$res = mysqli_stmt_get_result($stmt);
	if (is_bool($res)) return $res;
	return mysqli_fetch_all($res, MYSQLI_ASSOC);
}