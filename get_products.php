<?php
   include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/dbconn.php';
//    include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/error.php';
   $get_cate=$_GET['cate'];
   $get_page=$_GET['page'];


   if($get_cate=='none'){
        printpage($conn, $get_page);

   }else{
        print_cate($conn, $get_page, $get_cate);
   }


    function printpage($conn, $page){
        // $page_info = total_page_num($conn);

        $start_data = ($page - 1)*10;
        $sql = "SELECT * FROM magb_magazine ORDER BY mag_idx DESC LIMIT $start_data, 10";
        $result = mysqli_query($conn, $sql);
    
        $json_result = array(); 
        while($row = mysqli_fetch_array($result)){
            array_push($json_result, array("mag_idx" => $row['mag_idx'], "mag_cate" => $row['mag_cate'], "mag_img1" => $row['mag_img1'], "mag_img2" => $row['mag_img2'], "mag_title" => $row['mag_title'], "mag_issue" => $row['mag_issue'], "mag_price" => $row['mag_price'],  "mag_desc" => $row['mag_desc'],  "mag_date" => $row['mag_date'])); // 첫번째 파라미터: 대상 배열, 두번째 파라미터는 배열 입력값
        }
        echo json_encode($json_result);
        
    }

    function print_cate($conn, $page, $get_cate){
            
        // $page_info = cate_page_num($conn, $get_cate);
        $get_cate=$_GET['cate'];
        $start_data = ($page - 1)*10;
        $sql = "SELECT * FROM magb_magazine WHERE mag_cate = '$get_cate' ORDER BY mag_idx DESC LIMIT $start_data, 10"; 
        $result = mysqli_query($conn, $sql); 

        $json_result = array(); 
        while($row = mysqli_fetch_array($result)){
            array_push($json_result, array("mag_idx" => $row['mag_idx'], "mag_cate" => $row['mag_cate'], "mag_img1" => $row['mag_img1'], "mag_img2" => $row['mag_img2'], "mag_title" => $row['mag_title'], "mag_issue" => $row['mag_issue'], "mag_price" => $row['mag_price'],  "mag_desc" => $row['mag_desc'],  "mag_date" => $row['mag_date'])); // 첫번째 파라미터: 대상 배열, 두번째 파라미터는 배열 입력값
        }
        echo json_encode($json_result);
        // echo json_encode(array("cate" => 'abc'));
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