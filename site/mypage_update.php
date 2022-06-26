<?php
    include "../db.php";
    $update_id = $_POST['mypage_id'];
    $update_pw = $_POST['mypage_pw'];
    if($_POST['mypage_pw'] != NULL){

        echo $update_id;
        echo "11";
        $sql = "UPDATE log SET pw=$update_pw where id=$update_id";
        $update_ok = mq($sql);
        if($update_ok){
            echo '<script>alert("비밀번호가 업데이트 되었습니다.");';
            echo "window.location.replace('mypage.php');</script>";
            
        } else{
            echo '<script>alert("업데이트 실패.");';
            echo "window.location.replace('mypage.php');</script>";
            
        }
    } else if($_POST['mypage_id']!=NULL){
        $data = mq("select pw from log where id=$mypage_id");
        $mypage_pw = $date['pw'];
    } else {
        echo "<script>alert('업데이트에 실패하였습니다.);";
        echo "window.location.replace('mypage.php');</script>";        
    }
    
    
    
    
?>
