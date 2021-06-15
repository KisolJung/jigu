        <div id="main_img_bar">
            <img src="../resource/img/universe.png">
            <br/>
        </div>
        <div id="main_content">

<?php require "../resource/sqlConn.php"; ?>

<h1>사용자 랭킹</h1>
          <div id="mrank">
              <h4>최다 답변</h4>
              <ul>
<!-- 포인트 랭킹 표시하기 -->
<?php
  $rank = 1;
  $sql = "select u.*, count(*) asw_count from users u join answer a ";
  $sql .= "where u.id = a.user_id GROUP by user_id";
  $result = mysqli_query($con, $sql);

  if (!$result)
      echo "회원 DB 테이블(users)이 생성 전이거나 아직 가입된 회원이 없습니다!";
  else
  {
    ?>
    <li>
        <span>랭킹</span>
        <span>닉네임</span>
        <span>답변수</span>
        <hr/>
    </li>
    <?php
      while( $row = mysqli_fetch_array($result) )
      {
          $nick  = $row["nickname"];
          $point = $row["point"];
          $asw_count = $row["asw_count"];
?>
              <li>
                  <span><?=$rank?></span>
                  <span><?=$nick?></span>
                  <span><?=$asw_count?></span>
              </li>
<?php
          $rank++;
      }
  }

?>
              </ul>
          </div>

          <div id="mrank">
              <h4>포인트 랭킹</h4>
              <ul>
          <!-- 포인트 랭킹 표시하기 -->
          <?php
          $rank = 1;
          $sql = "select * from users order by point desc limit 5";
          $result = mysqli_query($con, $sql);

          if (!$result)
          echo "회원 DB 테이블(users)이 생성 전이거나 아직 가입된 회원이 없습니다!";
          else
          {
          ?>
          <li>
          <span>랭킹</span>
          <span>닉네임</span>
          <span>포인트</span>
          <hr/>
          </li>
          <?php
          while( $row = mysqli_fetch_array($result) )
          {
          $nick  = $row["nickname"];
          $point = $row["point"];
          ?>
              <li>
                  <span><?=$rank?></span>
                  <span><?=$nick?></span>
                  <span><?=$point?></span>
              </li>
          <?php
          $rank++;
          }
          }

          ?>
              </ul>
          </div>
<br/>
<br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/>
<h1>질문 랭킹</h1>
            <div id="mboard">
                <h4>최근 질문</h4>
                <ul>
<!-- 최근 게시 글 DB에서 불러오기 -->
<?php
    $sql = "select * from board order by id desc limit 5";
    $result = mysqli_query($con, $sql);

    if (!$result)
        echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
    else
    {
      ?>
      <li>
          <span>제목</span>
          <span>작성자 번호</span>
          <span>작성일</span>
          <hr/>
      </li>
      <?php
        while( $row = mysqli_fetch_array($result) )
        {
            $regist_day = substr($row["created_at"], 0, 10);
?>
                <li>
                    <span><?=$row["title"]?></span>
                    <span><?=$row["user_id"]?></span>
                    <span><?=$regist_day?></span>
                </li>
<?php
        }
    }
?>
            </div>




            <div id="mboard">
                <h4>인기 질문</h4>
                <ul>
<?php
        $sql = "select * from board order by hits limit 5";
        $result = mysqli_query($con, $sql);
        if (!$result)
            echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
        else{
          ?>
          <li>
              <span>제목</span>
              <span>작성자 번호</span>
              <span>작성일</span>
              <hr/>
          </li>
          <?php
            while( $row = mysqli_fetch_array($result) )
            {
                $regist_day = substr($row["created_at"], 0, 10);
    ?>
                    <li>
                        <span><?=$row["title"]?></span>
                        <span><?=$row["user_id"]?></span>
                        <span><?=$regist_day?></span>
                    </li>
    <?php
            }
        }
?>
                </ul>
              </div>


        </div>

<?php mysqli_close($con);?>
