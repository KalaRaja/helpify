<?php
header("Access-Control-Allow-Origin: *");

$email_from = $_GET['email_from'];
$flag = 0;
        try{
        $conn = pg_connect("host=localhost port=5432 user = postgres password=Winteriscoming20! dbname=infoarch");
        $getBidAmount = pg_query($conn, "Select amount from bid where email_from = '$email_from'");
        }
        catch(Exception $e){
            $flag = 1;
        }

        $data = pg_fetch_object($getBidAmount);
        $bid_amount = (object)[

            'amount' => $data->amount,
        ];

        if($flag==1){
        
            $deletePostobject = isset($deletePostobject) ? $deletePostobject : new stdClass();
            $deletePostobject->GetBidAmount='Failed';
            $deletepostjsonObj = json_encode($deletePostobject);
            echo $deletepostjsonObj;
        }

        else{
            $deletePostobject = isset($deletePostobject) ? $deletePostobject : new stdClass();
            $deletePostobject->GetBidAmount='Success';
            $deletepostjsonObj = json_encode($deletePostobject);
            echo $deletepostjsonObj;
            $final_amount = json_encode($bid_amount);
            echo $final_amount;
        }


?>