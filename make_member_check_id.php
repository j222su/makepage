<?php
$id = $_POST["userID"];
$con = mysqli_connect("localhost", "root", "123456", "sample");
$sql = "select * from members where id='$id'";
$result = mysqli_query($con, $sql);
$num_record = mysqli_num_rows($result);
if ($num_record) {
   echo "1";
} else {
   echo "0";
}
mysqli_close($con);
?>
