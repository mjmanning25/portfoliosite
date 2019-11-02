<?php
include "./xcommon.php";

if (empty($_SESSION['cnt'])) $_SESSION['cnt'] = 0;

if (empty($_REQUEST['i'])) $_REQUEST['i'] = '1';

switch($_REQUEST['i'])
{
	case '1': //login
		xLogin($_REQUEST['un'], $_REQUEST['pw']);
		break;
	case '2': //logout
		xLogout();
		break;
	default:
		xLogin();
}

//*****************************************************************************
function xLogin($user, $pass){
	$_SESSION['cnt']++;

	if ($_SESSION['cnt'] < 5){

		if (empty($user) or empty($pass)){
			header("location: ./login.php?i=2"); // no data submitted
		}

		else{
			$pword = sha1($pass);

			$sql = "select * from testing.users where un='".$user."' and pw='".$pword."';";
			echo $sql;

			$result = mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));
			$row_users = mysqli_fetch_array($result);

			if (mysqli_num_rows($result) > 0){
				$_SESSION['alevel'] = $row_users['alevel'];
				$_SESSION['uid'] = $row_users['uid'];
                $_SESSION['username'] = $row_users['un'];
				$_SESSION['cnt'] = 0;
				header("location: ./index.php"); // success
			}

			else {
				header("location: ./login.php?i=2"); // wrong info
			}
		}
	}

	else {
  	header("location: ./login.php?i=2"); // too many attempts
	}
}

function xLogout(){
	// remove all session variables
	session_unset();
	// destroy the session
	session_destroy();
	header("location: ./login.php?i=1");
}
