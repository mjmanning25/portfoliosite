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

				<form  action="./register.php?e=2" method="POST">

					<legend class="text-center">Register</legend>
					<p class="bg-info">Please fill in all boxes</p>


						<label class="col-md-3 control-label" for="uname">Username</label>

							<input id="uname" name="uname" type="text" placeholder="Username" class="form-control" value="<?php echo $_REQUEST['uname']; ?>">

						<label class="col-md-3 control-label" for="pword">Password</label>

							<input id="pword" name="pword" type="password" placeholder="Password" class="form-control" value="<?php echo $_REQUEST['pword']; ?>">


							<input type="submit">Sign Up</input>
						</div>
					</div>
				</fieldset>
			</form>
			<?php if ($error == 1) echo "\t\t<H4>Ooops.... Missing Username or Password</H4>\n"; ?>
			<?php if ($error == 2) echo "\t\t<H4>Ooops.... Missing First Name</H4>\n"; ?>
			<?php if ($error == 3) echo "\t\t<H4>Ooops.... Missing Last Name</H4>\n"; ?>
			<?php if ($error == 4) echo "\t\t<H4>Ooops.... Missing Bio</H4>\n"; ?>
			<?php if ($error == 5) echo "\t\t<H4>Ooops.... Missing Email</H4>\n"; ?>
			</div>
		</div>
	</div>
	</div>
<?php
	Bottom();
}

//*****************************************************************************
function xSignup(){
	if(empty($_REQUEST['uname']) or empty($_REQUEST['pword'])) Signup(1);
	elseif(empty($_REQUEST['fname'])) Signup(2);
	elseif(empty($_REQUEST['lname'])) Signup(3);
	elseif(empty($_REQUEST['bio'])) Signup(4);
	elseif(empty($_REQUEST['email'])) Signup(5);
	else{
		$alevel = 1;
		$sessionid = '';
		$uname = strtolower($_REQUEST['uname']);
		$pword = sha1($_REQUEST['pword']);
		$bio = addslashes($_REQUEST['bio']);
		$fname = $_REQUEST['fname'];
		$lname = $_REQUEST['lname'];
		$email = $_REQUEST['email'];
		$locked = 0;

		$sql = "INSERT INTO users SET ";
		$sql .= "alevel = ".$alevel.", ";
		$sql .= "sessionid = '".$sessionid."', ";
		$sql .= "uname = '".$uname."', ";
		$sql .= "pword = '".$pword."', ";
		$sql .= "bio = '".$bio."', ";
		$sql .= "fname = '".$fname."', ";
		$sql .= "lname = '".$lname."', ";
		$sql .= "email = '".$email."', ";
		$sql .= "locked = ".$locked.", ";
		$sql .= "cdate = now(), ";
		$sql .= "mdate = now();";
		mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));

		header("location: ./xsignup.php?i=3");
	}
}

	?>

				<form class="form-horizontal" action="./index.php" method="POST">
				<fieldset>
					<legend class="text-center">Sucess! Welcome to [TEST SITE]</legend>
					<p>You have successfully signed up!</p>
					<div class="form-group">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary btn-lg">Continue</button>
					</div>
					</div>
				</fieldset>
				</form>


}
