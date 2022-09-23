<?php
    include "../db.php";
    session_start();
    // $sql = "INSERT INTO board (name, id, pw) VALUES ('$join_name','$join_id','$join_pw') ";
    // $data_ok = mq($sql);

    $cate = $_GET['cate'];
    $search = $_GET['search'];
    $date1 = $_GET['date1'];
    $date2 = $_GET['date2'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" href="./css/style.css" />
    <script>
        function info() {
            var opt = document.getElementById("search_opt");
            var opt_val = opt.options[opt.selectedIndex].value;
            var info = ""
            if (opt_val=='title'){
                info = "제목을 입력하세요.";
            } else if (opt_val=='content'){
                info = "내용을 입력하세요.";
            } else if (opt_val=='name'){
                info = "작성자를 입력하세요.";
            }
            document.getElementById("search_box").placeholder = info;
        }
    </script>
</head>
<body>
    <div class="board_area">
    <div class=head>검색결과 | <?=$cate?> | <?=$search?></div>
    <?php
    if($date1 && $date2){ ?>
        <span class=from_to><?=$date1?> ~ <?=$date2?></span> <?php
    } ?>
    <table style="width:1000px;" class=middle>
        <thead >
            <tr align=center>
                <th width=70>Post ID</th>
                <th width=300>제목</th>
                <th width=120>작성자</th>
                <th width=120>작성일</th>
                <th width=70>조회수</th>
                <th width=70>💜</th>
            </tr>
        </thead>
        <?php

            if(isset($_GET['page'])){
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            if($date1 && $date2){
                $sql = "SELECT * FROM board WHERE $cate LIKE '%$search%' AND written BETWEEN '$date1' AND '$date2'";
            } else {
                $sql = "SELECT * FROM board WHERE $cate LIKE '%$search%'";
            }

            $res = mq($sql);

            $total_post = mysqli_num_rows($res);
            $per = 5;

            $start = ($page-1)*$per;
        
            if($date1 && $date2){
                $sql_page = "SELECT * FROM board WHERE $cate LIKE '%$search%' AND written BETWEEN '$date1' AND '$date2' ORDER BY id DESC limit $start, $per";
            } else {
                $sql_page = "SELECT * FROM board WHERE $cate LIKE '%$search%' ORDER BY id DESC limit $start, $per";
            }

            $res_page = mq($sql_page);

            while($row = mysqli_fetch_array($res_page)){
        ?>
            <tbody>
                <tr align=center>
                    <td><?php echo $row['idx'];?></td>
                    <td width="500"><a href="./read.php?idx=<?php echo $row["idx"]; ?>"><?php echo $row["title"]; ?></a>
                    </td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['written'];?></td>
                    <td><?php echo $row['hit'];?></td>
                    <td><?php echo $row['liked'];?></td>
                </tr>
            </tbody>
        <?php }

            if(!$many = mysqli_num_rows($res)){ ?>
                <tbody>
                <tr style="color:hotpink;" align=center>
                    <td>검</td>
                    <td>색</td>
                    <td>결</td>
                    <td>과</td>
                    <td>없</td>
                    <td>음</td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
    <div class=bottom>
    <?php
        if($page > 1){
            echo "<a href=\"search.php?page=1&cate=$cate&search=$search&date1=$date1&date2=$date2\">[처음] </a>";
        }
        if($page > 1){
            $pre = $page - 1;
            echo "<a href=\"search.php?page=$pre&cate=$cate&search=$search&date1=$date1&date2=$date2\">이전 </a>";
        }
        $total_page = ceil($total_post / $per);
        $page_num = 1;
        while($page_num <= $total_page){
            if($page==$page_num){
                echo "<a style=\"color:hotpink;\" href=\"search.php?page=$page_num&cate=$cate&search=$search&date1=$date1&date2=$date2\">$page_num </a>";
            } else {
            echo "<a href=\"search.php?page=$page_num&cate=$cate&search=$search&date1=$date1&date2=$date2\">$page_num </a>"; }
            $page_num++;
        }
        if($page < $total_page){
            $next = $page + 1;
            echo "<a href=\"search.php?page=$next&cate=$cate&search=$search&date1=$date1&date2=$date2\">다음 </a>";
        }
        if($page < $total_page){
            echo "<a href=\"search.php?page=$total_page&cate=$cate&search=$search&date1=$date1&date2=$date2\">[끝]</a>";
        }
    ?>
    </div>
    <div class=search>
    <form method="get" action="search.php">
        <select name="cate" id="search_opt" onchange="info()">
            <option value=title>제목</option>
            <option value=content>내용</option>
            <option value=name>작성자</option>
        </select>
        <input class=textform type=text name=search id="search_box" autocomplete="off" value="<?=$search?>" placeholder="제목을 입력하세요." required>
        <input class=submit type=submit value=검색>
        <p>
        <input type=date value="<?=$date1?>" name=date1>
        ~
        <input type=date value="<?=$date2?>" name=date2>
        </p>
    </form>
    </div>
    </div>
</body>
</html>
