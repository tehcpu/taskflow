<?php
/**
 * Created by PhpStorm.
 * User: tehcpu
 * Date: 21/08/2017
 * Time: 6:55 PM
 */

function _middleware() {
	if (!isset($_COOKIE["s"]) || !validateSession($_COOKIE["s"])) errorThrower(119);
}
_middleware();