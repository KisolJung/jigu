<!DOCTYPE html>
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
<h3>아이디 중복체크</h3>
<p>
<?php
   $nickname = $_GET["nickname"];

   if(!$nickname)
   {
      echo("<li>입력해 주세요!</li>");
   }
   else
   {
      require "../resource/sqlConn.php";


      $sql = "select * from users where nickname='$nickname'";
      $result = mysqli_query($con, $sql);

      $num_record = mysqli_num_rows($result);

      if ($num_record)
      {
         echo "<li>".$nickname." 닉네임은 중복됩니다.</li>";
         echo "<li>다른 닉네임을 사용해 주세요!</li>";
      }
      else
      {
         echo "<li>".$nickname." 아이디는 사용 가능합니다.</li>";
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
