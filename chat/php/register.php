<?php
include('db.php');
$name=$_POST['name'];
$password_1=$_POST['password'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$DOB=$_POST['DOB'];
$check="SELECT * FROM register_user where uname='".$name."'";
$result=$conn->query($check);
if(mysqli_num_rows($result)>0){
    echo"<script>alert('Username already exist Try changing it');</script>";
    echo file_get_contents('../index.html');
}else{
    $stmt="insert into register_user(uname,gender,email,phone,DOB,password) values('$name','$gender','$email','$phone','$DOB','$password_1')";
    $conn->query($stmt);
    header("location:../php/login.php");
}
?>