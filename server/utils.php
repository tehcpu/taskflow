<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 7:46 PM
 */

include ('config.php');

function errorThrower($code) {
	global $_ERRORS;
	print json_encode(array("error" => array("error_code" => $code, "error_msg" => $_ERRORS[$code])), JSON_UNESCAPED_UNICODE);
	die();
}

function responseThrower($data) {
	print json_encode(array("response" => array($data)), JSON_UNESCAPED_UNICODE);
}