<!doctype html>
<html lang="ko">
    <?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="login">
    <?php if(!isset($_session['login_id'])){ ?>
        <form method='post' action="login_ok.php " autocomplete="off">
        <p>Login Page</p><br>
        <p>ID<br>
        <p><input type="text" name='login_id' placeholder="아이디" maxlength="15"/></p>
        <p>Password<br>
        <p><input type="password" name='login_pw' placeholder="비밀번호" maxlength="20"/></p>
        <button type="submit" value="Login"> 로그인</button>
        <button type="button" value="join" onclick="window.location.href='./join.php'">회원가입</button>
        <button type="button" value="main" onclick="window.location.href='./main.php'">메인으로</button>
        </form>
        
    <?php } else{
        $login_name = $_SESSION['name'];
        echo '<script type="text/javascript">';
        echo 'alert("$login_name 님 로그인 상태입니다");';
        echo 'window.location.href = "./main.php";';
        echo '</script>';
    }
    ?>
</body>

</html>