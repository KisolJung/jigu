<?php
    $account = $_GET["account"];

    $password = $_POST["password"];
    $nickname = $_POST["nickname"];

    require "../resource/sqlConn.php";
    $sql = "update users set password='$password', nickname='$nickname' ";
    $sql .= " where account='$account'";
    mysqli_query($con, $sql);

    mysqli_close($con);

    session_start();
    $_SESSION["account"]=$account; $_SESSION["nickname"]=$nickname;

    echo "
	      <script>
	          location.href = '../main/index.php';
	      </script>
	  ";
?>
