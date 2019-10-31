<?php
include "./xcommon.php";

// get the id from the previous page to use here
$id = $_REQUEST['id'];

// switch is used to sort items in the page
if (empty($_REQUEST['i'])) $_REQUEST['i'] = '1';
switch($_REQUEST['i'])
{
  case '1':
  // sort by id lowest to highest
  $query = "select * from Pathway where ProgrammeID=$id order by PathwayID desc;";
  $results = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));
  break;
  case '2':
  // sort by id highest to lowest
  $query = "select * from Pathway where ProgrammeID=$id order by PathwayID asc;";
  $results = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));
  break;
  case '3':
  // sort by name a-z
  $query = "select * from Pathway where ProgrammeID=$id order by PathwayName desc;";
  $results = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));
  break;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Classes in Cybersecurity</title>
  <link rel="stylesheet" href="./pathways.css">
</head>
<body>
  <nav>
    <ul>
      <li><a href="https://www.unitec.ac.nz/" target="_blank">Unitec</a></li>
      <li><a href="index.php" target="_blank">Pathway Planner</a></li>
    </ul>
  </nav>

  <p>Sort by: | <a href='./pathways.php?i=1&id=<?php echo $id ?>'>Class ID</a> | <a href='./pathways.php?i=2&id=<?php echo $id ?>'>Class Name</a> | <a href='./pathways.php?i=3&id=<?php echo $id ?>'>Year</a></p>

  <?php

  // use the id that is parsed to this page to determine the title of the programme
  // then set the variable PTitle to be the right rewsult, making this page modular
  $gettitle = "select * from Programme where ProgrammeID=$id";
  $titleresult = mysqli_query($GLOBALS['conn'], $gettitle) or die(mysqli_error($GLOBALS['conn']));

  // bad logic but currently only 1 needs to be selected
  while ($mytitle = mysqli_fetch_array($titleresult))
  {
    $PTitle = $mytitle['ProgrammeName'];

    // start formatting the page and print the title
    echo "<h1>".$PTitle."</h1>";
  }

  while ($PathwayResults = mysqli_fetch_array($results))
  {
    $PWID = $PathwayResults['PathwayID'];
    $PWName = $PathwayResults['PathwayName'];

    // segment each pathway into  its own box
    echo "<div>";

    // display each pathway
    echo "<h2>Name: ".$PWName."</h2>";
    echo "<h3>ID: ".$PWID."</h3>";

    //create a link to the next page, parsing the pathwayID
    echo "<a href='./courses.php?id=".$PWID."'>Click me</a>";

    // close the block
    echo "</div>";

    // added a line
    echo "<hr>";
  }

  ?>

</body>
</html>
