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
	    		글 작성
		</h3>
	    <form  name="board_form" method="post" action="board_insert.php" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$nickname?></span>
				</li>
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="title" type="text"></span>
	    		</li>
          <li>
	    			<span class="col1">포인트 : </span>
	    			<span class="col2"><input name="point" type="text"></span>
	    		</li>
          <li>
            <span class="col1">카테고리 : </span>
            <select name="category_id" id="category">
              <option value="0">없음</option>
              <option value="1">교육</option>
              <option value="2">엔터테인먼트</option>
              <option value="3">예술</option>
              <option value="5">생활</option>
              <option value="6">건강</option>
              <option value="7">사회</option>
              <option value="8">정치</option>
              <option value="9">경제</option>
              <option value="10">고민</option>
            </select>
	    		</li>
	    		<li id="text_area">
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
	    		</li>


	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">작성완료</button></li>
				<li><button type="button" onclick="location.href='./board_list.php'">목록으로</button></li>
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
      if(isNaN(document.board_form.point.value)){
        alert("포인트는 숫자만 입력가능합니다!");
        document.board_form.point.value = "";
        document.board_form.point.focus();
        return;
      }

      document.board_form.submit();
   }
</script>
</body>
<style>

</style>
</html>
