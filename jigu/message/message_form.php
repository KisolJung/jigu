<html>
<head>
<meta charset="utf-8">
<title>message 보내기</title>
<link rel="stylesheet" type="text/css" href="../resource/css/common.css">
<link rel="stylesheet" type="text/css" href="../resource/css/board.css">
<link rel="stylesheet" type="text/css" href="../resource/css/message.css">
<script>
  function check_input() {
  	  if (!document.message_form.rv_id.value)
      {
          alert("수신 아이디를 입력하세요!");
          document.message_form.rv_id.focus();
          return;
      }
      if (!document.message_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.message_form.subject.focus();
          return;
      }
      if (!document.message_form.content.value)
      {
          alert("내용을 입력하세요!");
          document.message_form.content.focus();
          return;
      }
      document.message_form.submit();
   }
</script>
</head>
<body>
<header>
    <?php include "../resource/chkSessionX.php";?>
</header>
  <?php
  $mode = $_GET["mode"];
  $rv_user_nick = $_GET["rv_user_nick"];
  ?>
<section>
	<div id="main_img_bar">
        <img src="../resource/img/universe.png">
    </div>
   	<div id="message_box">
	    <h3 id="write_title">
	    		쪽지 보내기
		</h3>

	    <form  name="message_form" method="post" action="message_insert.php?send_id=<?=$user_id?>">
	    	<div id="write_msg">
	    	    <ul>
				<li>
					<span class="col1">보내는 사람 : </span>
					<span class="col2"><?=$nickname?></span>
				</li>
				<li>
					<span class="col1">수신 아이디 : </span>
          <?php if($mode == "new"){
            echo "<span class='col2'><input name='rv_nick'></span>";
              echo "<button type='button' onclick='check_name()'>중복확인</button>";
          }else{
              ?>
              <input name="rv_nick" hidden value="<?=$rv_user_nick?>">
    					<span class="col2"><?=$rv_user_nick?></span>
              <?php
          }?>

				</li>

        <li>
          <span class="col1">제목 : </span>
          <span class="col2">
            <input name="title">
          </span>
        </li>

	    		<li id="text_area">
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	    <button type="button" onclick="check_input()">보내기</button>
	    	</div>
	    </form>


      <ul class="buttons">
				<li><button onclick="location.href='./message_box.php?mode=rv'">수신 쪽지함</button></li>
				<li><button onclick="location.href='./message_box.php?mode=send'">송신 쪽지함</button></li>
        
			</ul>
	</div> <!-- message_box -->
</section>
<footer>
    <?php include "../resource/footer.php";?>
</footer>

<script>
function check_name() {
 window.open("message_rv_check.php?nick=" + document.message_form.rv_nick.value,
		 "NicknameCheck",
			"left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
}
function check_input() {
    if (!document.message_form.rv_nick.value)
    {
        alert("수신 아이디를 입력하세요!");
        document.message_form.rv_nick.focus();
        return;
    }
    if (!document.message_form.title.value)
    {
        alert("내용을 입력하세요!");
        document.message_form.title.focus();
        return;
    }
    if (!document.message_form.content.value)
    {
        alert("내용을 입력하세요!");
        document.message_form.content.focus();
        return;
    }
    document.message_form.submit();
 }
</script>
</body>
</html>
