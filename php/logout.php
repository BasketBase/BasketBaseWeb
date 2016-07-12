<?php
	session_destroy();

	if (isset($_COOKIE['user'])) {
	    unset($_COOKIE['user']);
	    setcookie('user', null, -1, '/');
	}
?>