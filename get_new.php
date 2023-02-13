<?php

// 접속 정보 로드
include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/dbconn.php';

$sql = "SELECT * FROM magb_magazine  ORDER BY mag_idx DESC LIMIT 1"; 
$result = mysqli_query($conn, $sql); 

$row = mysqli_fetch_array($result);

echo json_encode(array("mag_idx" => $row['mag_idx'], "mag_cate" => $row['mag_cate'], "mag_title" => $row['mag_title'], "mag_issue" => $row['mag_issue'], "mag_desc" => $row['mag_desc']));

?>
