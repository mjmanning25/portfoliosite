<?php
include "./xcommon.php";

// get the id from the previous page to use here
$id = $_REQUEST['id'];

// get all courses that match the id of the selected pathway
$query1 = "select * from Course where PathwayID=$id;";

// display Compulsory classes of all courses
$query2 = "select * from Course where Compulsory='Y';";

//
$results1 = mysqli_query($GLOBALS['conn'], $query1) or die(mysqli_error($GLOBALS['conn']));;
$results2 = mysqli_query($GLOBALS['conn'], $query2) or die(mysqli_error($GLOBALS['conn']));;

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Course List</title>
  <link rel="stylesheet" href="./courses.css">
</head>
<body>
  <nav>
    <ul>
      <li><a href="https://www.unitec.ac.nz/" target="_blank">Unitec</a></li>
      <li><a href="index.php" target="_blank">Pathway Planner</a></li>
    </ul>
  </nav>

  <h1>COMPULSORY CLASSES</h1>

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

  // display the Compulsory courses first, this has to be its own loop, will need to be updated
  // when the database is updated, so the querry looks for the right data
  while ($CourseResults = mysqli_fetch_array($results2))
  {
    $CID = $CourseResults['CourseID'];
    $CC = $CourseResults['CourseCode'];
    $CName = $CourseResults['CourseName'];
    $level = $CourseResults['Level'];
    $Requisite = $CourseResults['PreRequisite'];
    $CRequisite = $CourseResults['CoRequisite'];
    $Compulsory = $CourseResults['Compulsory'];
    $Credits = $CourseResults['Credits'];

    // segment each course into  its own box

    // NOTE TO DEVS:
    // ECHO IS WHERE YOU CAN DO THE STYLING
    // You can change the order of things as long as you keep them in the blocks
    // that they are in currently

    echo "<div>";

    // display each courses info
    echo "<h2>Course name: ".$CName."</h2>";
    echo "<h2>Course level: ".$level."</h2>";
    echo "<h2>Course Code: ".$CC."</h2>";

    // if the class has no PreRequisite's then print NONE, otherwise print the correct data
    if ($Requisite == NULL) {
      echo "<h2>PreRequisite: None</h2>";
    }else {
      echo "<h2>PreRequisite: ".$Requisite."</h2>";
    }

    // if the class has no CoRequisite's then print NONE, otherwise print the correct data
    if ($CRequisite == NULL) {
      echo "<h2>CoRequisite: None</h2>";
    }else {
      echo "<h2>CoRequisite: ".$CRequisite."</h2>";
    }

    // if the class is compulsory display a yes, if not, display a no
    if ($Compulsory == "Y") {
      echo "<h2>Compulsory: Yes</h2>";
    } else {
      echo "<h2>Compulsory: No</h2>";
    }

    // display the course credits
    echo "<h2>Credits: ".$Credits."</h2>";

    // display a link to the correct class information
    echo "<a href='./classes.php?id=$CID'>Click Me</a>";

    // close the block
    echo "</div>";

    // ruler for seperation
    echo "<hr>";
  }

// BR and Title below to seperate the two blocks
?>

<br>

<h1>CLASSES IN PATHWAY</h1>
<h3>WIP untill database is updated</h3>
<hr>

<br>

<?php
  // bulk logic, these are the fields from the database
  // this displays every class in the pathway, which will be needed until the database is updated
  while ($CourseResults = mysqli_fetch_array($results1))
  {
    // get data from the databaseS
    $CID = $CourseResults['CourseID'];
    $CC = $CourseResults['CourseCode'];
    $CName = $CourseResults['CourseName'];
    $level = $CourseResults['Level'];
    $PWID = $CourseResults['PathwayID'];
    $Requisite = $CourseResults['PreRequisite'];
    $CRequisite = $CourseResults['CoRequisite'];
    $Compulsory = $CourseResults['Compulsory'];
    $Credits = $CourseResults['Credits'];

    // segment each course into  its own box

    // NOTE TO DEVS:
    // ECHO IS WHERE YOU CAN DO THE STYLING
    // You can change the order of things as long as you keep them in the blocks
    // that they are in currently

    echo "<div>";

    // display each courses info
    echo "<h2>Course name: ".$CName."</h2>";
    echo "<h2>Course level: ".$level."</h2>";
    echo "<h2>Course Code: ".$CC."</h2>";
    echo "<h2>In pathway: ".$PWID."</h2>";

    // if the class has no PreRequisite's then print NONE, otherwise print the correct data
    if ($Requisite == NULL) {
      echo "<h2>PreRequisite: None</h2>";
    }else {
      echo "<h2>PreRequisite: ".$Requisite."</h2>";
    }

    // if the class has no CoRequisite's then print NONE, otherwise print the correct data
    if ($CRequisite == NULL) {
      echo "<h2>CoRequisite: None</h2>";
    }else {
      echo "<h2>CoRequisite: ".$CRequisite."</h2>";
    }

    // if the class is compulsory display a yes, if not, display a no
    if ($Compulsory == "Y") {
      echo "<h2>Compulsory: Yes</h2>";
    } else {
      echo "<h2>Compulsory: No</h2>";
    }

    // display the course credits
    echo "<h2>Credits: ".$Credits."</h2>";

    // display a link to the correct class information
    echo "<a href='./classes.php?id=$CID'>Click Me</a>";

    // close the block
    echo "</div>";

    // ruler for seperation
    echo "<hr>";
}

  ?>

  </body>
  </html>
