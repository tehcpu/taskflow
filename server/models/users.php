<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:55 PM
 */

include ('./db.php');

$scope = "users";

function getByID($id) {
	echo $id;
	if ($stmt = mysqli_prepare(getInstance("users_read"), 'SELECT * FROM users WHERE id=?')) {
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $id, $login, $firstname, $middlename, $lastname, $email, $phone, $password, $balance, $role, $bdate, $regdate);
		mysqli_stmt_fetch($stmt);
		// for
	}
}