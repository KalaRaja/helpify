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

$query = pg_query($dbconn, "SELECT updatePost($pid, '$content', '$email', $tagid, $isresolved, '$address', '$starttime', '$endtime') as status") ;

$data = pg_fetch_object($query);

if($data->status == 't') {
    $result = (object) [
        'result' => "success"
        ];
    $final_result = json_encode($result);
    echo $final_result;
}else{
    $result = (object) [
        'result' => "failed"
        ];
    $final_result = json_encode($result);
    echo $final_result;
}

?>