<?php
header("Access-Control-Allow-Origin: *");

$pid = $_GET['pid'];
$rating = $_GET['rating'];
$email_from = $_GET['email_from'];
$email_on = $_GET['email_on'];
$flag = 0;
        try{
        $conn = pg_connect("host=localhost port=5432 user = postgres password=Winteriscoming20! dbname=infoarch");
        $insertComments = pg_query($conn, "INSERT INTO ratings
                                                 VALUES
                                        ('$email_from','$email_on','$rating', '$pid')");
        }
        catch(Exception $e){
            $flag = 1;
        }

        if($flag==1){
        
            $ratingobject = isset($ratingobject) ? $ratingobject : new stdClass();
            $ratingobject->Ratings='Failed';
            $ratingjsonObj = json_encode($ratingobject);
            echo $ratingjsonObj;
        }

        else{
            $ratingobject = isset($ratingobject) ? $ratingobject : new stdClass();
            $ratingobject->Ratings='Success';
            $ratingjsonObj = json_encode($ratingobject);
            echo $ratingjsonObj;
        }



?>