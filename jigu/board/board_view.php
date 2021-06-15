<html>
<head>
<meta charset="utf-8">
<title>질문 내용</title>
<link rel="stylesheet" type="text/css" href="../resource/css/common.css">
<link rel="stylesheet" type="text/css" href="../resource/css/board.css">
</head>
<body>
<header>
    <?php include "../resource/menubar.php";?>
</header>
<section>
	<div id="main_img_bar">
        <img src="../resource/img/universe.png">
    </div>

   	<div id="board_box">
	    <h2 style="padding: 30px;">
			질문 내용
		</h2>
<?php
	$id  = $_GET["id"];
  if(isset($_GET["page"]))
	 $page  = $_GET["page"];
  else
    $page = 1;

	require "../resource/sqlConn.php";
	$sql = "select b.*,u.nickname as writer_nick from board b join users u";
  $sql .= " where b.is_deleted = 0 and b.user_id = u.id and b.id=$id";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$id      = $row["id"];
  $writer_id      = $row["user_id"];
  $writer_nick      = $row["writer_nick"];
	$title    = $row["title"];
	$content    = $row["content"];
  $created_at = $row["created_at"];
  $hits          = $row["hits"];
  $point         = $row["point"];
  $views          = $row["views"];
  $views += 1;
  $board_selected          = $row["is_selected"];

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);
  $created_at = substr($created_at,0,10);
  $category_id = $row["category_id"];

	$sql = "update board set views=views+1 where id=$id";
	mysqli_query($con, $sql);

if($category_id != 0){
  $sql = "select * from category_type where id = ".$category_id;
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
  $category = $row["type"];
}else{
  $category = "없음";
}


?>
  <article class="section_head">
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$title?></span><br/>
        <span class="col1"><b>작성자 :</b> <?=$writer_nick?></span><br/>
        <span class="col2"> <?=$hits?> hits | <?=$views?> views | <?=$created_at?></span>
        <span class="col3"> <b>포인트:</b> <?=$point?></span>
        <span class="col3"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>카테고리:</b> <?=$category?></span>
			</li>
			<li>
				<?=$content?>
			</li>
	    </ul>

      <ul class="buttons">
        <li><button type="button" onclick="hit()">추천</button></li>
      </ul>
    </article>

<?php
  $sql = "select a.*,u.nickname from answer a join users u";
  $sql .= " where a.is_deleted = 0 and a.user_id = u.id and a.board_id = $id order by a.id desc";
  $result = mysqli_query($con, $sql);
  $total_record = mysqli_num_rows($result);
  $answer_flag = 1;
  if ($total_record == 0)
      echo "<h2>아직 답변이 없습니다.</h2>";
  else
  {
?>
  <?php
    while( $row = mysqli_fetch_array($result) )
    {
      echo "<article class='article'><ul id='view_content'>";
      $answer_id = $row["id"];
      $answer_writer_id = $row["user_id"];
    	$title    = $row["title"];
    	$content    = $row["content"];
      $created_at = substr($row["created_at"], 0, 10);
      $updated_at = substr($row["updated_at"], 0, 10);
      $is_hided          = $row["is_hided"];
      $is_selected          = $row["is_selected"];



      ?>
      <li>
        <?php
        if($is_selected){
          echo "<h2 style='margin-top:0px;'>채택된 질문!</h2><br/>";
        }else{
          //if($board_selected==0)
            //echo "<h2>채택된 질문!</h2>";
          //채택하기 버튼?
        }
        ?>
        <span class="col1"><b>제목 :</b> <?=$title?></span><br/>
        <?php
        if($is_hided == 0){
          $writer      = $row["nickname"];
          echo "<span class='col1'><b>작성자 :</b> $writer </span>";
        }
        else echo "<span class='col1'>익명의 작성자</span>";
        ?>
        <span class="col2"><?=$created_at?></span>
      </li>
      <li>
        <?=$content?>
      </li>
      <?php

        if (isset($_SESSION["user_id"])){
            if($answer_writer_id == $user_id){
              $answer_flag = 0;
              ?>
              <button onclick="answer_modify(<?=$answer_id?>)">수정</button>
              <button onclick="answer_delete(<?=$answer_id?>)">삭제</button>
              <?php
            }
        }
      ?>
      </ul>
    </article>
<?php
if (isset($_SESSION["user_id"])){
  if($user_id == $writer_id && $board_selected==0){
?>
      <ul class="buttons">
				<li><button onclick="go_select(<?=$answer_id?>)">채택하기</button></li>
      </ul>
<?php
  }
}
    }
}
mysqli_close($con);
?>


	    <ul class="buttons">
				<li><button onclick="location.href='./board_list.php'">목록</button></li>
        <?php
        if(isset($_SESSION["user_id"])){
          //echo "<script>alert('$user_id')</script>";
          if($user_id == $writer_id){
            echo "<li><button onclick='go_modify()'>수정</button></li>";

            echo "  <li><button onclick='go_delete()'>삭제</button></li>";
          }else{
            if($board_selected == 0)
            echo "<li><button onclick='go_answer()'>답변작성</button></li>";
          }

        }
        ?>

				<li><button onclick="location.href='./board_form.php'">질문하기</button></li>

		</ul>
	</div>
  <!-- //board_box -->



  <div></div>



</section>
<footer>
    <?php include "../resource/footer.php";?>
</footer>
<script type="text/JavaScript">
function go_modify(){
  location.href = './board_modify_form.php?id=<?=$id?>';
}

function go_delete(){
  location.href='./board_delete.php?id=<?=$id?>';
}



function hit(){
  <?php
   if(isset($_SESSION["user_id"])){
   ?>
     location.href = "./board_hit.php?id=<?=$id?>";
   <?php
 }else{
   ?>
   alert("로그인이 필요한 기능입니다.");

   var result = confirm("로그인 하시겠습니까?");
   if(result){
     location.href = "../user/login_form.php";
   }else{
     return;
   }
   <?php } ?>
}


function go_select(answer_id){
  var result = confirm("이 답변을 채택하시겠습니까?");
  if(result){
    location.href = "../answer/answer_select.php?id="+answer_id+"&board_id=<?=$id?>";
  }else{
    return;
  }
}


function go_answer(answer_id){
  if(<?=$answer_flag?> == 0){
    alert("이미 답변을 작성하였습니다.");
    return;
  }else{
      location.href='../answer/answer_form.php?board_id=<?=$id?>';
  }
}

function answer_modify(answer_id){
      location.href = "../answer/answer_modify_form.php?id="+answer_id;
}
function answer_delete(answer_id){
      location.href = "../answer/answer_delete.php?id="+answer_id;
}

</script>

<style>
.section_head{
    width: 80%;
    background-color: lightblue;
    padding: 30px;
    border: 2px solid #aadddd;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 3px 3px 3px 3px gray;
}
.article{
    width: 60%;
    margin-left: 110px;
    margin-bottom: 30px;
    border: 2px solid #dddddd;
    border-radius: 5px;
    background-color: #ffffff;
    padding: 30px;
    box-shadow: 3px 3px 3px 3px gray;
}
</style>
</body>
</html>
