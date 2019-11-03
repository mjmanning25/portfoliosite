<?php
include "./xcommon.php";

if (empty($_REQUEST['i'])) $_REQUEST['i'] = '1';

switch($_REQUEST['i'])
{
	case '1':
		xSignup();
		break;
    default:
        xSignup();
}
//*****************************************************************************
function xSignup(){
	if(empty($_REQUEST['un']) or empty($_REQUEST['pw'])) header("./register.php?i=1");
	if ($_REQUEST['pw'] != $_REQUEST['pw2']) {
		header("./register.php?i=2");
	}
	else{
		$alevel = 1;
		$sessionid = '';
		$uname = strtolower($_REQUEST['un']);
		$pword = sha1($_REQUEST['pw']);

		$sql = "INSERT INTO users SET ";
		$sql .= "alevel = ".$alevel.", ";
		$sql .= "sessionid = '".$sessionid."', ";
		$sql .= "un = '".$uname."', ";
		$sql .= "pw = '".$pword."', ";
		$sql .= "cdate = now(), ";
		$sql .= "ldate = now();";
		mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));

		header("location: ./login.php");
	}
}
