<?php
include "./xcommon.php";

if (empty($_REQUEST['i'])) $_REQUEST['i'] = '1';

switch($_REQUEST['i'])
{
	case '1':
		Signup(0);
		break;
	case '2':
		xSignup();
		break;

	default:
		Signup(0);
}

//*****************************************************************************
function Signup($error){

	if ($error == 0)
	{
		$_REQUEST['un'] = "";
		$_REQUEST['pw'] = "";
	}
?>
<html lang="en-US">
<head>
  <meta charset="utf-8">
    <title>Register - Tag-Do</title>
    <link rel="stylesheet" type="text/css" href="help.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">

</head>
  <body>
  <div id="main">
    <h1>Tag-Do Register</h1>
    <p>Please register to continue</p>

      <div id="quote">
        <form action="./register.php?i=2" method="post">
            <input autofocus type="text" name="un" placeholder="Username" value="<?php echo $_REQUEST['un']; ?>">
            <input type="password" name="pw" placeholder="Password" value="<?php echo $_REQUEST['pw']; ?>">
			<input type="password" name="pw2" placeholder="Verify Password" value="<?php echo $_REQUEST['pw2']; ?>">
            <input type="submit" name="submit" value="Sign Up">
			<p>Already a memeber? | Click <a href="./login.php">here</a> to Login</p>
        </form>
	<?php
    if ($error == 1) echo "<p>Ooops.... Missing Username or Password</p>";
	if ($error == 2) echo "<p>Ooops.... Make sure your passwords match!</p>";
}

//*****************************************************************************
function xSignup(){
	if(empty($_REQUEST['un']) or empty($_REQUEST['pw'])) Signup(1);
	if ($_REQUEST['pw'] != $_REQUEST['pw2']) {
		Signup(2);
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
