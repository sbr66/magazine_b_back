<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/dbconn.php';

$sql = "SELECT * FROM magb_magazine ORDER BY mag_idx DESC"; //DESC:역순, ASC:정순(dafalt) 정렬
$result = mysqli_query($conn, $sql); //  첫번째 파라미터 : 접속정보, 두번째 파라미터 ; 쿼리문
$data_num =  mysqli_num_rows($result);
$page_num = ceil($data_num / 10);
echo $page_num;
?>