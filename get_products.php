<?php
   include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/dbconn.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/error.php';
   $get_cate=$_GET['cate'];

   if(!isset($get_cate)){
           if(isset($_GET['page'])){
            printpage($_GET['page']);
        } else {
            printpage(1);
        }
   } else {
    print_cate($conn); 
   }
    
    // if($_GET['cate'] == null){
    //     if(isset($_GET['page'])){
    //         printpage($_GET['page']);
    //     } else {
    //         printpage(1);
    //     }
    // }else{
        
    // }

    function printpage(int $page){
        // include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/dbconn.php';

        // $start_data = ($page - 1)*10;
        // $sql = "SELECT * FROM magb_magazine ORDER BY mag_idx DESC LIMIT $start_data, 10";
        // $result = mysqli_query($conn, $sql);
    
        // $json_result = array(); 
        // while($row = mysqli_fetch_array($result)){
        //     array_push($json_result, array("mag_idx" => $row['mag_idx'], "mag_cate" => $row['mag_cate'], "mag_img1" => $row['mag_img1'], "mag_img2" => $row['mag_img2'], "mag_title" => $row['mag_title'], "mag_issue" => $row['mag_issue'], "mag_price" => $row['mag_price'],  "mag_desc" => $row['mag_desc'],  "mag_date" => $row['mag_date'])); // 첫번째 파라미터: 대상 배열, 두번째 파라미터는 배열 입력값
        // }
        // echo json_encode($json_result);
        
    }

    function print_cate($conn){

        $get_cate=$_GET['cate'];

        $sql = "SELECT * FROM magb_magazine WHERE mag_cate = '$get_cate'"; 
        $result = mysqli_query($conn, $sql); 

        $json_result = array(); 
        while($row = mysqli_fetch_array($result)){
            array_push($json_result, array("mag_idx" => $row['mag_idx'], "mag_cate" => $row['mag_cate'], "mag_img1" => $row['mag_img1'], "mag_img2" => $row['mag_img2'], "mag_title" => $row['mag_title'], "mag_issue" => $row['mag_issue'], "mag_price" => $row['mag_price'],  "mag_desc" => $row['mag_desc'],  "mag_date" => $row['mag_date'], "cate"=>$get_cate)); // 첫번째 파라미터: 대상 배열, 두번째 파라미터는 배열 입력값
        }
        echo json_encode($json_result);
        // echo json_encode(array("cate" => 'abc'));
    }
   

?>