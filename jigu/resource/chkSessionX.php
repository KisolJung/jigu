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
    if(!isset($_SESSION["user_id"])){
      echo"<script>
      alert('가입하지 않은 유저는 접근할 수 없습니다.');

      var result = confirm('로그인 하시겠습니까?');
      if(result){
          location.href='/jigu/user/login_form.php';
      }
      else{
            location.href='/jigu/main/index.php';
          }

      </script>";
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

        <li class="menusr"><a href="/jigu/user/user_info.php"><?=$nickname?></a></li>
        <li class="menusr"><a href="/jigu/user/logout.php">LogOut</a></li>

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
