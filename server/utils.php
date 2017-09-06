<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 7:46 PM
 */

include_once ('config.php');

function errorThrower($code) {
	global $_ERRORS;
	print json_encode(array("error" => array("error_code" => $code, "error_msg" => $_ERRORS[$code])), JSON_UNESCAPED_UNICODE);
	die();
}

function responseThrower($data) {
	print json_encode(array("response" => $data), JSON_UNESCAPED_UNICODE);
}

function encodePassword($plain) {
	return password_hash($plain, PASSWORD_BCRYPT, array('cost' => 12));
}

function checkPassword($plain, $hash) {
	return password_verify($plain, $hash);
}

function cookieSetter($cookie_name, $cookie_value) {
	setcookie($cookie_name, $cookie_value, time() + (86400 * 31 * 12), "/", ".tehcpu.ru", false, true);
}

function cookieRemover($cookie_name) {
	setcookie($cookie_name, null, 1, "/", ".tehcpu.ru", false, true);
}

function getClientIP() {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}