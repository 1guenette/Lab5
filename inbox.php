<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Posts</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


<!--Change the href later, right now they do nothing-->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#top">Inbox</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="viewPosts.php">Post page</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <form action="logout.php">
                <li>
                    <button type="submit" class="btn btn-danger navbar-btn">
                        <span class="glyphicon glyphicon-log-out"> Logout</span>
                    </button>
                </li>
            </form>
        </ul>
    </div>
</nav>

<div class="container">
    <div id="top">
        <h1>Your inbox</h1>
        <hr>
        <div id="message_area">
            <?php
            require_once 'config.php';
            include_once 'phpseclib/Crypt/RSA.php';
            $user = $_SESSION["name"];
            $private = base64_decode($_SESSION['pri']);

            $sql = mysqli_query($conn, "SELECT * FROM $db_table3 WHERE receiver = '$user'");
            $message = mysqli_fetch_all($sql);

            $message_array = array();

            if ($message != NULL) {
                $rsa = new Crypt_RSA();
                $rsa->loadKey($private);

                foreach ($message as $key => $value) {
                    $message_array[$key] = $value;
                }
            }
            else {
                echo "You have no messages";
            }

            for($i = 0; $i < sizeof($message_array); ++$i){
                echo "<p>".$rsa->decrypt(base64_decode($message_array[$i][2]))."<br><br>
                 From: ".$message_array[$i][1]."</p><br><hr>";
            }

            $conn->close();
            ?>
        </div>
        <br>
        <br>
        <br>
    </div>
</div>

</body>
</html>
