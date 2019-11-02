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
	<form action="./register.php?i=2" method="POST">
		<h1>Register</h1>
		<p>Please fill in all boxes</p>
		<label>Username</label>
		<input id="uname" name="un" type="text" placeholder="Username" value="<?php echo $_REQUEST['un']; ?>">
		<label>Password</label>
		<input id="pword" name="pw" type="password" placeholder="Password" value="<?php echo $_REQUEST['pw']; ?>">
		<input type="submit">Sign Up</input>
	</form>
	<?php
    if ($error == 1) echo "\t\t<H4>Ooops.... Missing Username or Password</H4>\n"; ?>
<?php
}

//*****************************************************************************
function xSignup(){
	if(empty($_REQUEST['un']) or empty($_REQUEST['pw'])) Signup(1);
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
