<?php
header("Access-Control-Allow-Origin: *");

$email = $_GET['email'];


$conn = pg_connect("host=localhost port=5432 user = postgres password=Naughty880042 dbname=postgres");

$query = "SELECT p.first_name, 
       p.last_name,
	   p.imageurl,
       (SELECT Max(b.bid) 
        FROM   bid b 
        WHERE  email_from = '$email') AS no_of_bids, 
       (SELECT Avg(r.rating) 
        FROM   ratings r 
        WHERE  r.email_on = '$email')::double precision AS rating 
		FROM   profile p 
                WHERE email = '$email'";
                
$fetch_profile = pg_query($conn, $query);
                            

$data = pg_fetch_object($fetch_profile);

$profile_result = (object)[

        'first_name' => $data->first_name,
        'last_name' => $data->last_name,
        'imageurl' => $data->imageurl,
        'no_of_bids' => $data->no_of_bids,
        'rating'  => $data->rating
];

$final__profile_result = json_encode($profile_result);
echo $final__profile_result;

?>