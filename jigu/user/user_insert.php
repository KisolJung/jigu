<?php
    $account   = $_POST["account"];
    $password = $_POST["password"];
    $nickname = $_POST["nickname"];

    require "../resource/sqlConn.php";

	$sql = "insert into users(account, password, nickname) ";
	$sql .= "values('$account', '$password', '$nickname');";

	mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	      <script>
	          location.href = './login_form.php';
	      </script>
	  ";
?>
