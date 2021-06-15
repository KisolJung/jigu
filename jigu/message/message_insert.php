<meta charset='utf-8'>
<?php

  require "../resource/getSession.php";
  require "../resource/sqlConn.php";

  $rv_user_nick = $_POST['rv_nick'];
  $content = $_POST['content'];
  $content = htmlspecialchars($content, ENT_QUOTES);
  $title = $_POST['title'];
  $title = htmlspecialchars($title, ENT_QUOTES);

	if(!$user_id) {
		echo("
			<script>
			alert('로그인 후 이용해 주세요! ');
			history.go(-1)
			</script>
			");
		exit;
	}else{
    $sql = "select * from users where nickname='$rv_user_nick'";
  	$result = mysqli_query($con, $sql);
  	$num_record = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

  	if($num_record)
  	{
      $rv_user_id = $row["id"];
  		$sql = "insert into message (user_id, rv_user_id, title, content) ";
  		$sql .= "values(".$user_id.", ".$rv_user_id.", '$title','$content')";
  		mysqli_query($con, $sql);
  	} else {
  		echo("
  			<script>
  			alert('수신자 아이디가 잘못 되었습니다!');
  			history.go(-1);
  			</script>
  			");
  		exit;
  	}

  }

	mysqli_close($con);

	echo "
	   <script>
	    location.href = './message_box.php?mode=send';
	   </script>
	";
?>
