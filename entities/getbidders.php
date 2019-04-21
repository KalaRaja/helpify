<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$pid = $_GET['pid'];

$conn_string = "host=localhost dbname=postgres port=5432 user=postgres password=Naughty880042";

$dbconn = pg_connect($conn_string);

$query = pg_query($dbconn, "SELECT * from getBiddersInfo($pid)");

$return_array = array();
while ($row = pg_fetch_assoc($query)) {
    $object = (object)['email' => $row['email'],'first_name' => $row['first_name'], 'last_name' => $row['last_name'], 'imageurl' => $row['imageurl'], 'rating' => $row['rating'], 'amount' => $row['amount']];
    array_push($return_array, $object);      
}

echo json_encode($return_array);

?>