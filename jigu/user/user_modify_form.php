<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>회원 정보 수정</title>
<link rel="stylesheet" type="text/css" href="../resource/css/user_form.css">
<link rel="stylesheet" type="text/css" href="../resource/css/common.css">
</head>
<body>
	<header>
    	<?php include "../resource/chkSessionX.php";?>
			<?php

			require "../resource/sqlConn.php";
			$sql    = "select * from users where account='$account'";
	    $result = mysqli_query($con, $sql);
	    $row    = mysqli_fetch_array($result);

	    $password = $row["password"];
	    $nickname = $row["nickname"];

	    mysqli_close($con);
			?>
    </header>
	<section>
		<div class="login-page">
				<div class="form">
						<h2>회원 정보 수정</h2>
						<br/>
						<form name="user_modify_form" method="post" action="user_modify.php?account=<?=$account?>" >
								<h3>ID(이메일)</h3>
								<input type="email" id="account" name="account" readonly="readonly" value="<?=$account?>">
								<h3>닉네임</h3>
								<input type="text" id="nickname" name="nickname" placeholder="type your nickname">
								<input class = "act" type="button" onclick="check_name()" value="중복확인">
								<h3>비밀번호</h3>
								<input type="password" id="password" name="password" placeholder="type your password">
								<h3>비밀번호 확인</h3>
								<input type="password" id="pass_confirm" name="pass_confirm" placeholder="type your password again">
								<input class = "act" type="button" onclick="reset_form()" value="다 시 적 기">
								<input class = "act" type="button" value="수 정 하 기" onclick="check_input()">
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
      if (!document.user_modify_form.nickname.value) {
          alert("바꿀 닉네임을 입력하세요!");
          document.user_modify_form.nickname.focus();
          return;
      }

      if (!document.user_modify_form.password.value) {
          alert("비밀번호를 입력하세요!");
          document.user_modify_form.password.focus();
          return;
      }

      if (!document.user_modify_form.pass_confirm.value) {
          alert("비밀번호를 입력하세요!");
          document.user_modify_form.pass_confirm.focus();
          return;
      }

      if (document.user_modify_form.password.value !=
            document.user_modify_form.pass_confirm.value) {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
          document.user_modify_form.password.focus();
          document.user_modify_form.password.select();
          return;
      }

      document.user_modify_form.submit();
   }

   function reset_form() {
			document.user_modify_form.nickname.value = "";
      document.user_modify_form.password.value = "";
      document.user_modify_form.pass_confirm.value = "";
      document.user_modify_form.account.focus();
      return;
   }



   function check_name() {
     window.open("user_check_nickname.php?nickname=" + document.user_modify_form.nickname.value,
         "NicknameCheck",
          "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
   }

</script>

<style>
input:read-only {
  background-color: #dddddd !important;
}
</style>

</html>
