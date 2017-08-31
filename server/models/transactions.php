<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:55 PM
 */

function addTransaction($from, $to, $task_id, $sum) {
	query("INSERT INTO transactions (from_id, to_id, task_id, `sum`, created_at) VALUES (?, ?, ?, ?, ?)", "iiiii", array($from, $to, $task_id, $sum, time()), "transactions_write");
}

