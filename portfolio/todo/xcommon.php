<?php
	session_start();
	date_default_timezone_set('Pacific/Auckland');
	$GLOBALS['conn'] = mysqli_connect("localhost", "fred", "20Triangle", "testing");
	// error handler, remove the connect_error before release!!!
	if(!$GLOBALS['conn']){
		die("Connection failed: ".mysqli_connect_error());
	}

function security(){
	if (empty($_SESSION['alevel']) or ($_SESSION['alevel'] == 0)){
		header("location:./login.php?i=1");
	}

	if (empty($_SESSION['login']) or ($_SESSION['login'] == 0)){
		header("location:./login.php?i=1");
	}
}

function getAllUsers(){
    $q = "SELECT * FROM users;";
    $res = mysqli_query($GLOBALS['conn'], $q) or die(mysqli_error($GLOBALS['conn']));
    while ($u = mysqli_fetch_array($res)){
        $usr = $u['un'];
        echo "<li>- $usr</li>";
    }
}

function getUserName($x){
    $getuserquery = "SELECT * FROM users where uid=$x";
    $gur = mysqli_query($GLOBALS['conn'], $getuserquery) or die(mysqli_error($GLOBALS['conn']));

    while ($usr = mysqli_fetch_array($gur)){
        $usrname = $usr['un'];
    }
    return($usrname);
}

function getUserTags($x){
	$getuserquery = "SELECT DISTINCT tag FROM tasks where user='$x';";
	$gur = mysqli_query($GLOBALS['conn'], $getuserquery) or die(mysqli_error($GLOBALS['conn']));
	while ($usr = mysqli_fetch_array($gur)){
        $z = $usr['tag'];
		echo "<a class='button5' href='./index.php?tag=$z'>#$z</a>";
    }
	if (mysqli_num_rows($gur) == 0) {
		echo "<p>NO TAGS</p>";
	}
}
