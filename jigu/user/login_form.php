<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="../resource/css/user_form.css">
<link rel="stylesheet" type="text/css" href="../resource/css/common.css">
<script type="text/javascript" src="../resource/js/login.js"></script>
</head>
<body>
  <header>
      <?php include "../resource/chkSessionO.php";?>
    </header>
  <div class="login-page">
      <div class="form">
          <h2>로그인</h2>
          <form name="user_login_form" method="post" action="login.php" >
              <input type="email" id="account" name="account" placeholder="type your email(account)">
              <input type="password" id="password" name="password" placeholder="type your password">
              <input class = "act" type="button" onclick="check_input();" value="로 그 인">
              <input class = "act" type="button" value="홈 으 로" onclick="location.href='../main/index.php';">
              <p class="message">Not registered? <a href="./user_insert_form.php">Create an account</a></p>
          </form>
      </div>
  </div>
	</section>
  <footer>
    	<?php include "../resource/footer.php";?>
  </footer>
</body>

<script>
function check_input()
{
    if (!document.user_login_form.account.value)
    {
        alert("아이디를 입력하세요");
        document.login_form.id.focus();
        return;
    }

    if (!document.user_login_form.password.value)
    {
        alert("비밀번호를 입력하세요");
        document.login_form.pass.focus();
        return;
    }

    document.user_login_form.submit();
}

</script>
</html>
