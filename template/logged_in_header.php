<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script
        src="https://code.jquery.com/jquery-3.1.1.js"
        integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
        crossorigin="anonymous"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <?php
    if(file_exists("main.js")) {
        echo "<script src=\"main.js\"></script>";
    }
    else if(file_exists("../main.js")) {
        echo "<script src=\"../main.js\"></script>";
    }
    ?>

    <title>Group Run</title>
</head>
<body>

<nav class="navbar navbar-default header">
    <div class="container-fluid logged-in-header">
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="navbar-text">Team Runner</li>
            </ul>
            <ul class="logged_in_top_menu">
                <!--<li><button class="btn btn-header">Log Out</button></li>-->
                <?php
                if(file_exists("../pages/logout-complete.php")) {
                    echo "<li><a href='../pages/logout-complete.php'><button class='btn btn-header'>Log Out</button></a></li>";
                }
                else if(file_exists("pages/logout-complete.php")) {
                    echo "<li><a href='pages/logout-complete.php'><button class='btn btn-header'>Log Out</button></a></li>";
                }
                if(file_exists("index.php")) {
                echo "<li><a href='index.php'><button class='btn btn-header'>Home Page</button></a></li>";
                }
                else if(file_exists("../index.php")) {
                echo "<li><a href='../index.php'><button class='btn btn-header'>Home Page</button></a></li>";
                }
                if(file_exists("../pages/teampage.php")) {
                echo "<li><a href='../pages/teampage.php'><button class='btn btn-header'>Team Page</button></a></li>";
                }
                else if(file_exists("pages/teampage.php")) {
                echo "<li><a href='pages/teampage.php'><button class='btn btn-header'>Team Page</button></a></li>";
                }
                if(file_exists("../pages/personalpage.php")) {
                    echo "<li><a href='../pages/personalpage.php'><button class='btn btn-header'>Personal Page</button></a></li>";
                }
                else if(file_exists("pages/personalpage.php")) {
                    echo "<li><a href='pages/personalpage.php'><button class='btn btn-header'>Personal Page</button></a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>