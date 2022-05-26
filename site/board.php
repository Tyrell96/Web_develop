<?php include "/db.php"; ?>
<!doctype html>

<head>
    <meta charset="utf-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="../index/style.css" />
</head>

<body>
    <div id="board_area">
        <h1>자유게시판</h1>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="70">번호</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="100">조회수</th>
                </tr>
            </thead>
            <?php
            //내림차순으로 5개의 테이블 내용까지 표시
            $sql = mq("select * from board order by idx desc limit 0,5");
            while ($board  = $sql->fetch_array()) {
                $title = $board["title"];
                if (strlen($title) > 30) {
                    $title = str_replace($board["title"], mb_substr($board["title"], 0, 30, "utf-8") . "...", $board["title"]);
                }
            ?>
            <tbody>
                <tr>
                    <td width="70"><?php echo $board['idx']; ?></td>
                    <td width="500"><a
                            href="./Nclass/site/read.php?idx=<?php echo $board["idx"]; ?>"><?php echo $title; ?></a>
                    </td>
                    <td width="120"><?php echo $board['name']; ?></td>
                    <td width="100"><?php echo $board['date']; ?></td>
                    <td width="100"><?php echo $board['hit']; ?></td>
                </tr>
            </tbody>
            <?php } ?>
        </table>

        <div id="write_btn">
            <a href="./write.php"><button> 글쓰기 </button></a>
            <a href="./main.php"><button> 메인 </button></a>
        </div>
    </div>
</body>

</html>