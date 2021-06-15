<?php
    $id = $_GET["id"];

    $title = $_POST["title"];
    $content = $_POST["content"];
    $board_id = $_POST["board_id"];

    require "../resource/sqlConn.php";
    $sql = "update answer set title='$title', content='$content' ";
    $sql .= " where id=$id";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	      <script>
	          location.href = '../board/board_view.php?id=$board_id';
	      </script>
	  ";
?>
