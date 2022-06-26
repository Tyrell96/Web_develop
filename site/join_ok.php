<?php 
    include "../db.php";
    
    $join_name = $_POST['join_name'];
    $join_id = $_POST['join_id'];
    $join_pw = $_POST['join_pw'];

    function AES_Encode($plain_text) {
    global $key;
    return base64_encode(openssl_encrypt($plain_text, "aes-256-cbc", $key, true, str_repeat(chr(0), 16)));
    }

    $pass = AES_Encode($join_pw);
    //신규 회원정보 삽입 + ID 재정렬
    $sql = "INSERT INTO board (name, id, pw) VALUES ('$join_name','$join_id','$join_pw') ";
    $data_ok = mq($sql);
    
    if($data_ok){
        echo "<script>alert('회원가입이 완료되었습니다.');";
        echo "window.location.replace('login.php');</script>";
        exit;
    }
    else{
        echo "<script>alert('저장에 문제가 생겼습니다. 관리자에게 문의해주세요.');";
        echo mysqli_error(mq());
    }
?>
<meta http-equiv="refresh" content="0;url=main.php">
