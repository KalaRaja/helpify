<?php
/*
 * Caution: Need to call $conn->close() after including this file
 */

// $db_server = 'localhost';
// $db_username = 'postgres';
// $db_password = "Winteriscoming20!";
// $db_name = 'infoarch';
// $conn = new pg_co($db_server, $db_username, $db_password, $db_name) or die('Unable to connect to Database');
$conn = pg_connect("host=localhost port=5432 user = postgres password=Winteriscoming20! dbname=infoarch");

function sendQuery($cmd) {
    global $conn;
    try{  
      return pg_query($conn,$cmd) or die('already exists');
    }
    catch(Exception $e) {
        echo "\"status\":\"failed\"";
      }


    
}
