<?php

    if(isset($_GET['page'])){
        printpage($_GET['page']);
    } else {
        printpage(1);
    }
    function printpage(int $page){
        include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/dbconn.php';

        $start_data = ($page - 1)*10;
        $sql = "SELECT * FROM magb_magazine ORDER BY mag_idx DESC LIMIT $start_data, 10"; //DESC:역순, ASC:정순(dafalt) 정렬
        $result = mysqli_query($conn, $sql); //  첫번째 파라미터 : 접속정보, 두번째 파라미터 ; 쿼리문
    
    
        $json_result = array(); // 빈 배열 초기화
        while($row = mysqli_fetch_array($result)){
            array_push($json_result, array("mag_idx" => $row['mag_idx'], "mag_cate" => $row['mag_cate'], "mag_img1" => $row['mag_img1'], "mag_img2" => $row['mag_img2'], "mag_title" => $row['mag_title'], "mag_issue" => $row['mag_issue'], "mag_price" => $row['mag_price'],  "mag_desc" => $row['mag_desc'],  "mag_date" => $row['mag_date'])); // 첫번째 파라미터: 대상 배열, 두번째 파라미터는 배열 입력값
        }
        echo json_encode($json_result);
    }
   

?>