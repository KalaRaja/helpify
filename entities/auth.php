<?php
session_start();
include '../config/database.php';
$username = $_POST['username'];
$password = $_POST['password'];

//TODO - handling login of admin account
// This is a very ugly and stupid way to handle admin account, but is the easiest - JH
// if ($username=='admin' && $password=='admin') {
//     $_SESSION['username'] = 'admin';
//     header("Location: admin.php");
//     return;
// }

$customerQuery = sendQuery("SELECT password FROM users  where email = '$username'");
$rows = pg_num_rows($customerQuery);
    if($rows<1){
        // echo '<script type="text/javascript">alert("User undefined");</script>';
        echo $userundefined = json_encode("User undefined");
    }

function password_auth($authQuery) {
    global $passwordEnc, $username;

    $result = $authQuery->fetch_assoc();
    $passwordRetr = $result['password'];

    if ($passwordEnc == $passwordRetr) {
        $_SESSION['username'] = $username;
        return true;
    } else {
        //TODO- update location on login
        // echo '<script type="text/javascript">alert("Incorrect Password"); location="logout.php";</script>';
        echo $incorrectpwd = json_encode("Incorrect Password");

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
