<?php

	unset($_SESSION);
	setCookie("id", session_cache_expire() ,time()-86400);
	unset($_COOKIE);
	session_destroy();
	header ('Location: index.php');

?>