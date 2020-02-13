<?php
  $user_ID   = $_POST["user_ID"];
  $pwChk = $_POST["pwChk"];
  $userName = $_POST["userName"];
  $email  = $_POST["email"];

  // 현재의 '년-월-일-시-분'을 저장
  $regist_day = date("Y-m-d (H:i)");

  $con = mysqli_connect("localhost", "root", "123456", "sample");

	$sql = "insert into members(id, pass, name, email, regist_day, level, point) ";//이 문장을 쓰지 않았을 땨는 value 값에 null을 넣어준다.
	$sql .= "values('$user_ID', '$pwChk', '$userName', '$email', '$regist_day', 9, 0)";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);
    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>
