<html>
<head>
<meta charset="utf-8">
<title>회원 가입</title>
<link rel="stylesheet" type="text/css" href="../resource/css/user_form.css">
<link rel="stylesheet" type="text/css" href="../resource/css/common.css">
</head>
<body>
	<header>
    	<?php include "../resource/chkSessionO.php";
			?>
    </header>
	<section>
		<div class="login-page">
				<div class="form">
						<h2>회원 가입</h2>
						<br/>
						<form name="user_insert_form" method="post" action="./user_insert.php" >
								<h3>이메일</h3>
								<input type="email" id="account" name="account" placeholder="type your email(account)">
								<input class = "act" type="button" onclick="check_account();" value="중복확인">
								<h3>닉네임</h3>
								<input type="text" id="nickname" name="nickname" placeholder="type your nickname">
								<input class = "act" type="button" onclick="check_name();" value="중복확인">
								<h3>비밀번호</h3>
								<input type="password" id="password" name="password" placeholder="type your password">
								<h3>비밀번호 확인</h3>
								<input type="password" id="pass_confirm" name="pass_confirm" placeholder="type your password again">
								<input class = "act" type="button" onclick="check_input();" value="가 입 하 기">
								<input class = "act" type="button" onclick="reset_form()" value="다 시 적 기">
								<input class = "act" type="button" value="홈 으 로" onclick="location.href='../main/index.php'">
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
	if (!document.user_insert_form.account.value) {
			alert("아이디(이메일)를 입력하세요!");
			document.user_insert_form.account.focus();
			return;
	}

	if (!document.user_insert_form.nickname.value) {
			alert("닉네임을 입력하세요!");
			document.user_insert_form.nickname.focus();
			return;
	}

	if (!document.user_insert_form.password.value) {
			alert("비밀번호를 입력하세요!");
			document.user_insert_form.password.focus();
			return;
	}

	if (!document.user_insert_form.pass_confirm.value) {
			alert("비밀번호를 입력하세요!");
			document.user_insert_form.pass_confirm.focus();
			return;
	}

	if (document.user_insert_form.password.value !=
				document.user_insert_form.pass_confirm.value) {
			alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
			document.user_insert_form.pass.focus();
			document.user_insert_form.pass.select();
			return;
	}


	document.user_insert_form.submit();
}

function reset_form() {
	 document.user_insert_form.account.value = "";
	 document.user_insert_form.nickname.value = "";
	 document.user_insert_form.password.value = "";
	 document.user_insert_form.pass_confirm.value = "";
	 document.user_insert_form.account.focus();
	 return;
}

function check_account() {
 window.open("user_check_account.php?account=" + document.user_insert_form.account.value,
		 "AccountCheck",
			"left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
}

function check_name() {
 window.open("user_check_nickname.php?nickname=" + document.user_insert_form.nickname.value,
		 "NicknameCheck",
			"left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
}

</script>

</html>
