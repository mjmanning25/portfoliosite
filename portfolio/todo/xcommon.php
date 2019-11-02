<?php
	session_start();
//if (empty($_SESSION['alevel']) or ($_SESSION['alevel'] == 0)) header("location:./login.php?i=2");
    date_default_timezone_set('Pacific/Auckland');
	$GLOBALS['conn'] = mysqli_connect("localhost", "fred", "20Triangle", "testing");
	// error handler, remove the connect_error before release!!!
	if(!$GLOBALS['conn']){
		die("Connection failed: ".mysqli_connect_error());
	}
