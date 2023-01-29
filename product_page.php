<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/dbconn.php';

$sql = "SELECT * FROM magb_magazine ORDER BY mag_idx DESC"; 
$result = mysqli_query($conn, $sql); 

$data_num =  mysqli_num_rows($result);
$page_num = ceil($data_num / 10);

echo json_encode(array("data_num"=>$data_num, "page_num"=>$page_num));

?>