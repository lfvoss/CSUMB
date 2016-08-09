<?php
	session_start();
	session_destroy();
	
	header("Location: streamflix_login.php");
?>