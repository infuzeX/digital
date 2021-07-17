<?php
header('Content-Type: application/json');

require './response.php';

$res = new Response;
$conn = new mysqli('localhost','padhhigh_demoform','padhhigh','padhhigh_demoform');
//$conn = new mysqli('localhost','root','','test');

if ($conn->connect_error) {
    die("Connection Failed: ".$conn->connect_error);
    $res ->success = false;
    $res ->message = "failed to submit";
    echo json_encode($res);
}else{

   $json = file_get_contents('php://input');
   $data = json_decode($json);

   if(isset($data)){

    //store object data in variable
    $name = $data ->name;
    $contact = $data ->contact;
    $college = $data ->college;
    $who = $data ->who;
    $date = $data ->date;
    $time = $data ->time;
    
    /*insert data*/
    $query = "INSERT INTO pdf (`name`,`contact`, `college`, `who`,`date`,`time`) VALUES ('$name', $contact, '$college', '$who','$date','$time')";
    $inserted = $conn->query($query);

    if($inserted){
     //header("Location:/higher/video.html");
      $res ->success = "success";
      $res ->message = "/higher/video.html";
    }else{
      $res ->success = "fail";
      $res ->message = "failed to submit"; 
    }
     echo json_encode($res);
   }
 
}

?>