<?php
header("Access-Control-Allow-Origin: *");

$pid = $_GET['pid'];
$flag = 0;
        try{
        $conn = pg_connect("host=localhost port=5432 user = postgres password=Winteriscoming20! dbname=infoarch");
        $deletePost = pg_query($conn, "delete from posts where pid = '$pid'");
        }
        catch(Exception $e){
            $flag = 1;
        }

        if($flag==1){
        
            $deletePostobject = isset($deletePostobject) ? $deletePostobject : new stdClass();
            $deletePostobject->DeletePost='Failed';
            $deletepostjsonObj = json_encode($deletePostobject);
            echo $deletepostjsonObj;
        }

        else{
            $deletePostobject = isset($deletePostobject) ? $deletePostobject : new stdClass();
            $deletePostobject->DeletePost='Success';
            $deletepostjsonObj = json_encode($deletePostobject);
            echo $deletepostjsonObj;
        }

?>
