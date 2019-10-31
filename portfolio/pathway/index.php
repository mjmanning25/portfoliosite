<?php
include "./xcommon.php";

// get data
$ProgrammeQuery = "SELECT * FROM Programme order by ProgrammeName ASC;";
$ProgrammeResults = mysqli_query($GLOBALS['conn'], $ProgrammeQuery) or die(mysqli_error($GLOBALS['conn']));

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Pathway Planner</title>
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <nav>
    <ul>
      <li><a href="https://www.unitec.ac.nz/" target="_blank">Unitec</a></li>
      <li><a href="#">Information</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </nav>

  <h1>Pathway Planner</h1>
  <h2>Select Your Study Options</h2>
  <ul class="courseSelections">
    <?php

    // for every degree we have in the database, print
    while ($programmes = mysqli_fetch_array($ProgrammeResults))
    {
      $ID = $programmes['ProgrammeID'];
      $Name = $programmes['ProgrammeName'];

      echo "<li>$ID - $Name: <a href='pathways.php?i=1&id=$ID'>Click Me</a></li>";
    }
    ?>

</ul>
</body>
</html>
<?php
