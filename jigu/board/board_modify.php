<?php
    $id = $_GET["id"];

    $title = $_POST["title"];
    $content = $_POST["content"];

    require "../resource/sqlConn.php";
    $sql = "update board set title='$title', content='$content' ";
    $sql .= " where id=$id";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'board_view.php?id=$id';
	      </script>
	  ";
?>
