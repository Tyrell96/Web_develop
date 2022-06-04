<?php
    $full = $_GET['full'];

    echo $full;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail</title>
    <script>
        function my_addr(){
            var full = '<?=$full?>';
            var my_addr = full+" "+document.getElementById("detail").value;
            opener.document.getElementById("address").value = my_addr;
            window.close();
        }
    </script> 
</head>
<body>
    <input id="detail" type=text>
    <input type=button value="확인" onclick="my_addr()">
</body>