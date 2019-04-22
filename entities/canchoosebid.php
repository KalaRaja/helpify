<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$pid = $_GET['pid'];

$conn_string = "host=localhost dbname=postgres port=5432 user=postgres password=Naughty880042";

$dbconn = pg_connect($conn_string);

$query = pg_query($dbconn, "SELECT canchoosebid($pid) as status");

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