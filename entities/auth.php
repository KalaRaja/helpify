<?php
session_start();
include '../config/database.php';
$username = $_POST['user_email'];
$password = $_POST['password'];

//TODO - handling login of admin account
// This is a very ugly and stupid way to handle admin account, but is the easiest - JH
// if ($username=='admin' && $password=='admin') {
//     $_SESSION['username'] = 'admin';
//     header("Location: admin.php");
//     return;
// }

 sendQuery("SELECT password FROM users  where email = '$username'");

$rows = pg_fetch_assoc($result);

    if(count($rows)<1){
        // echo '<script type="text/javascript">alert("User undefined");</script>';
        echo "{\"status\":\"failed\"}";
    }
    else{
        password_auth();
    }

function password_auth() {

    $passwordRetr = $result['password'];
    echo($password);
    echo($passwordRetr);

    if ($password == $passwordRetr) {
        // $_SESSION['username'] = $username;
         header("Location: ../timeline.html");
    } else {
        //TODO- update location on login
        // echo '<script type="text/javascript">alert("Incorrect Password"); location="logout.php";</script>';
        echo "{\"status\":\"failed\"}";
        header("Location: ../timeline.html");
    }
}

//TODO- Navigation on successful login
// if ($customerQuery && password_auth($customerQuery)) {
//     //TODO- update location on login
//     header("Location: home.php");
// } else if ($organzierQuery && password_auth($organzierQuery)) {
//     //TODO- update location on login
//     header("Location: loadingScreen.php");
// } else {
//     //TODO- update location on login
//     echo '<script type="text/javascript">alert("Unknown User"); location="login.php";</script>';
// }
