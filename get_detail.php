<?php

// 접속 정보 로드
include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/dbconn.php';

$get_idx=$_GET['idx'];
$sql = "SELECT * FROM magb_magazine  WHERE mag_idx = $get_idx"; 
$result = mysqli_query($conn, $sql); 

if(!mysqli_num_rows($result)){
    echo json_encode(array("msg" => "조회된 제품이 없습니다."));
}else{
    $row = mysqli_fetch_array($result);

    echo json_encode(array("mag_idx" => $row['mag_idx'], "mag_cate" => $row['mag_cate'], "mag_img1" => $row['mag_img1'], "mag_img2" => $row['mag_img2'], "mag_title" => $row['mag_title'], "mag_issue" => $row['mag_issue'], "mag_price" => $row['mag_price'],  "mag_desc" => $row['mag_desc'],  "mag_date" => $row['mag_date']));
}

?>
