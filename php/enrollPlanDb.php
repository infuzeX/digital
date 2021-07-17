<?php
header('Content-Type: application/json');

require './response.php';

$json = file_get_contents('php://input');
$data = json_decode($json);

if(isset($data)){

   $res = new Response;

   //store object data in variable
   $name = $data ->name;
   $contact = $data ->contact;
   $coupon = $data ->coupon;
   $plan = $data ->plan;

   if($plan == "hyper"){
     $links = array("https://rzp.io/i/cBMlW1PQ", "https://rzp.io/i/27VdgQsJOn");
     $prices = array(1199, 789);
   }
   if($plan == "skill"){
     $links = array("https://rzp.io/i/yZFHs9OaQn", "https://rzp.io/i/v8TsXjf");
     $prices = array(1999, 1699);
   }
   if($plan == "aspire"){
     $links = array("https://rzp.io/i/eV7aqHT2", "https://rzp.io/i/C1BndtleOs");
     $prices = array(3499, 2999);
   }
   if($plan == "inturn"){
     $links = array("https://rzp.io/i/LUbYJV6", "https://rzp.io/i/5ZLnajk");
     $prices = array(4999, 3999);
   }
   
   $conn = new mysqli('localhost','padhhigh_demoform','padhhigh','padhhigh_demoform');
   //$conn = new mysqli('localhost','root','','test');

   if ($conn->connect_error) {
     die("Connection Failed: " . $conn->connect_error);
     $res->success = "fail";
     $res->message = $conn->connect_error;
     echo json_encode($res);
   }else{
    $discount = 0;

    if($coupon) {
       $coupon_conn = new mysqli('localhost','padhhigh_padhhigh','padhhigh','padhhigh_padhhigh');
       $coupon_query = "SELECT * FROM coupons WHERE coupon = '$coupon' ";
       $get_coupon = $coupon_conn->query($coupon_query);

       if($get_coupon->num_rows == 0) {  
         $res->success = "fail";
         $res->message = "Invalid Coupon";
         echo json_encode($res);
         return;
       }
       $coupon_conn->close();
       $discount = 1;
    }
      
    $link = $links[$discount];
    /*insert data*/
    $insert_student = "INSERT INTO enroll_plan (`name`, `contact`, `coupon`, `plan`) VALUES ('$name', $contact, '$coupon', '$plan')";
    $inserted = $conn->query($insert_student);

    if($inserted) {
      $res->success = "success";
      $res->message = $link;
      $res->price = $prices[$discount];
      echo json_encode($res);
      return;
    }
    
    $res->success = "fail";
    $res->message = "Failed to submit";
    echo json_encode($res);
   }
}
?>