<?php
header('Content-Type: application/json');

require './response.php';

$json = file_get_contents('php://input');
$data = json_decode($json);

if(isset($data)){

   $res = new Response;

   //store object data in variable
   $name = $data ->name;
   $email = $data ->email;
   $contact = $data ->contact;
   $hrname = $data ->hrname;
  
   //GENERATE COUPON 
   $permitted_chars = '0123456789ABCDEFGHIJKLMN0PQRSTUVWXTYZ';
   $coupon = substr(str_shuffle($permitted_chars), 0, 10);
   
   //STORE DATA
   $conn = new mysqli('localhost','padhhigh_padhhigh','padhhigh','padhhigh_padhhigh');

   $query = "INSERT INTO coupons (`name`,`email`, `contact`, `hrname`, `coupon`) VALUES ('$name','$email', $contact, '$hrname', '$coupon')";
   $inserted = $conn->query($query);

   //RESPONSE
   if($inserted) {
    $res->success = "success";
    $res->message = $coupon;
   }else{
     $res->success = "fail";
     $res->message = "Failed to generate coupon";
   }
   echo json_encode($res);
}

?>