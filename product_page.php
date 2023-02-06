<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/dbconn.php';

$get_cate=$_GET['cate'];

if($get_cate=='none'){
    total_page_num($conn);
}else{
    cate_page_num($conn, $get_cate);
}

function total_page_num($conn){
    $sql = "SELECT * FROM magb_magazine ORDER BY mag_idx DESC"; 
    $result = mysqli_query($conn, $sql); 

    $data_num =  mysqli_num_rows($result);
    $page_num = ceil($data_num / 10);

    echo json_encode(array("data_num"=>$data_num, "page_num"=>$page_num));
}

function cate_page_num($conn, $get_cate){
    $sql = "SELECT * FROM magb_magazine  WHERE mag_cate = '$get_cate' ORDER BY mag_idx DESC"; 
    $result = mysqli_query($conn, $sql); 

    $data_num =  mysqli_num_rows($result);
    $page_num = ceil($data_num / 10);

    echo json_encode(array("data_num"=>$data_num, "page_num"=>$page_num));
}
?>