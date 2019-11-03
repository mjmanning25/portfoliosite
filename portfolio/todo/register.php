<?php

if (empty($_REQUEST['i'])) $_REQUEST['i'] = '1';

switch($_REQUEST['i'])
{
	case '1':
		Signup(0);
		break;
	case '2':
		Signup(1);
		break;
	case '2':
		Signup(2);
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
        <form action="./xregister.php?i=2" method="post">
            <input autofocus type="text" name="un" placeholder="Username" value="<?php echo $_REQUEST['un']; ?>">
            <input type="password" name="pw" placeholder="Password" value="<?php echo $_REQUEST['pw']; ?>">
			<input type="password" name="pw2" placeholder="Verify Password" value="<?php echo $_REQUEST['pw2']; ?>">
            <input type="submit" name="submit" value="Sign Up">
			<p>Already a member? | Click <a href="./login.php">here</a> to Login</p>
        </form>
	<?php
    if ($error == 1) echo "<p>Ooops.... Missing Username or Password</p>";
	if ($error == 2) echo "<p>Ooops.... Make sure your passwords match!</p>";
}
