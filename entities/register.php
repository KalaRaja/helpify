<?php
include '../config/database.php';

//TODO - update and add the field names
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$password = $_GET['password'];
$email = $_GET['user_email'];
// $tags = $_GET['tags'];
$tags='{}';
$street=Null;
$state=Null;
$zip=0;
$phone=0;
// $street = $_GET['street'];
// $state = $_GET['state'];
// $zip = $_GET['zip'];
// $phone = $_GET['phone'];


   

        $createUser = sendQuery("SELECT email FROM users where email = '$email'");

        if ($createUser) {
            //TODO- navigate to login page
            // echo '<script type="text/javascript">alert("The username is already taken"); location="http://localhost/ItsHappening/login.php";</script>';
            echo "{\"status\":\"failed\"}";
            
        } else {
            
            $insert_users = sendQuery("INSERT INTO users
             VALUES
            ('$email', '$password')");
           $insert_profile = sendQuery("INSERT INTO profile
                 VALUES
                ('$email', '$tags','$firstname', '$lastname','$street','$state', '$zip', '$phone')");
           
            

            //TODO- update the location of file
            // echo '<script type="text/javascript">alert("Registration Successful");</script>';
            echo "{\"status\":\"successfull\"}";
            header("Location: ../timeline.html");
           
        }
     