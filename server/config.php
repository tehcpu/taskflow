<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:56 PM
 */

$_CONFIG["DB"] = array("users_write" =>
									array("host" => "127.0.0.1",
										"user" => "taskuser",
										"password" => "0C}^kqo^uBz10nw$",
										"name" => "taskflow"),
								"users_read" =>
									array("host" => "127.0.0.1",
										"user" => "taskuser",
										"password" => "0C}^kqo^uBz10nw$",
										"name" => "taskflow"),
								);

$_ERRORS = array(	100 => "The API method must be specified",
						101 => "Invalid method",
						102 => "Invalid scope. Can't connect to DB. Possible reason: invalid config.",
						103 => "Valid scope, but it's still impossible to connect to the database. Possible reason: wrong config credentials or host is down.",
						104 => "User ID must be defined",
						105 => "Something went wrong",
						106 => "Can't find users with such ID",
						107 => "Registration failure: not all required fields are filled in",
						108 => "This phone number is already in use",
						109 => "This email is already in use",
						110 => "This login is already in use");