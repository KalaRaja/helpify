<?php
header("Access-Control-Allow-Origin: *");

$pid = $_GET['pid'];
$flag = 0;
        try{
        $conn = pg_connect("host=localhost port=5432 user = postgres password=Winteriscoming20! dbname=infoarch");
        $insertComments = pg_query($conn, "Update posts set isresolved = true where pid = '$pid'");
        }
        catch(Exception $e){
            $flag = 1;
        }

        if($flag==1){
        
            $resolvedobject = isset($resolvedobject) ? $resolvedobject : new stdClass();
            $resolvedobject->Resolved='Failed';
            $resolvedjsonObj = json_encode($resolvedobject);
            echo $resolvedjsonObj;
        }

        else{
            $resolvedobject = isset($resolvedobject) ? $resolvedobject : new stdClass();
            $resolvedobject->Resolved='Success';
            $resolvedjsonObj = json_encode($resolvedobject);
            echo $resolvedjsonObj;
        }

?>