<html>
<head>
  <link rel="stylesheet" type="text/css" href="../resource/css/menubar.css">
</head>
<body>
<div>
  <?php
  require "../resource/getSession.php";
  ?>

  <?php
  if($account != null){
  ?>
    <script>alert("이미 가입한 유저는 접근할 수 없습니다."); location.href = "/jigu/main/index.php";</script>
  <?php
  }
  ?>

    <ul class="menumain">
      <li class="menus"><a href="/jigu/main/index.php"><strong>JIGU</strong> </a></li>
      <li class="dropdown" onclick="/jigu/board/board_list.php">
          <a href="javascript:void(0)" class="dropbtn">QUESTION</a>
          <div class="dropdown-content">
              <a href="/jigu/board/board_list.php">질문들</a>
              <a href="/jigu/board/board_form.php">바로 질문하기</a>
          </div>
      </li>
      <li class="dropdown">
          <a href="javascript:void(0)" class="dropbtn">Message</a>
          <div class="dropdown-content">
              <a href="/jigu/message/message_box.php?mode=send">송신쪽지함</a>
              <a href="/jigu/message/message_box.php?mode=rv">수신쪽지함</a>
              <a href="/jigu/message/message_form.php?mode=new&rv_user_nick=0">새로 보내기</a>
          </div>
      </li>

        <?php
        if($account == null || $nickname == null){
          echo "<li class='menusr'><a href='/jigu/user/login_form.php'>Login</a></li>";
        }
        ?>

    </ul>

    <hr/>

</div>

</body>

<style>
.menumain li a:hover{
    color: #111111;
    background-color: #bbbbff;
}
.nav{
  position: fixed;
  width: 1280px;
  background: #F5BB4E;
}
</style>

<script>
var nav = document.getElementsByClassName("menumain");

    window.onscroll = function sticky() {
      if(window.pageYOffset > nav[0].offsetTop) {
        nav[0].classList.add("nav");
      } else {
        nav[0].classList.remove("nav");
      }
    }
</script>
</html>
