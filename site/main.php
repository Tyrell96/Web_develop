<?php session_start(); ?>
<!doctype html>


<html lang="ko">

<head>
    <div class="title">
    <link rel="stylesheet" href="./css/style.css" ; <title>Tyrell</title>
    </div>
</head>

<body>
    <div class="center">
    <h1>메인 페이지 test</h1>

    <?php 
    if(isset($_SESSION['user_id'])) {
            $user_name = $_SESSION['name'];
            echo "<p>$user_name 님 환영합니다.</p>";
            echo "<p><button onclick=\"location.href='logout.php'\">로그아웃</button></p>";
            echo "<p><button onclick=\"location.href='mypage.php'\">마이페이지</button></p>";
            echo "<p><button onclick=\"location.href='board.php'\">게시판</button></p>";
            
    }
    else{
        
        echo "<p> 로그인이 필요합니다.</p><br>";
        echo "<p><button onclick=\"window.location.href='login.php'\">로그인
            </button> <button onclick=\"window.location.href='join.php'\">회원 가입 </button></p>";
        
        }
    ?>
    </div>
</body>

</html>