<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>회원 가입</title>
<link rel="stylesheet" type="text/css" href="../resource/css/user_form.css">
<link rel="stylesheet" type="text/css" href="../resource/css/common.css">
</head>
<body>
	<header>
    	<?php include "../resource/chkSessionX.php";?>
    </header>
	<section>
		<div class="login-page">
				<div class="form">
						<h2>회원 정보</h2>
						<form name="user_modify_form" >
								<h3>ID(이메일)</h3>
								<input type="email" id="account" name="account" readonly="readonly" value="<?=$account?>">
								<h3>닉네임</h3>
								<input type="text" id="nickname" name="nickname" readonly="readonly" value="<?=$nickname?>">
								<input class = "act" type="button" onclick="location.href='./user_modify_form.php';" value="회원 정보 수정">
								<input class = "act" type="button" onclick="location.href='../board/board_mine.php';" value="나의 질문들">
								<input class = "act" type="button" onclick="location.href='../answer/answer_mine.php';" value="나의 답변들">
						</form>
				</div>
		</div>

	</section>
	<footer>
    	<?php include "../resource/footer.php";?>
    </footer>
</body>
<style>
input:read-only {
  background-color: #dddddd !important;
}
</style>
</html>
