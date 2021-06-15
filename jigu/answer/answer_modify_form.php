<html>
<head>
<meta charset="utf-8">
<title>답변 수정하기</title>
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
   	<div id="board_box">
	    <h3 id="board_title">
	    		질문 수정
		</h3>
<?php
	$id  = $_GET["id"];

	require "../resource/sqlConn.php";
	$sql = "select * from answer where id=$id";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	$writer       = $row["user_id"];
	$title    = $row["title"];
	$content    = $row["content"];
  $board_id    = $row["board_id"];

?>
	    <form  name="board_form" method="post" action="./answer_modify.php?id=<?=$id?>" enctype="multipart/form-data">
	    	 <ul id="board_form">
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="title" type="text" value="<?=$title?>"></span>
	    		</li>
	    		<li id="text_area">
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea>
	    			</span>
	    		</li>

          <input name="board_id" type="hidden" value="<?=$board_id?>">
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">수정 완료</button></li>

			</ul>
	    </form>
	</div>
</section>
<footer>
    <?php include "../resource/footer.php";?>
</footer>

<script>
  function check_input() {
      if (!document.board_form.title.value)
      {
          alert("제목을 입력하세요!");
          document.board_form.title.focus();
          return;
      }
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }

</script>
</body>

</html>
