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
            <a class="navbar-brand" href="#top">Posts</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="inbox.php">Inbox</a></li>
            <li><a href="#send_message">Send message</a></li>
            <li><a href="#make_post">Make post</a></li>
            <li>
                <button class="btn btn-default navbar-btn" type="button" onclick="updatePosts()">Update posts</button>
            </li>
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
        <h1>Posts Page</h1>
        <hr>

        <div id="post_area">
        </div>
        <br><br><br>
    </div>
</div>

<div class="container">
    <h3>Make post:</h3>
    <form id="make_post">
        <input placeholder="Title" class="form-control" type="text" id="title" required>
        <br>
        <textarea placeholder="Description" class="form-control" rows="5" id="description" required></textarea>
        <br>
        <input type="submit" class="btn btn-success" value="Post" onclick="makePosts()">
    </form>
    <br><br>
</div>

<div class="container">
    <hr>
    <h3>Send a message:</h3>
    <form id="send_message">
        <input placeholder="To" class="form-control" id="send_to" type="text" required>
        <br>
        <textarea placeholder="Message" class="form-control" id="message_to" rows="5" required></textarea>
        <br>
        <input type="submit" class="btn btn-success" value="Send" onclick="send_message()">
    </form>
</div>
<br>

</body>
</html>

<script>

    //Sends data to the database
    function makePosts() {

        var t = $("#title").val();
        var desc = $("#description").val();

        //Making sure the data is not empty!
        if (t != "" && desc != "") {
            $.ajax({
                type: "GET",
                cache: false,
                url: "makePosts.php",
                data: {"t": t, "d": desc, "time": Date()},
                success: function () {
                    $('#title').val('');
                    $('#description').val('');
                    $(document).ready(function () {
                        updatePosts();
                    });
                }
            });
        }
    }

    //Loads the current posts

    $(document).ready(function () {
        updatePosts();
    });

    function updatePosts() {
        $('#post_area').empty();
        $.ajax({
            type: "POST",
            url: "updatePosts.php",
            success: function (json_data) {

                var arr = $.parseJSON(json_data);

                $(arr).each(function (i, val) {
                    $.each(val, function (k, v) {

                        //the below method prints unfiltered json in console
//                        console.log(k + " : " + v);

                        switch (k) {
                            case 0:
                                $('#post_area').append("<h4>" + v + "</h4>");
                                break;
                            case 1:
                                $('#post_area').append("<p class='post'>" + v + "</p><br>");
                                break;
                            case 2:
                                $('#post_area').append("<p>Created by </p><p class='user'>" + v + "</p><p>");
                                break;
                            case 3:
                                $('#post_area').append("Posted on " + v + "</p><br><hr>");
                                break;
                        }
                    });
                });
                append_buttons();
            }
        });
    }


    function append_buttons() {
        var usr = '<?php echo $_SESSION["name"];?>';
        var isAdmin = '<?php echo $_SESSION["admin"];?>';

        var x = document.getElementsByClassName("post");
        var u = document.getElementsByClassName("user");
        var int = 0;
        var i;

        for (i = 0; i < x.length; i++) {

            if (isAdmin == 1) {
                $(x[i]).append("<input type='button' class='btn btn-default pull-right' value='delete' " +
                    "onclick='delete_post(" + int + ")'>");
            }
            if (usr == u[i].innerHTML || isAdmin == 1) {
                $(x[i]).append("<input type='button' class='btn btn-default pull-right' value='edit' " +
                    "onclick='edit_post(" + int + ")'>");
            }
            int++;
        }
    }

    function edit_post(num) {
        var x = document.getElementsByClassName("post");
        var msg = x[num].innerHTML.split('<input');
        var specific_msg = msg[0];
        var edit_prompt = prompt("Please enter your edit", specific_msg);

        if(edit_prompt != null){
            $.ajax({
                type: "GET",
                cache: false,
                url: "edit_post.php",
                data: {"upd_post": edit_prompt, "msg": specific_msg}
            });
            $(document).ready(function () {
                updatePosts();
            });
        }
    }

    function delete_post(num) {

        var x = document.getElementsByClassName("post");
        var temp = x[num].innerHTML.split('<input');
        var msg = temp[0];

        $.ajax({
            type: "GET",
            cache: false,
            url: "delete_post.php",
            data: {"msg": msg}
        });
        $(document).ready(function () {
            updatePosts();
        });
    }



    function send_message(){

        var receiver =  $("#send_to").val();
        var msg = $("#message_to").val();


        $.ajax({
            type: "POST",
            cache: false,
            url: "encrypt_message.php",
            data: {"rec": receiver, "msg": msg},
            success: function (m) {
                alert(m);
                $("#send_to").val("");
                $("#message_to").val("");
            }
        });

    }

</script>