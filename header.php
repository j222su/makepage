<?php
  session_start();
  if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
  else $userid = "";
  if (isset($_SESSION["username"])) $username = $_SESSION["username"];
  else $username = "";
  if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
  else $userlevel = "";
  if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
  else $userpoint = "";
?>
  <div id="top">
    <h3>
      <a href="index.php">JISU</a>
    </h3>
      <ul id="top_menu">
<?php
    if(!$userid) {
?>
      <li><a href="member_form.php">회원가입</a> </li>
      <li> | </li>
      <li><a href="make_login_form.php">로그인</a></li>
<?php
    } else {
        $logged = $username."(".$userid.")님[Level:".$userlevel.", Point:".$userpoint."]";
?>
      <li><?=$logged?> </li>
      <li> | </li>
      <li><a href="make_logout.php">로그아웃</a> </li>
      <li> | </li>
      <li><a href="make_member_modify_form.php">회원정보 수정</a></li>
<?php
    }
?>

<?php
    if($userlevel==1) {
?>
    <li> | </li>
    <li><a href="admin.php">관리자 모드</a></li>
<?php
    }
    $bmode_insert = "bmode_insert";
?>
    </ul>
    </div>
    <div id="menu_bar">
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="message_form.php">쪽지 보내기</a></li>
            <li><a href="board_form.php?bmode=<?=$bmode_insert?>">게시판 글쓰기</a></li>
            <li><a href="qna_list.php">Q&A</a></li>
        </ul>
    </div>
