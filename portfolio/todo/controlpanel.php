<?php
include "./xcommon.php";

security();

if (empty($_REQUEST['i'])) $_REQUEST['i'] = '1';
switch($_REQUEST['i'])
{
    case '1':
    index();
    break;

    case '2':
    xhide($_REQUEST['s']);
    break;

    case '3':
    xunhide($_REQUEST['s']);
    break;

    case '4':
    xdelete($_REQUEST['s']);
    break;

    case '5':
    xdeleteall();
    break;

    default:
    index();
}

function Priorities($rec, $style)
{
    // get record data
    $uid = $rec['uid'];
    $user = $rec['user'];
    $title = $rec['title'];
    $text = $rec['description'];
    $tag = $rec['tag'];

    // if the record isnt complete
    if ($style == 1) {
        if ($rec['priority'] == 3) $sid = "taskhigh";
        elseif ($rec['priority'] == 2) $sid = "taskmed";
        else $sid = "tasklow";
    }
    // if completed
    else {
        $sid ="task";
    }

    // set the div
    echo "<div id='".$sid."'>";
    echo "<h3>$title</h3>";

    // is there a tag?
    if (empty($tag)) echo "<h3>NO TAG DATA</h3>";
    else echo "<h3>#$tag</h3>";

    // show the username of the person who posted the task
    echo "<p>USER: ".getUserName($_SESSION['uid'])."</p>";
    echo "<p>$text</p>";

    // if the record is un-completed display the right button
    if ($style == 1) {
        echo "<a class='button5' href='./controlpanel.php?i=2&s=$uid'>COMPLETE</a>";
    }else {
        echo "<a class='button5' href='./controlpanel.php?i=3&s=$uid'>UNDO</a>";
        echo "<br>";
        echo "<a class='button5' href='./controlpanel.php?i=4&s=$uid'>DELETE</a>";
    }
    echo "</div>";
}

function index(){
    // no search for tag
    if (empty($_REQUEST['tag'])){
        $query = "SELECT * FROM tasks where hide=0 order by priority DESC, date DESC;";
    }
    // if search, display searcheed tags only
    else {
        $t = $_REQUEST['tag'];
        $query = "SELECT * FROM tasks where hide=0 and tag='$t' order by priority DESC, date DESC;";
    }

    // get the list of non-hidden tasks
    $results = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));
    $numrows = mysqli_num_rows($results);
    ?>

    <html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./help.css">
        <title>Tag-Do - ADMIN PANEL</title>
    </head>

    <body>
        <div id="main">
            <h1>Tag-Do - ADMIN PANEL</h1>
            <p>YOU SHOULD NOT BE HERE</p>
            <small>Created by Michael Manning</small>
            <br>

            <div id="quote">
                <h2>You are currently logged in as user: <?php echo $_SESSION['username']; ?></h2>
                <div id="task">
                    <p>There are <?php echo $numrows ?> un-completed tasks globally.</p>
                    <a class='button5' href="./xlogin.php?i=2">LOGOUT</a>
                </div>
                <div id="task">
                    <p>List of all users:</p>
                    <?php getAllUsers();?>
                </div>
                <form id="delete" action="./controlpanel.php?i=5" method="post">
                    <input type="submit" name="submit" value="PURGE ALL TASKS">
                </form>
            </div>

            <div id="quote">
                <h2>To clear your search: clear this box and press ENTER.</h2>
                <div id="task">
                    <p>Your tags:</p>
                    <ul>
                        <?php getUserTags($_SESSION['uid']);?>
                    </ul>
                </div>
                <hr>
                <form method="post" action="index.php?tag=<?php echo $t?>">
                    <input type="text" value="<?php echo $t ?>" placeholder="Search for a Tag" name="tag">
                    <input type="submit" name="submit" value="Search">
                </form>
            </div>

            <div id="quote">
                <h2>To Be Completed</h2>
                <ul>
                    <div class="cards">
                        <?php
                        //if there is a result, print it
                        while ($rec = mysqli_fetch_array($results))
                        {
                            Priorities($rec, 1);
                        }

                        // if the query fails
                        if (mysqli_num_rows($results) == 0) {
                            ?>
                            <div id="task">
                                <p>NO TASKS</p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </ul>
            </div>

            <div id="quote">
                <h2>Completed Tasks</h2>
                <ul>
                    <div class="cards">
                        <?php
                        //find all records that have been hidden
                        if (empty($_REQUEST['tag'])){
                            $query2 = "SELECT * FROM tasks where hide=1 and user=".$_SESSION['uid']." order by priority DESC, date DESC;";
                        }
                        // if the user is doign a search, show searched and completed tasks
                        else {
                            $t = $_REQUEST['tag'];
                            $query2 = "SELECT * FROM tasks where hide=1 and tag='$t' and user=".$_SESSION['uid']." order by priority DESC, date DESC;";
                        }

                        // query the db for completed tasks
                        $resultshide = mysqli_query($GLOBALS['conn'], $query2) or die(mysqli_error($GLOBALS['conn']));
                        while ($rec = mysqli_fetch_array($resultshide))
                        {
                            Priorities($rec, 0);
                        }
                        //if there are no records in the database, print NO TASKS
                        if (mysqli_num_rows($resultshide) == 0) {
                            ?>
                            <div id="task">
                                <p>NO TASKS</p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </ul>
            </div>
        </div>
    </body>
    </html>
    <?php
}

//logic to hide the items
function xhide($u){
    $sql = "UPDATE tasks SET hide=1 WHERE user=".$_SESSION['uid']." and uid=".$u.";";
    mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));
    header("location: ./controlpanel.php");
}

// unhide a clicked record
function xunhide($u){
    $sql = "UPDATE tasks SET hide=0 WHERE user=".$_SESSION['uid']." and uid=".$u.";";
    mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));
    header("location: ./controlpanel.php");
}

// delete from database
function xdelete($u){
    $sql = "delete from tasks WHERE user=".$_SESSION['uid']." and uid=".$u.";";
    mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));
    header("location: ./controlpanel.php");
}

// ADMIN DELETE ALL RECORDS
function xdeleteall(){
    $sql = "delete from tasks;";
    mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));
    header("location: ./controlpanel.php");
}
