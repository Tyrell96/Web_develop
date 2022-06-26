<!DOCTYPE html>
<?php session_start(); ?>
<html lang="ko">
    <head>
    
    <link rel="stylesheet" href="./css/style.css">
	<meta charset="UTF-8">
    <title>join</title>
    <script>
    function address(){
		url = "./address.php";
		window.open(url,"주소검색",'width=500,height=400, scrollbars=no, resizable=no');
	}
    function dbcheckid(){
        var userid = document.getElementById("join_id").value;
        if(userid){
            url = "dbcheck.php?userid="+userid;
            window.open(url, "아이디중복확인", "width=500,height=400");
        } else {
            alert("아이디를 입력 후 다시 시도해주세요");
        }

    }
    </script>
    </head>
    <body>
    
    <h2>회원가입</h2>
    <?php if(!isset($_SESSION['user_id'])) { ?>
        <form method="post" action="join_ok.php" autocomplete="off">
            <p><div class=subject>Name</div></div><br>
            <p><input type="text" name="join_name" placeholder="Name"required></p>
            <p><div class=subject>ID</div></div><br>
            <input type="text" name="join_id" id="join_id" placeholder="ID"required>
            <button type="button" onclick="dbcheckid()" name="db_checkid">
            중복 확인</button>
            <input type="hidden" name="dbcheck" value="iduncheck"/>
            <p><div class=subject>Password2</div></div><br>
            <p><input type="password" name="join_pw" placeholder="password" required></p>
            <p><div class=subject>Password2</div></div><br>
            <p><input type="password" name='join_pw2' placeholder="password" maxlength="20" required/></p>
            <p><div class=subject>주소</div><br>
            <input class=textform type="text" id="join_addr" name="login_addr" onclick="address();" placeholder="주소를 검색해주세요." required></p>
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