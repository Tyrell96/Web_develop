<?php include "../db.php"; ?>
<!doctype html>

<head>
    <meta charset="utf-8">
    <title>게시판</title>
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
        <h1>자유게시판</h1>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="70" >번호</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="100">조회수</th>
                </tr>
            </thead>
            <?php
            //내림차순으로 5개의 테이블 내용까지 표시
            $data = mq("select * from board order by idx desc limit 0,5");
            while ($board  = $data->fetch_array()) {
                $title = $board["title"];
                if (strlen($title) > 30) {
                    $title = str_replace($board["title"], mb_substr($board["title"], 0, 30, "utf-8") . "...", $board["title"]);
                }
            ?>
            <tbody>
                <tr>
                    <td width="70"><?php echo $board['idx']; ?></td>
                    <td width="500"><a
                            href="./read.php?idx=<?php echo $board["idx"]; ?>"><?php echo $title; ?></a>
                    </td>
                    <td  width="120"><?php echo $board['name']; ?></td>
                    <td  width="100"><?php echo $board['date']; ?></td>
                    <td  width="100"><?php echo $board['hit']; ?></td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
        <div class="board-center">
        <form method="get" action="search.php">
	        <select name="cate" id="search_opt" onchange="info()">
            <option value=title>제목</option>
            <option value=content>내용</option>
            <option value=name>작성자</option>
	        </select>
	    <input class=textform type=text name=search id="search_box" autocomplete="off" placeholder="제목을 입력하세요." required>
	    <input class=submit type=submit value=검색>
        <p>
            <!-- <input type=date name=date1> -->
            ~
            <!-- <input type=date name=date2> -->
        </p>
</form>
        <div id="write_btn">
            <a href="./write.php"><button> 글쓰기 </button></a>
            <a href="./main.php"><button> 메인 </button></a>
        </div>
        </div>
    </div>
</body>

</html>