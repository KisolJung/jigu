<meta charset="utf-8">
<?php
  require '/usr/local/bin/vendor/autoload.php';
    require "../resource/getSession.php";
    include "../resource/points.php";

    $title = $_POST["title"];
    $content = $_POST["content"];
    $point = $_POST["point"];
    $category_id = $_POST["category_id"];
    if($point == null) {
      $point = 0;
    }

	$title = htmlspecialchars($title, ENT_QUOTES);
	$content = htmlspecialchars($content, ENT_QUOTES);



	require "../resource/sqlConn.php";

	$sql = "insert into board (title, content, point, user_id, category_id) ";
	$sql .= "values('$title','$content',".$point.",".$user_id.", ".$category_id.")";
	mysqli_query($con, $sql);

  $point_up = $boardInsertPoint - $point;

	$sql = "update users set point=point+'$point_up' where id='$user_id'";
	mysqli_query($con, $sql);

	mysqli_close($con);

	echo "
	   <script>
	    location.href = './board_list.php';
	   </script>
	";
?>
