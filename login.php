<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<script>

    function login() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                this.response;
            }
        };
        xhttp.open("GET", "checkLogin.php?u=" + document.getElementsByName("username") + "&p=" + document.getElementsByName("password"), true);
        xhttp.send();
    };

</script>
<div class="container">
    <form>
        <div class="page-header">
            <h3>Login</h3>
        </div>
        <input type="text" placeholder="Username" name="username">
        <br><br>
        <input type="password" placeholder="Password" name="password">
        <br><br>
        <input type="submit" class="btn btn-success" id="submit" onclick="login()">
    </form>

    <p id="desc"></p>
</div>
</body>
</html>
