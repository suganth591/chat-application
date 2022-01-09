<html>
    <head>
        <title>login</title>
    </head>
    <body>
        <style>
        .form{
            border:2px solid red;
            padding:2%;
            padding-top:1%;
            padding-bottom:3%;
            width:50%;
            margin:auto;
            margin-top:10%;
            font-size:150%;
            background-image: linear-gradient(to right top, #ffbbe2, #f3beed, #e5c1f5, #d6c5fb, #c6c9ff, #b8d0ff, #acd6ff, #a4dbff, #a0e5ff, #a0eeff, #a5f7fe, #aefffa);
            font-weight: bolder;
            border-radius:50px;
        }
        input[type=text],input[type=number],input[type=email],input[type=date],#gender{
            width:60%;
            height:4%;
            font-size:100%;
            color:black;
            border-radius:50px;
        }
        input[type=password]{
            height:4%;
            width:59%;
            color:black;
            border-radius:50px;
        }
        input[type=text]:hover,input[type=password]:hover,input[type=number]:hover,input[type=email]:hover,input[type=date]:hover,#gender:hover{
           color:black;
           background:white;
           transition-duration:0.4s;
        }
        input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button{
            -webkit-appearance:none;
            margin:0;
        }
        #form-head{
            text-align:center;
            color:rgb(255, 124, 124);
            text-shadow: white 5px 5px 20px;
        }
        #reg{
            margin-left:40%;
            width:auto;
            color:black;
            height:5%;
            background-color: aqua;
            border-radius:10px;
            font-size:130%;
            font-weight: bold;
        }</style>
        <form action="/chat/php/login.php" method="post" class="form" id="user">
        <h2 id="form-head">Login form-User</h2>
    Username:&ensp;<input type="text" required name="name" style="font-size:100%"><br><br><br>
    Password:&ensp;<input type="password" required name="password" style="font-size:100%"><br><br>
    <input id="reg" type="submit" value="login" name='login'><br><br>
    <a href="/chat/index.html" style="text-decoration:none;color:black">New to here? Register here</a>
        </form>
    </body>
</html>
<?php
session_start();
include("db.php");
if(isset($_POST['login'])){
$uname=$_POST["name"];
$pass=$_POST["password"];
$check="SELECT id from register_user where password='".$pass."' AND uname='".$uname."'";
$result=$conn->query($check);
while($i=$result->fetch_assoc()){
    $_SESSION['id']=$i['id'];
}
if(mysqli_num_rows($result)>0){
    header("location:user_page.php");
}else{
    echo"<script>alert('Username or Password incorrect');</script>";

}
}
?>