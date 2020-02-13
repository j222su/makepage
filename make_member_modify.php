<?php
    $userid = $_POST["user_ID"];
    $pwpw = $_POST["pwpw"];
    $userName = $_POST["userName"];
    $email  = $_POST["email"];
    $con = mysqli_connect("localhost", "root", "123456", "sample");
    $sql = "update members set pass='$pwpw', name='$userName' , email='$email'";
    $sql .= " where id='$userid'";
    $result=mysqli_query($con, $sql);

    $sqlForModifyName = "select * from members where id='$userid'";
    $resultForSession = mysqli_query($con, $sqlForModifyName);
    $row = mysqli_fetch_array($resultForSession);
    session_start();
    $_SESSION["userid"] = $row["id"];
    $_SESSION["username"] = $row["name"];
    $_SESSION["userlevel"] = $row["level"];
    $_SESSION["userpoint"] = $row["point"];
    mysqli_close($con);
    
    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>
