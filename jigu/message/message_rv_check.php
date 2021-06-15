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
<h3>유저 확인</h3>
<p>
<?php
  $rv_user_nick = $_GET['nick'];
   if(!$rv_user_nick)
   {
      echo("<li>입력해 주세요!</li>");
   }
   else
   {
      require "../resource/sqlConn.php";


      $sql = "select * from users where nickname='$rv_user_nick'";
      $result = mysqli_query($con, $sql);

      $num_record = mysqli_num_rows($result);

      if ($num_record)
      {
         echo "<li>".$rv_user_nick." 에게 메세지를 보낼 수 있습니다</li>";
      }
      else
      {
        echo "<li>".$rv_user_nick." 는 존재하지 않습니다.</li>";
        echo "<li>다른 아이디를 입력해 주세요!</li>";
      }

      mysqli_close($con);
   }
?>
</p>
<div id="close">
   <img src="../resource/img/close.png" onclick="javascript:self.close()">
</div>
</body>
</html>
