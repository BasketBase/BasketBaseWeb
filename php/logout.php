<?php
	session_destroy();

	if (isset($_COOKIE['user'])) {
	    unset($_COOKIE['user']);
	    setcookie('user', '', time() - 3600);
	}
?>