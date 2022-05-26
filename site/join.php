<!DOCTYPE html>
<?php session_start(); ?> //
<html lang="ko">
    <head>
    
    <link rel="stylesheet" href="./style.css">
	<meta charset="UTF-8">
    <title>join</title>

    </head>
    <body>
    
    <h2>회원가입</h2>
    <?php if(!isset($_SESSION['user_id'])) { ?>
        <form method="post" action="join_ok.php" autocomplete="off">
            <p><input type="text" name="join_name" placeholder="Name"required></p>
            <p><input type="text" name="join_id" placeholder="ID"required></p>
            <p><input type="password" name="join_pw" placeholder="password" required></p>
            <p><input type="submit" value="가입하기"></p>
        </form>
    <?php } else {
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];
        echo "<p>$user_name($user_id)님은 이미 로그인되어 있습니다.";
        echo "<p><button onclick=\"window.location.href='main.php'\">메인으로</button> <button onclick=\"window.location.href='logout.php'\">로그아웃</button></p>";
    
    } ?>

    </body>
</html>