<?php
include_once ('config.php');

$Instances = array();

function getCacheInstance($scope) {
	global $_CONFIG;
	global $Instances;

	if (array_key_exists($scope, $Instances)) {
		return $Instances[$scope];
	} else {
		if (!array_key_exists($scope, $_CONFIG["CACHE"]))
			errorThrower(126);
		$mCredentials = $_CONFIG["CACHE"][$scope];
		$redis = new Redis();
		$redis->connect($mCredentials["host"], $mCredentials["port"]);
		$Instances[$scope] = $redis;
		return $redis;
	}
}

function set($key, $value, $scope) {
	$instance = getCacheInstance($scope);
	$instance->set($key, $value);
}

function get($key, $scope) {
	$instance = getCacheInstance($scope);
	return $instance->get($key);
}

function delete($key, $scope) {
	$instance = getCacheInstance($scope);
	$instance->delete($key);
}