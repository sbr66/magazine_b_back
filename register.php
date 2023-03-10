<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/dbconn.php';
//    include_once $_SERVER['DOCUMENT_ROOT'].'/magazine_b_back/error.php';

// $req_sign=$_POST['req_sign']; 

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['req_sign'] == 'signup'){
    signup($conn);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['req_sign'] == 'signin'){
    signin($conn);
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['q']) && $_GET['q'] == 'signout'){
    signout();
}

function signup($conn){ // 회원가입 처리 함수
    // 포스트 변수 할당
    $name = $_POST['name'];
    $id = $_POST['id'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $level = 9;

    $pwd = password_hash($pwd, PASSWORD_DEFAULT);

    // echo json_encode(array("name" => var_dump($conn)));

    // sql 입력 명령어 작성
    $sql = "INSERT INTO magb_user (user_name, user_id, user_email, user_pass, user_level) VALUES (?,?,?,?,?)";

    //stmt init 참조 :https://www.w3schools.com/Php/func_mysqli_stmt_init.asp
    $stmt = $conn->stmt_init();

    if(!$stmt->prepare($sql)){
        http_response_code(400);
        echo json_encode(array("err message" => "Database insert fail."));
    }

    $stmt -> bind_param("sssss", $name, $id, $email, $pwd, $level);
    $stmt -> execute();
    
    if($stmt->affected_rows > 0){
        http_response_code(200);
        echo json_encode(array("msg" => "Sign UP Successfully!"));
    }else{
        http_response_code(400);
        echo json_encode(array("msg"=>"Sign Up fail!"));
    }

    // echo json_encode(array("name" => $name, "pwd"=>$pwd));
    
    // echo json_encode(array("name" => $name, "id" => $id, "email" => $email, "pwd" => $pwd)); // 문자열을 json 변수로 반환한다. 파라미터에는 반드시 배열이 있어야한다.
}

function signin($conn){

    // 로그인 로직
    // 1. 받아온 아이디와 데이터 베이스에 존재하는 아이디 비교
    // 2. 아이디가 없으면 없다는 메세지 전달
    // 3. 아이디가 존재하면 비밀번호와 데이터베이스에 존재하는 비밀번호 비교
    // 4. 비밀번호가 일치하지 않으면 없는 비번 메세지 전달
    // 5. 비밀번호가 일치하면 필요한 값 세션 저장

    $userid = $_POST['id'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT * FROM magb_user WHERE user_id=?";
    $stmt = $conn->stmt_init();
    
    $stmt->prepare($sql);
    $stmt->bind_param('s',$userid);
    $stmt->execute();
    
    $result=$stmt->get_result();

    if(!mysqli_num_rows($result)){
        echo json_encode(array("login_msg" => "존재하지 않는 아이디 입니다."));
    }else{
        $login_data = $result->fetch_array(); // 회원 데이터 전체 추출하여 저장

        $pwd_valid = password_verify($pwd, $login_data['user_pass']); // 입력된 데이터(첫번째 파라미터)와 DB의 해시 데이터(두번째 파라미터)를 비교하여 boolan값으로 반환
        
        if(!$pwd_valid){
            echo json_encode(array("login_msg" => "비밀먼호가 일치하지 않습니다."));
        }else{
            
            $_SESSION['userid'] = $userid;
            $_SESSION['useridx']= $login_data['user_idx'];
            $_SESSION['userlevel']= $login_data['user_level'];
            echo json_encode(array("userid" => $_SESSION['userid'], "useridx" => $_SESSION['useridx'], "userlevel" => $_SESSION['userlevel']));
        }

        //echo json_encode(array("userid" => $pwd_valid));
        //echo json_encode(array("userid" => $login_data));
    }

    //echo $userid, $pwd;
    //echo json_encode(array("userid" => mysqli_num_rows($result)));
} // 로그인 처리 함수

function signout(){
    if(isset($_SESSION['userid'])){
        session_unset();
        session_destroy();
        echo json_encode(array("userid" => "guest"));
        
    }

} // 로그아웃 처리 함수
?>
