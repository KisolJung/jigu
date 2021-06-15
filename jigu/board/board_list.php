<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>board</title>
<link rel="stylesheet" type="text/css" href="../resource/css/common.css">
<link rel="stylesheet" type="text/css" href="../resource/css/board.css">
</head>
<body>
<header>
    <?php include "../resource/menubar.php";?>
</header>
<section>
	<div id="main_img_bar">
        <img src="../resource/img/universe.png">
    </div>
    <?php
    if (isset($_GET["page"]))
  		$page = $_GET["page"];
  	else
  		$page = 1;

      if (isset($_GET["search_by"])){
        $search_by = $_GET["search_by"];
      }
      else{
        $search_by = "all";
      }

      if (isset($_GET["keyword"])){
        $keyword = $_GET["keyword"];
      }
      else{
        $keyword = "";
      }
    ?>
   	<div id="board_box">
      <h3 style="text-align: center; height: 50px;">
	    	질문 검색 <input type="text" name="keyword" style="font-size: 30px;" value="<?=$keyword?>">
        <select name="search_by" id="search_by">
          <option value="all" <?php if($search_by=="all") echo "selected" ?> >전체</option>
          <option value="title" <?php if($search_by=="title") echo "selected" ?>>제목</option>
          <option value="content" <?php if($search_by=="content") echo "selected" ?>>내용</option>
          <option value="writer" <?php if($search_by=="writer") echo "selected" ?>>작성자</option>
        </select>
        <button onclick="search()">검색</button>
		</h3>
	    <h3>
	    	질문 목록
		</h3>
	    <ul id="board_list">
				<li>
					<span class="col1">글 번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col4">추천수</span>
					<span class="col5">등록일</span>
          <span class="col5">수정일</span>
					<span class="col6">조회</span>
          <span class="col6">포인트</span>
          <span class="col7">답변수</span>
          <span class="col7">채택</span>
				</li>
<?php



	include "../resource/sqlConn.php";
	$sql = "select b.*,u.nickname, (select count(*) from answer where board_id = b.id) as answer_count";
  $sql .= " from board b join users u where b.is_deleted = 0 and b.user_id = u.id";
  if(isset($_GET["keyword"])){
    $keyword = "%".$_GET["keyword"]."%";
    if($search_by == "title"){
        $sql .= " and b.title LIKE '$keyword'";
    }else if($search_by == "content"){
        $sql .= " and b.content LIKE '$keyword'";
    }else if($search_by == "writer"){
        $sql .= " and u.nickname LIKE '$keyword'";
    }else{
        $sql .= " and ( b.title LIKE '$keyword'";
        $sql .= " or b.content LIKE '$keyword'";
        $sql .= " or u.nickname LIKE '$keyword')";
        $sql .= " group by b.id";
    }

  }
  $sql .= " order by b.id desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 5; //몇개씩 보여줄까

	// 전체 페이지 수($total_page) 계산
	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale) + 1;

	// 표시할 페이지($page)에 따라 $start 계산
	$start = ($page - 1) * $scale;

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
	  //$num         = $row["num"];
	  $id          = $row["id"];
	  $writer_id        = $row["user_id"];
    $writer = $row["nickname"];
    $title     = $row["title"];
    $created_at  = $row["created_at"];
    $created_at = substr($created_at,0,10);
    $updated_at  = $row["updated_at"];
    $updated_at = substr($updated_at,0,10);
    $hits         = $row["hits"];
    $views         = $row["views"];
    $point         = $row["point"];
    $answer_count         = $row["answer_count"];
    $is_selected         = $row["is_selected"];
    if($is_selected == 1){
      $is_selected = 'O';
    }else{
      $is_selected = 'X';
    }

    /*
      if ($row["file_name"])
      	$file_image = "<img src='../resource/img/file.gif'>";
      else
      	$file_image = " ";
        //<span class="col4"><?=$file_image?></span>
        */
?>
				<li>
					<span class="col1"><?=$id?></span>
					<span class="col2"><a href="./board_view.php?id=<?=$id?>&page=<?=$page?>"><?=$title?></a></span>
					<span class="col3"><?=$writer?></span>
          <span class="col4"><?=$hits?></span>
					<span class="col5"><?=$created_at?></span>
          <span class="col5"><?=$updated_at?></span>
					<span class="col6"><?=$views?></span>
          <span class="col6"><?=$point?></span>
          <span class="col7"><?=$answer_count?></span>
          <span class="col7"><?=$is_selected?></span>
				</li>
<?php
   	   $number--;
   }
   mysqli_close($con);

?>
	    	</ul>
			<ul id="page_num">
<?php
	if ($total_page>=2 && $page >= 2)
	{
		$new_page = $page-1;
		echo "<li><a href='board_list.php?page=$new_page'> &nbsp; ◀ 이전</a> </li>";
	}
	else
		echo "<li>&nbsp;&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='board_list.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)
   	{
		$new_page = $page+1;
		echo "<li> <a href='board_list.php?page=$new_page'>다음 ▶ &nbsp;</a> </li>";
	}
	else
		echo "<li>&nbsp;&nbsp;</li>";
?>
			</ul> <!-- page -->
			<ul class="buttons">
				<li>

          <button onclick="location.href='board_form.php'">글쓰기</button>

				</li>
			</ul>
	</div>
</section>
<footer>
    <?php include "../resource/footer.php";?>
</footer>
</body>
<script>
function search(){
  var keyword = document.getElementsByName("keyword")[0].value;
  var search_by = document.getElementById("search_by");
  var search = search_by.options[search_by.selectedIndex].value;

  location.href = "board_list.php?keyword="+keyword+"&page=1&search_by="+search;
}
</script>
</html>
