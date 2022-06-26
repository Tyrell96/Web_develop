<?php include "../db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/style.css">
    <meta charset="UTF-8">
    <title>Mypage</title>
</head>
<body>
    <?php session_start();
    if(isset($_session['login_id'])){?>
        <script>
            alert("잘못된 접근입니다.")
            window.location.href = "./main.php";
        </script>
    <?php
    }
    $user_id =$_SESSION['user_id'];
    $sql = "select * from log where id=$user_id ";
    $data = mq($sql) -> fetch_array();
    ?>
    <div class="mypage">
    
        <h1>개인 정보</h1>
        <form method='POST' action='mypage_update.php'>
        <input type='text' name='mypage_id' placeholder='<?=$data["id"]?>' disabled/><br>
        <input type='text' name='mypage_birth' placeholder='<?=$data["birthday"]?>'/><br>
        <input type='password' name='mypage_pw' placeholder='새로운 비밀번호 입력'/><br>
        <button type='submit' value="Update">Update</button>
        
        </form>
    </div>
    </body>
    </html>