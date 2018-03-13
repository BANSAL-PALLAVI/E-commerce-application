<?php
	session_start();
	$_SESSION['authentication']= 0;
	header("Location: newhome.php");
?>
