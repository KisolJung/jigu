<meta charset="utf-8">
<script>
function go_board(){
  alert('답변을 달아 <?=$answerInsertPoint?>point 적립되었습니다.');
  location.href = "../board/board_view?id='<?=$board_id?>'";
}
</script>
<?php
  require '/usr/local/bin/vendor/autoload.php';
    require "../resource/getSession.php";
    include "../resource/points.php";

    $title = $_POST["title"];
    $content = $_POST["content"];
    $board_id = $_POST["board_id"];
    $is_hided = 0;
    if(isset($_POST['is_hided'])){
    $is_hided = 1;
}

    $title = htmlspecialchars($title, ENT_QUOTES);
  	$content = htmlspecialchars($content, ENT_QUOTES);

    require "../resource/sqlConn.php";

  	$sql = "insert into answer (title, content, user_id, board_id, is_hided) ";
  	$sql .= "values('$title', '$content', ".$user_id.", ".$board_id.", ".$is_hided.")";
  	mysqli_query($con, $sql);


  	$sql = "update users set point=point+'$answerInsertPoint' where id='$user_id'";
  	mysqli_query($con, $sql);

  	mysqli_close($con);

  	echo "
  	   <script>
  	    alert('답변을 달아 $answerInsertPoint point 적립되었습니다.');
        location.href = '../board/board_view.php?id=$board_id';
  	   </script>
  	";

?>
