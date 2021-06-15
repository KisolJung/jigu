<?php

    $id   = $_GET["id"];

    require "../resource/sqlConn.php";

    $sql = "update answer set is_deleted = 1 where board_id = $id";
    $sql = "update board set is_deleted = 1 where id = $id";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
          alert('삭제가 완료되었습니다.');
	         location.href = './board_list.php';
	     </script>
	   ";
?>
