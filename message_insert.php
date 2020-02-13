<meta charset='utf-8'>
<?php
    $send_id = $_GET["send_id"];
    $rv_id = $_POST['rv_id'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
	$subject = htmlspecialchars($subject, ENT_QUOTES);
  //문자열에 포함된 특수문자를 HTML특수기호로 변환하겠다.
  //(ENT_QUOTES:큰 따옴표와 작은 따옴표를 모두 변환하겠다.)
	$content = htmlspecialchars($content, ENT_QUOTES);
  date_default_timezone_set('Asia/Seoul');
	$regist_day = date("Y-m-d (H:i)");
  // date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	if(!$send_id) {
		echo("
			<script>
			alert('로그인 후 이용해 주세요! ');
			history.go(-1)
			</script>
			");
		exit;
	}

	$con = mysqli_connect("localhost", "root", "123456", "sample");
	$sql = "select * from members where id='$rv_id'";
	$result = mysqli_query($con, $sql);
	$num_record = mysqli_num_rows($result);

	if($num_record)
	{
		$sql = "insert into message (send_id, rv_id, subject, content, regist_day) ";
		$sql .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
		mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
	} else {
		echo("
			<script>
			alert('수신 아이디가 잘못 되었습니다!');
			history.go(-1)
			</script>
			");
		exit;
	}
	mysqli_close($con);               
	echo "
	   <script>
	    location.href = 'message_box.php?mode=send';
	   </script>
	";
?>
