<?php
include "./xcommon.php";

if (empty($_REQUEST['i'])) $_REQUEST['i'] = '1';
switch($_REQUEST['i'])
{
  case '1':
  index();
  break;
  case '2':
  // parse the record id into the function
  xindex($_REQUEST['s']);
  break;
  default:
  index();
}

function index(){
  if (empty($_REQUEST['tag'])){
    $query = "SELECT * FROM tasks order by priority DESC, date DESC;";
  }

  else {
    $t = $_REQUEST['tag'];
    $query = "SELECT * FROM tasks where tag like '$t' order by priority DESC, date DESC;";
  }
  // get the list of non-hidden tasks
  $results = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));
  ?>

  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./help.css">
    <title>Index</title>
  </head>

  <body>
    <div id="main">
      <h1>IN DEVELOPMENT!</h1>
      <small>Feel free to explore, but if you found this on accident please be nice. This is a test project!</small>
      <br>
      <div id="quote">
        <h2>WIP FEATURES</h2>
        <div id="task">
          <ul>
            <li>- Add tag system</li>
            <li>- Add undo feature</li>
            <li>- Add delete button to finished tasks</li>
            <li>- Add search bar for tasks</li>
            <li>- Add user logins with independant tasks</li>
            <li>- Remove filler tasks</li>
          </ul>
        </div>
      </div>
      <div id="quote">
        <form method="post" action="index.php?tag=<?php echo $t?>">
        <a href="./todo.php"><h2>To do list - click me to add a new one</h2></a>
        <p>To clear your search: clear this box and press ENTER.</p>
        <p>This is a WIP feature, please be nice.</p>
	      <input type="text" placeholder="<?php echo $t ?>" name="tag">
        <input type="submit" name="submit" value="Search">
        </form>
      </div>
      <div id="quote">
        <h2>To Be Completed</h2>
        <ul>
          <?php

          //if there is a result, print it
          while ($row_users = mysqli_fetch_array($results))
          {
            $uid = $row_users['uid'];
            $title = $row_users['title'];
            $text = $row_users['description'];
            $date = $row_users['date'];
            $hide = $row_users['hide'];
            $tag = $row_users['tag'];
            $priority = $row_users['priority'];
          ?>

            <?php //if the result is not hidden

            if ($hide != 1) {
              // if high priority
              if ($priority == 2) {?>
                <div id="taskhigh">
                  <h3><?php echo $title ?></h3>
                  <?php if (empty($tag)) {
                    echo "<h2>NO TAG DATA</h2>";
                  }else{
                    echo "<h2>$tag</h2>";
                  }?>
                  <li><p><?php echo $text; ?></p></li>
                  <a href=<?php echo "./index.php?i=2&s=".$uid ?>>Done</a>
                </div>
                <?}
                //if medium priority
                 elseif ($priority == 1) {?>
                  <div id="taskmed">
                    <h3><?php echo $title ?></h3>
                    <?php if (empty($tag)) {
                      echo "<h2>NO TAG DATA</h2>";
                    }else{
                      echo "<h2>$tag</h2>";
                    }?>
                    <li><p><?php echo $text; ?></p></li>
                    <a href=<?php echo "./index.php?i=2&s=".$uid ?>>Done</a>
                  </div>
                  <?php
                }
                // for everything else
                else {?>
                  <div id="tasklow">
                    <h3><?php echo $title ?></h3>
                    <?php if (empty($tag)) {
                      echo "<h2>NO TAG DATA</h2>";
                    }else{
                      echo "<h2>$tag</h2>";
                    }?>
                    <li><p><?php echo $text; ?></p></li>
                    <a href=<?php echo "./index.php?i=2&s=".$uid ?>>Done</a>
                  </div>
                  <?php
                }
              }
            }

            // if the query fails
            if (mysqli_num_rows($results) == 0) {
              ?>
              <div id="task">
                <ul>
                  <li>NO TASKS</li>
                </ul>
              </div>
              <?php
            }
            ?>

          </ul>
        </div>
        <div id="quote">
          <h2>Completed tasks</h2>
          <ul>
            <?php

            //find all records that have been hidden
            $query2 = "SELECT * FROM tasks where hide=1 order by priority DESC, date DESC;";
            $resultshide = mysqli_query($GLOBALS['conn'], $query2) or die(mysqli_error($GLOBALS['conn']));

            while ($row_users = mysqli_fetch_array($resultshide))
            {
              $title = $row_users['title'];
              $text = $row_users['description'];
              $hide = $row_users['hide'];
              $tag = $row_users['tag'];
              //if the record is set to hiden, display it here
              if ($hide != 0) {
                ?>
                <div id="task">
                  <h3><?php echo $title ?></h3>
                  <?php if (empty($tag)) {
                    echo "<h2>NO TAG DATA</h2>";
                  }else{
                    echo "<h2>$tag</h2>";
                  }?>
                  <li><p><?php echo $text; ?></p></li>
                </div>
                <?php
              }

              //if there are no records in the database, print NO TASKS
              if (mysqli_num_rows($results) == 0) {
                ?>
                <div id="task">
                  <ul>
                    <li>NO TASKS</li>
                  </ul>
                </div>
                <?php
              }
            }
            ?>

          </ul>
        </div>
      </div>
    </body>
    </html>
    <?php
  }

  //logic to hide the items
  function xindex($u){
    $sql = "UPDATE tasks SET hide=1 WHERE uid=".$u.";";
    mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));
    header("location: ./index.php");
  }
