<?php
@session_start();
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";
if (isset($_SESSION["username"])) $username = $_SESSION["username"];
else $username = "";

// echo '<script>alert("ㄴㄹㅇㄴ"+$_GET["mode"])</script>';
// echo '<script>console.log($_GET["mode"])</script>';

$num = $_GET["num"];
$page = $_GET["page"];
$mode = $_GET["mode"];

$subject = $_POST["subject"];
$content = $_POST["content"];

$con = mysqli_connect("localhost", "root", "123456", "sample");

$subject = htmlspecialchars($subject, ENT_QUOTES);
$content = htmlspecialchars($content, ENT_QUOTES);

date_default_timezone_set('Asia/Seoul');
$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장, month랑 겹쳐서 분을 i로 표현한 것임
$upload_dir = './data/';

$upfile_name	 = $_FILES["upfile"]["name"];
$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
$upfile_type     = $_FILES["upfile"]["type"];
$upfile_size     = $_FILES["upfile"]["size"];
$upfile_error    = $_FILES["upfile"]["error"];

if ($upfile_name && !$upfile_error)
{
  //.을 기준으로 자른다. ex) jisu.jpg 하면 jisu와 jpg를 . 기준으로 자르는 것
  $file = explode(".", $upfile_name);
  //자른것을 각가 배열로 저장한다.
  $file_name = $file[0];
  $file_ext  = $file[1];

  $new_file_name = date("Y_m_d_H_i_s");
  // $new_file_name = $new_file_name;
  $copied_file_name = $new_file_name.".".$file_ext;
  //또 다른 사람이 나와 같은 이름을 업로드 시킬 수 있다...
  // 2020_02_06_10_37_40.jpg로 저장시키는건데 혹시 사용자가 같은 시간에 동시에 업로드 시키게 되면 겹치게 된다.
  $uploaded_file = $upload_dir.$copied_file_name;

  if( $upfile_size  > 1000000 ) {
      echo("
      <script>
      alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
      history.go(-1)
      </script>
      ");
      exit;
  }

  if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
  {
      echo("
        <script>
        alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
        history.go(-1)
        </script>
      ");
      exit;
  }
}
else
{
  $upfile_name      = "";
  $upfile_type      = "";
  $copied_file_name = "";
}

function board_insert($con, $userid, $username, $subject, $content, $regist_day,$upfile_name, $upfile_type, $copied_file_name) {
  $sql = "insert into board (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
  $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
  $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";

mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
  //select문에는 레코드셋을 가져와야 되기 때문에 이 값을 저장하는 변수가 띠로 필요하지만 undate delete create할 때에는 필요없다.


	// 포인트 부여하기
  $point_up = 100;

	$sql = "select point from members where id='$userid'";
	$result = mysqli_query($con, $sql); //sql문을 실행한 레코드셋을 가지고 있다.
	$row = mysqli_fetch_array($result);
	$new_point = $row[(int)"point"] + $point_up; //$row["point"]를 parseInt해줘야 한다. var_dump?

	$sql = "update members set point=$new_point where id='$userid'";
	mysqli_query($con, $sql);

	mysqli_close($con);                // DB 연결 끊기


}

function board_modify($num, $page, $con, $userid, $username, $subject, $content, $regist_day,$upfile_name, $upfile_type, $copied_file_name) {

  // $con = mysqli_connect("localhost", "root", "123456", "sample");
  $sql = "update board set subject='$subject', content='$content',
          regist_day='$regist_day', file_name='$upfile_name',
          file_type='$upfile_type', file_copied='$copied_file_name'";
  $sql .= " where num=$num";
  mysqli_query($con, $sql);
  mysqli_close($con);

}

switch ($mode) {
  case 'insert':
    board_insert($con, $userid, $username, $subject, $content, $regist_day,$upfile_name, $upfile_type, $copied_file_name);
    echo "
       <script>
        location.href = 'board_list.php';
       </script>
    ";
    break;

  case 'modify':
    board_modify($num, $page, $con, $userid, $username, $subject, $content, $regist_day,$upfile_name, $upfile_type, $copied_file_name);
    echo "
       <script>
           location.href = 'board_list.php?page=$page';
       </script>
     ";
    break;

  default:
    // code...
    break;
}

 ?>
