<?php
header("Access-Control-Allow-Origin: *");
session_start();
$username = $_POST['user_email'];
$password = $_POST['password'];

$conn = pg_connect("host=localhost port=5432 user = postgres password=Winteriscoming20! dbname=infoarch");
$result = pg_query($conn, "SELECT password FROM users  where email = '$username'");

$rows = pg_num_rows($result);
    if($rows<1){
        // echo '<script type="text/javascript">alert("User undefined");</script>';4
        $failobject = isset($failobject) ? $failobject : new stdClass();
        $failobject->login='failed';
        $failjsonObj = json_encode($failobject);
        echo $failjsonObj;
    }

function password_auth($authQuery) {
    global $password, $username;
    $resultnew = pg_fetch_assoc($authQuery);
    $passwordRetr = $resultnew['password'];

    if ($password == $passwordRetr) {
        // $_SESSION['username'] = $username;
        return true;
    // } else {
    //     // echo '<script type="text/javascript">alert("Incorrect Password"); location="logout.php";</script>';
    //     $fobject = isset($fobject) ? $fobject : new stdClass();
    //     $fobject->login='failed';
    //     $fjsonObj = json_encode($fobject);
    //     echo $fjsonObj;
        
    // }
}
}

//TODO- Navigation on successful login
if ($result && password_auth($result)) {
    //TODO- update location on login
    $sucobject = isset($sucobject) ? $sucobject : new stdClass(); 
    $sucobject->login='success';
        $sucjsonObj = json_encode($sucobject);
        echo $sucjsonObj;
        //  header("Location: ../timeline.html");
}
// } else {
//     //TODO- update location on login
//     echo '<script type="text/javascript">alert("Unknown User"); location="login.php";</script>';
// }
