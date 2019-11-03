<?php
if (empty($_REQUEST['i'])) $_REQUEST['i'] = '1';

switch($_REQUEST['i'])
{
	case '1': //login attempt
		Login(1);
		break;
	case '2': // error wrong info
		Login(2);
		break;
	case '3': // too many attempts
		Login(3);
		break;
	default:
		Login(1); // login attempt
}

function Login($error){
 ?>

<html lang="en-US">
<head>
  <meta charset="utf-8">
    <title>Login - Tag-Do</title>
    <link rel="stylesheet" type="text/css" href="help.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">

</head>
  <body>
  <div id="main">
    <h1>Tag-Do Login</h1>
    <p>Please login to continue</p>

      <div id="quote">
        <form action="./xlogin.php?i=1" method="post">
            <input autofocus type="text" name="un" placeholder="Username">
            <input type="password" name="pw" placeholder="Password">
            <input type="submit" name="submit" value="Login">
            <p>Not a member? | Click <a href="./register.php">here</a> to Register</p>
        </form>
    <?php
    if($error == 2){
      echo "<p>Please check your login details.</p>";
    }elseif ($error == 3) {
      echo "<p>You have been logged out.</p>";
    }
    ?>
        </div>
    </div>
</body>
<?php
}
