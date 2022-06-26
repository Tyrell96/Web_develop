<?php
    include "../db.php";
    $uid = $_GET["userid"];
    $sql = "select * from log where id='$uid'";
    $data = mq($sql) -> fetch_array();
    
    if(!$data){
        echo("$uid 는 사용가능한 아이디입니다.");
    }   else{
        echo("$uid 는 사용불가능한 아이디입니다.");
    }


    ?>
    