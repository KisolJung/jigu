<html>
<head>
<meta charset="utf-8">
<title>질문 작성</title>
<link rel="stylesheet" type="text/css" href="../resource/css/common.css">
<link rel="stylesheet" type="text/css" href="../resource/css/board.css">

</head>
<body>
<header>
    <?php include "../resource/chkSessionX.php";?>
</header>
<section>
	<div id="main_img_bar">
        <img src="../resource/img/universe.png">
    </div>
   	<div id="board_box">
	    <h3 id="board_title">
	    		답변 작성
		</h3>
    <? $board_id = $_GET["board_id"]; ?>
	    <form  name="answer_form" method="post" action="answer_insert.php" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
          <span class="col2"><?=$nickname?></span>
				</li>
        <li>
          <span> 익명으로 답변: </span>
          <span class="col2"><input type="checkbox" name="is_hided" value = "is_hided" checked></span>
				</li>
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="title" type="text"></span>
	    		</li>

	    		<li id="text_area">
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
            <input type="hidden" name="board_id" value="<?=$board_id?>">
	    		</li>
          <!--
	    		<li>
			        <span class="col1"> 첨부 파일</span>
			        <span class="col2"><input type="file" name="upfile"></span>
			    </li>
        -->
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">작성완료</button></li>
        <li><button type="button" onclick="go_board()">질문으로</button></li>
				<li><button type="button" onclick="location.href='../board/board_list.php'">목록</button></li>
			</ul>
	    </form>
	</div>
</section>
<footer>
    <?php include "../resource/footer.php";?>
</footer>


<script>
  function check_input() {
      if (!document.answer_form.title.value)
      {
          alert("제목을 입력하세요!");
          document.answer_form.title.focus();
          return;
      }
      if (!document.answer_form.content.value)
      {
          alert("내용을 입력하세요!");
          document.answer_form.content.focus();
          return;
      }
      document.answer_form.submit();
   }

   function go_board(){
     location.href="../board/board_view.php?id='<?=$board_id?>'";
   }
</script>
</body>
<style>

</style>
</html>
