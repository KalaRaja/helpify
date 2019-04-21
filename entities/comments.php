<?php
header("Access-Control-Allow-Origin: *");

//TODO - update and add the field names
$pid = $_GET['pid'];
$content = $_GET['content'];
$email_from = $_GET['email_from'];
$flag = 0;
        try{
        $conn = pg_connect("host=localhost port=5432 user = postgres password=Winteriscoming20! dbname=infoarch");
        $insertComments = pg_query($conn, "INSERT INTO comments
                                                 VALUES
                                        (DEFAULT,'$pid','$content', DEFAULT, '$email_from')");
        }
        catch(Exception $e){
            $flag = 1;
        }

        if($flag==1){
        
            $commentobject = isset($commentobject) ? $commentobject : new stdClass();
            $commentobject->Comments='Failed';
            $commentjsonObj = json_encode($commentobject);
            echo $commentjsonObj;
        }

        else{
            $commentobject = isset($commentobject) ? $commentobject : new stdClass();
            $commentobject->Comments='Success';
            $commentjsonObj = json_encode($commentobject);
            echo $commentjsonObj;
        }



?>