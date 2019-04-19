<?php
header("Access-Control-Allow-Origin: *");
// include '../config/database.php';

//TODO - update and add the field names
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$password = $_GET['password'];
$email = $_GET['user_email'];
$imageurl='{}';
        
        $conn = pg_connect("host=localhost port=5432 user = postgres password=Winteriscoming20! dbname=infoarch");
        $createUser = pg_query($conn, "SELECT email FROM users where email = '$email'");
        $row = pg_fetch_row($createUser);

        if ($row!=null) {
            //TODO- navigate to login page
            $fobject = isset($fobject) ? $fobject : new stdClass();
            $fobject->SignUp='failed';
        $fjsonObj = json_encode($fobject);
        echo $fjsonObj;
            
        } else {
            //TODO- navigate to timeline page
            $insert_users = pg_query($conn, "INSERT INTO users
             VALUES
            ('$email', '$password')");
           $insert_profile = pg_query($conn,"INSERT INTO profile
                 VALUES
                ('$email','$firstname', '$lastname', '$imageurl')");
           
            $sobject = isset($sobject) ? $sobject : new stdClass();
            $sobject->SignUp='Success';
            $sjsonObj = json_encode($sobject);
            echo $sjsonObj;
            // header("Location: ../timeline.html");
           
        }
     