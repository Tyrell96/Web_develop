<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
    include "../db.php";

    $address= $_GET['address'];
    $addr = explode( ' ', $address );
    if($arr[1]){
        $sql = "SELECT * FROM zipcode WHERE DORO='$addr[0]' AND BUILD_NO1='$addr[1]'";
    } else {
        $sql = "SELECT * FROM zipcode WHERE DORO='$addr[0]' ORDER BY BUILD_NO1 ASC";
    }
    $data = mq($sql);
?>
<table>
<?php
    $num=1;
    while($row =  $data -> fetch_array()){
        $full = $row['SIDO']." ".$row['SIGUNGU']." ".$row['DORO']." ".$row['BUILD_NO1']." ".$row['BUILD_NM']; ?>
        <tbody>
            <td><?=$num?></td>
            <td><a href="detail.php?full=<?=$full?>"><?=$full?></a></td>
            <td><?=$address?></td>
        </tbody> <?php
        $num++;
    }
?>
</table>
</body>
</html>