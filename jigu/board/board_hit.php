<?php

    $id   = $_GET["id"];

    require "../resource/sqlConn.php";
    require "../resource/getSession.php";

    $sql = "select * from hit_log where board_id=$id and user_id = $user_id";
  	$result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);

    //echo $id." ".$total_record." ".$user_id;


    if($total_record > 0){
      $row = mysqli_fetch_array($result);
      $is_deleted = $row["is_deleted"];
      if($is_deleted!=0){
        $sql = "update board set hits = hits + 1, views = views-1 where id = $id";
        mysqli_query($con, $sql);
        $sql = "update hit_log set is_deleted = 0 where board_id = $id and user_id = $user_id";
        mysqli_query($con, $sql);
      }else{
        $sql = "update board set hits = hits - 1, views = views-1 where id = $id";
        mysqli_query($con, $sql);

        $sql = "update hit_log set is_deleted = 1 where board_id=$id and user_id = $user_id";
        mysqli_query($con, $sql);
      }
    }else{
      $sql = "update board set hits = hits + 1, views = views-1 where id = $id";
      mysqli_query($con, $sql);
      $sql = "insert into hit_log (user_id, board_id) ";
      $sql .= "values(".$user_id.", ".$id.")";
      mysqli_query($con, $sql);
    }


    mysqli_close($con);

    echo "
       <script>
        location.href = './board_view.php?id=$id';
       </script>
    ";



?>
