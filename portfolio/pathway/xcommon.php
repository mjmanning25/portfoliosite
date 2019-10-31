<?php
	session_start();
// Basic security
//if (empty($_SESSION['alevel']) or ($_SESSION['alevel'] == 0)) header("location:./index.php?i=2");
    date_default_timezone_set('Pacific/Auckland');

	$GLOBALS['conn'] = mysqli_connect("localhost", "fred", "20Triangle", "testing") or die("Connection Failed");
	// error handler, remove the connect_error before release!!!
