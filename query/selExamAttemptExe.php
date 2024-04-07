<?php 
 session_start();
 include("../conn.php");
$exmneId = $_SESSION['examineeSession']['exmne_id'];
 

extract($_POST);

 

 {
 	$res = array("res" => "takeNow");
 }


 echo json_encode($res);
 ?>