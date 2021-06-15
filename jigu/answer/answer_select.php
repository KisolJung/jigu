<?php
    $id = $_GET["id"];
    $board_id = $_GET["board_id"];

    require "../resource/sqlConn.php";

    $sql = "update board set is_selected = 1 where id=$board_id";
    mysqli_query($con, $sql);

    $sql = "update answer set is_selected = 1 where id=$id";
    mysqli_query($con, $sql);


    $sql = "select * from answer where id=$id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $selected_writer_id = $row["user_id"];

    $sql = "select * from board where id=$board_id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $point = $row["point"];


    $sql = "update user set point = point + $point where id=$selected_writer_id";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	      <script>
            alert('답변이 채택되었습니다.');
	          location.href = '../board/board_view.php?id=$board_id';
	      </script>
	  ";
?>
