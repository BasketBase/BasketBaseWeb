<?php
	session_destroy();

	if (isset($_COOKIE['user'])) {
	    unset($_COOKIE['user']);
	    unset($_COOKIE['showable']);
	    setcookie('user', null, -1, '/');
	    setcookie('showable', null, -1, '/');
	}
?>