<?php
$id = $_GET['id'];
require "../resource/sqlConn.php";
$sql = "update message set is_watched = 1 where id=".$id;
mysqli_query($con, $sql);
?>


<html>
<head>
<meta charset="utf-8">
<style>
h3 {
   padding-left: 5px;
   border-left: solid 5px #edbf07;
}
#close {
   margin:20px 0 0 80px;
   cursor:pointer;
}
</style>
</head>
<body>
<h3>읽음 확인</h3>
<p>
<?php

   mysqli_close($con);
?>
</p>
<div id="close">
   <img src="../resource/img/close.png" onclick="javascript:self.close()">
</div>
</body>
</html>
