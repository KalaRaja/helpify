<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: Application/json");
// include '../config/database.php';

//TODO - update and add the field names
$email = $_GET['email'];


$conn = pg_connect("host=localhost port=5432 user = postgres password=Winteriscoming20! dbname=infoarch");

$fetch_profile = pg_query($conn, "Select p.first_name, p.last_name, 
                                (Select max(b.bidid)  from bid b where email_from='$email') as bidCount, 
                                (Select avg(r.rating)  from ratings r where r.email_on='$email') as userRating  
                                    from profile p
                                where email = '$email'");
                            

$data = pg_fetch_object($fetch_profile);

// $profile_result = isset($profile_result) ? $profile_result : new stdClass();
$profile_result = (object)[

        'first_name' => $data->first_name,
        'last_name' => $data->last_name,
        'no_of_bids' => $data->bidcount,
        'rating'  => $data->userrating
];

$final__profile_result = json_encode($profile_result);
echo $final__profile_result;

