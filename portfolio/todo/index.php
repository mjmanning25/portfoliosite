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
    $uid = $rec['uid'];
    $title = $rec['title'];
    $text = $rec['description'];
    $tag = $rec['tag'];

    if ($style == 1) {
        if ($rec['priority'] == 3) $sid = "taskhigh";
        elseif ($rec['priority'] == 2) $sid = "taskmed";
        else $sid = "tasklow";
    } else {
        $sid ="task";
    }

    echo "<div id='".$sid."'>";
    echo "<h3>$title</h3>";

    if (empty($tag)) echo "<h3>NO TAG DATA</h3>";
    else echo "<h3>#$tag</h3>";

    echo "<p>$text</p>";
    if ($style == 1) {
        echo "<a href='./index.php?i=2&s=$uid'>COMPLETE</a>";
    }else {
        echo "<a href='./index.php?i=3&s=$uid'>UNDO</a>";
        echo "<br>";
        echo "<a href='./index.php?i=4&s=$uid'>DELETE</a>";
    }
    echo "</div>";
}

function index(){
    if (empty($_REQUEST['tag'])){
        $query = "SELECT * FROM tasks where hide=0 order by priority DESC, date DESC;";
    }

    else {
        $t = $_REQUEST['tag'];
        $query = "SELECT * FROM tasks where hide=0 and tag='$t' order by priority DESC, date DESC;";
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
                        <li>- Add user logins with independant tasks</li>
                    </ul>
                </div>
            </div>

            <div id="quote">
                <form method="post" action="index.php?tag=<?php echo $t?>">
                    <p>To clear your search: clear this box and press ENTER.</p>
                    <p>This is a WIP feature, please be nice.</p>
                    <a href="./xlogin.php?i=2">TEMP LOGOUT</a>
                    <input type="text" placeholder="<?php echo $t ?>" name="tag">
                    <input type="submit" name="submit" value="Search">
                </form>
                <hr>
                <form action="./todo.php" method="post">
                    <input type="submit" name="submit" value="Add A New Task">
                </form>
            </div>

            <div id="quote">
                <h2>To Be Completed</h2>
                <ul>
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

                </ul>
            </div>

            <div id="quote">
                <h2>Completed Tasks</h2>
                <form id="delete" action="./index.php?i=5" method="post">
                    <input type="submit" name="submit" value="DELETE ALL COMPLETED">
                </form>
                <ul>
                    <?php
                    //find all records that have been hidden
                    if (empty($_REQUEST['tag'])){
                        $query2 = "SELECT * FROM tasks where hide=1 order by priority DESC, date DESC;";
                    }

                    else {
                        $t = $_REQUEST['tag'];
                        $query2 = "SELECT * FROM tasks where hide=1 and tag='$t' order by priority DESC, date DESC;";
                    }

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

                </ul>
            </div>
        </div>
    </body>
    </html>
    <?php
}

//logic to hide the items
function xhide($u){
    $sql = "UPDATE tasks SET hide=1 WHERE uid=".$u.";";
    mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));
    header("location: ./index.php");
}

function xunhide($u){
    $sql = "UPDATE tasks SET hide=0 WHERE uid=".$u.";";
    mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));
    header("location: ./index.php");
}

function xdelete($u){
    $sql = "delete from tasks WHERE uid=".$u.";";
    mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));
    header("location: ./index.php");
}
function xdeleteall(){
    $sql = "delete from tasks where hide=1;";
    mysqli_query($GLOBALS['conn'], $sql) or die(mysqli_error($GLOBALS['conn']));
    header("location: ./index.php");
}
