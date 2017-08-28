<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:56 PM
 */

$_CONFIG["DB"] = array(
	"users_write" => array(
		"host" => "127.0.0.1",
		"user" => "taskuser",
		"password" => "0C}^kqo^uBz10nw$",
		"name" => "taskflow"
	),
	"users_read" => array(
		"host" => "127.0.0.1",
		"user" => "taskuser",
		"password" => "0C}^kqo^uBz10nw$",
		"name" => "taskflow"
	),
	"sessions_write" => array(
		"host" => "127.0.0.1",
		"user" => "taskuser",
		"password" => "0C}^kqo^uBz10nw$",
		"name" => "taskflow"
	),
	"sessions_read" => array(
		"host" => "127.0.0.1",
		"user" => "taskuser",
		"password" => "0C}^kqo^uBz10nw$",
		"name" => "taskflow"
	),
	"tasks_write" => array(
		"host" => "127.0.0.1",
		"user" => "taskuser",
		"password" => "0C}^kqo^uBz10nw$",
		"name" => "taskflow"
	),
	"tasks_read" => array(
		"host" => "127.0.0.1",
		"user" => "taskuser",
		"password" => "0C}^kqo^uBz10nw$",
		"name" => "taskflow"
	),
);

$_CONFIG["SECURE"] = array("salt" => "uBz10nw");

$_ERRORS = array(
	100 => "The API method must be specified",
	101 => "Invalid method",
	102 => "Invalid scope. Can't connect to DB. Possible reason: invalid config.",
	103 => "Valid scope, but it's still impossible to connect to the database. Possible reason: wrong config credentials or host is down.",
	104 => "User ID must be defined",
	105 => "Something went wrong [invalid query?]",
	106 => "Can't find users with such ID",
	107 => "Registration failure: not all required fields are filled in",
	108 => "This login is already in use",
	109 => "Registration failure *",
	110 => "Fill all fields",
	111 => "Auth error: no user with such login",
	112 => "Auth error: wrong password",
	113 => "Session initialization error",
	114 => "User already has a valid session.. Redirecting to index-page..",
	115 => "Invalid session passed",
	116 => "Session with such ID is not found",
	117 => "Session has expired",
	118 => "Session has deactivated",
	119 => "API Request error: your session is invalid. Please, login to exiting account or register new one [redirect]",
	120 => "Logout failure",
	121 => "Task addition failure"
);