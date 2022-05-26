<?php include "../db.php";

$login_id = $_POST['login_id'];
$login_pw = $_POST['login_pw'];
$sql = "select  * from log where id='$login_id' and pw='$login_pw' ";
$data = mq($sql) -> fetch_array();
if($data){
    session_start();
    $_SESSION['user_id'] = $data['id'];
    $_SESSION['name'] = $data['name'];
    echo "<script>alert('로그인에 성공했습니다!');";
    echo "window.location.replace('main.php');</script>";
    exit;
}
    else{
        echo "<script>alert('아이디 혹은 비밀번호가 잘못되었습니다.');";
        echo "window.location.replace('login.php');</script>";
}
?>