<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>쪽지함</title>
<link rel="stylesheet" type="text/css" href="../resource/css/common.css">
<link rel="stylesheet" type="text/css" href="../resource/css/board.css">
<link rel="stylesheet" type="text/css" href="../resource/css/message.css">
</head>
<body>
<header>
    <?php include "../resource/chkSessionX.php";?>
</header>
<section>
	<div id="main_img_bar">
        <img src="../resource/img/universe.png">
    </div>
   	<div id="message_box">
	    <h3>
<?php
 		if (isset($_GET["page"]))
			$page = $_GET["page"];
		else
			$page = 1;

		$mode = $_GET["mode"];

		if ($mode=="send")
			echo "송신 쪽지함";
		else
			echo "수신 쪽지함";
?>
		</h3>
	    <div>
	    	<ul id="message">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">
<?php
						if ($mode=="send")
							echo "받은이";
						else
							echo "보낸이";
?>
					</span>
					<span class="col4">등록일</span>
          <span class="col3">
            <?php
            if ($mode=="send")
							echo "읽음";
						else
							echo "바로읽기";
            ?>
          </span>
				</li>
<?php
	require "../resource/sqlConn.php";

	if ($mode=="send")
		$sql = "select * from message where user_id=".$user_id." order by id desc";
	else
		$sql = "select * from message where rv_user_id=".$user_id." order by id desc";

	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result);

	$scale = 10;

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
	  $id    = $row["id"];
	  $content     = $row["content"];
    $title     = $row["title"];
      $send_at  = $row["send_at"];
      $is_watched = $row["is_watched"];

	  if ($mode=="send")
	  	$msg_id = $row["rv_user_id"];
	  else
	  	$msg_id = $row["user_id"];

	  $result2 = mysqli_query($con, "select nickname from users where id='$msg_id'");
	  $record = mysqli_fetch_array($result2);
	  $msg_name     = $record["nickname"];
?>
				<li>
					<span class="col1"><?=$id?></span>
					<span class="col2"><a href="./message_view.php?id=<?=$id?>&mode=<?=$mode?>"><?=$title?></a></span>
					<span class="col3"><?=$msg_name?></span>
					<span class="col4"><?=$send_at?></span>
          <span class="col3">
            <?php
            if ($mode=="send"){
              if($is_watched)
                echo "O";
              else
                echo "X";
            }
						else
							echo "<button onclick='go_read($id)' style='padding: 5px;'>읽음처리</button>";
            ?>
          </span>
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
		echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li> <a href='message_box.php?mode=$mode&page=$i'> $i </a> <li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)
   	{
		$new_page = $page+1;
		echo "<li> <a href='message_box.php?mode=$mode&page=$new_page'>다음 ▶</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->
			<ul class="buttons">
        <?php if ($mode=="send"){ ?>
				<li><button onclick="location.href='./message_box.php?mode=rv'">수신 쪽지함</button></li>
      <?php } else { ?>
				<li><button onclick="location.href='./message_box.php?mode=send'">송신 쪽지함</button></li>
        <?php } ?>
				<li><button onclick="location.href='./message_form.php?mode=new&rv_user_nick=0'">쪽지 보내기</button></li>
			</ul>
	</div>
</section>
<footer>
    <?php include "../resource/footer.php";?>
</footer>
</body>
<script>
function go_read(id){
  window.open("message_read.php?id=" + id,
      "NicknameCheck",
       "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
}
</script>
<style>
#message_box { position: relative; width: 900px; margin: 0 auto; }
#message .col2 { width: 310px; text-align: left; }
</style>
</html>
