<?php
include "./xcommon.php";

security();

if (empty($_REQUEST['i'])) $_REQUEST['i'] = '1';
switch($_REQUEST['i'])
{
	case '1':
	Todo(0);
	break;
	case '2':
	xTodo();
	break;
	default:
	Todo(0);
}

function Todo($error){
	if ($error == 0)
	{
		$_REQUEST['title'] = "";
		$_REQUEST['description'] = "";
		$_REQUEST['priority'] = "";
		$_REQUEST['tag'] = "";
	}
	?>

	<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Tag-Do - Add New</title>
		<link rel="stylesheet" type="text/css" href="./help.css">
	</head>
	<body>
		<div id="main">
			<div id="quote">
				<form action="./todo.php?i=2" method="POST" id='asdf'>
					<h1>Tag-Do - Add New Task</h1>
					<p>Please fill in all boxes below</p>
					<input name="title" type="text" placeholder="Title" value="<?php echo $_REQUEST['title']; ?>">
					<textarea name="description" form="asdf" placeholder="Description..."></textarea>
					<p>Priority:</p>
					<select name="priority">
					  <option value="3">High</option>
					  <option value="2">Medium</option>
					  <option value="1">Low</option>
					</select>
					<input name="tag" type="text" placeholder="Tag here" value="<?php echo $_REQUEST['tag']; ?>">
					<input type="submit" name="submit" value="Add Task">
				</form>
				<hr>
				<form  action="./index.php" method="post">
					<input type="submit" name="submit" value="Back To Task List">
				</form>
				<?php
				if ($error == 1) echo "\t\t<H4>Ooops.... Missing Title</H4>\n";
				if ($error == 2) echo "\t\t<H4>Ooops.... Missing Content</H4>\n";
				if ($error == 3) echo "\t\t<H4>Ooops.... Missing Priority</H4>\n";
				if ($error == 4) echo "\t\t<H4>Ooops.... Missing Tag</H4>\n";

				echo "</div></div></body>";
				echo "</html>";
			}

			//*****************************************************************************
			function xTodo(){
				if(empty($_REQUEST['title'])) Todo(1);
				elseif(empty($_REQUEST['description'])) Todo(2);
				elseif(empty($_REQUEST['priority'])) Todo(3);
				elseif(empty($_REQUEST['tag'])) Todo(4);
				else{
					$title = $_REQUEST['title'];
					$text = $_REQUEST['description'];
					$priority = $_REQUEST['priority'];
					$t = $_REQUEST["tag"];
					$hide = 0;

					$sql = "INSERT INTO tasks SET ";
					$sql .= "user = '".$_SESSION['uid']."', ";
					$sql .= "title = '".$title."', ";
					$sql .= "description = '".$text."', ";
					$sql .= "date = now(), ";
					$sql .= "hide = ".$hide.", ";
					$sql .= "tag = '".$t."', ";
					$sql .= "priority = ".$priority.";";
					mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));

					header("location: ./index.php");
				}
			}
