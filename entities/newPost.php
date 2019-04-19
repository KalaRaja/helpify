<?php
header("Access-Control-Allow-Origin: *");
// include '../config/database.php';

//TODO - update and add the field names
$content = $_GET['content'];
$tagid = $_GET['tagid'];
$address = $_GET['address'];
$email = $_GET['email'];
$starttime = $_GET['starttime'];
$endtime = $_GET['endtime'];
$imageurl = $_GET['imageurl'];

$conn = pg_connect("host=localhost port=5432 user = postgres password=Winteriscoming20! dbname=infoarch");

$getMaxPid = pg_query($conn, "Select max(pid) from posts");
$row = pg_fetch_row($getMaxPid);
$currentPid = $row[0] +1;
$insert_posts_images = pg_query($conn, "INSERT INTO posts_images VALUES 
                                        ($currentPid, '$content')");// Doubt: how to get number of images that needs to be inserted

$insert_posts = pg_query($conn, "INSERT INTO posts VALUES 
                                (DEFAULT, '$content', '$email', '$tagid', 'False', '$address', '$starttime', '$endtime')");

$postobject = isset($postobject) ? $postobject : new stdClass();
$postobject->NewPost='Success';
$postjsonObj = json_encode($postobject);
echo $postjsonObj;



















