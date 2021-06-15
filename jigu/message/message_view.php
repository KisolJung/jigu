<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>메세지 자세히 확인</title>
<link rel="stylesheet" type="text/css" href="../resource/css/common.css">
<link rel="stylesheet" type="text/css" href="../resource/css/message.css">
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
   	<div id="message_box">
	    <h3 class="title">
<?php
	$mode = $_GET["mode"];
	$id  = $_GET["id"];

	require "../resource/sqlConn.php";
	$sql = "select * from message where id=$id";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
  $send_id = $row["user_id"];
	$rv_user_id = $row["rv_user_id"];
  $send_at = substr($row["send_at"], 0, 10);
	$title    = $row["title"];
	$content    = $row["content"];

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	if ($mode=="send")
		$result2 = mysqli_query($con, "select nickname from users where id=".$rv_user_id);
	else
		$result2 = mysqli_query($con, "select nickname from users where id=".$send_id);

	$record = mysqli_fetch_array($result2);
	$msg_name = $record["nickname"];

	if ($mode=="send")
	    echo "송신 쪽지 내용";
	else
		echo "수신 쪽지 내용";
?>
		</h3>
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$title?></span>

				<span class="col2">
          <?php
          if ($mode=="send")
        	    echo $msg_name." | ".$send_at;
        	else
        		echo "$msg_name";
          ?>
        </span>
			</li>
			<li>
				<?=$content?>
			</li>
	    </ul>

	    <ul class="buttons">
				<li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
				<li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>

        <?php
        if ($mode=="rv")
            echo "<li><button onclick='go_answr()'>답장</button></li>";
        ?>


		</ul>
	</div> <!-- message_box -->
</section>
<footer>

    <?php include "../resource/footer.php";?>
</footer>
  <?php
    $sql = "update message set is_watched = 1 where id=".$id." and rv_user_id=".$user_id;
    mysqli_query($con, $sql);
    ?>
</body>
<script>
function go_answr(){
  location.href="message_form.php?mode=rsp&rv_user_nick=<?=$msg_name?>";
}
</script>
</html>
