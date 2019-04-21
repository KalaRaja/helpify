<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: Application/json");

$pid = $_GET['pid'];
$content = $_GET['content'];
$email = $_GET['email'];
$tagid = $_GET['tagid'];
$isresolved = $_GET['isresolved'];
$address = $_GET['address'];
$starttime = $_GET['starttime'];
$endtime= $_GET['endtime'];

$conn_string = "host=localhost dbname=postgres port=5432 user=postgres password=Naughty880042";

$dbconn = pg_connect($conn_string);

$query = pg_query($dbconn, "UPDATE posts set content = '$content', 
                                             email = '$email', 
                                             tagid = $tagid, 
                                             isresolved = '$isresolved', 
                                             address = '$address', 
                                             starttime = '$starttime', 
                                             endtime = '$endtime' where pid = $pid") ;

if($query) {
    $return_json = (object)['status' => 'success'];
    echo json_encode($return_json);
}else{
    $return_json = (object)['status' => 'failed'];
    echo json_encode($return_json);
}

?>