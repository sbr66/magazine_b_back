<?php
    session_start();
    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
        $useridx = $_SESSION['useridx'];
        $userlevel = $_SESSION['userlevel'];
        // echo json_encode(array("userid" => $_SESSION['userid'], "user_idx" => $_SESSION['useridx']));
    }else{
        $userid = "guest";
        $useridx = -1;
        $userlevel = null;
        // echo json_encode(array("userid" => "guest"));
    }

    // if(isset($_SESSION['cart'])){
    //     $cart_count = count($_SESSION['cart']); // 세션으로 저장된 카트의 개수
    // } else {
    //     $cart_count = 0;
    // }

    echo json_encode(array("userid" => $userid, "user_idx" => $useridx, "user_level" => $userlevel));
?>