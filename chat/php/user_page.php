<?php
include("db.php");
session_start();
$my_id=$_SESSION['id'];
$stmt="SELECT * FROM register_user where id=".$my_id;
$res=$conn->query($stmt);
while($i=$res->fetch_assoc()){
$name=$i['uname'];
}
header("search.php");
echo "<meta content='width=device-width, initial-scale=1,height=device-height' name='viewport' />
<title>Homepage</title><link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>";
echo "<body><style>";
echo file_get_contents('../style/style.css');
echo"</style>";
?>
<input type="hidden" id='c' value="0"></input>
<?php
echo "<script>";
echo file_get_contents("../js/user.js");
echo "</script>";
?>
<div id="head">
<a id=name> Hello , <?php echo $name ?></a><div id='menu'><a id=showtime style=''></a><a onclick="show_menu()" class="link">MENU<span id="arrow" class='material-icons'>arrow_drop_down</span></a></div>
</div>
<div id="menubar">
<a class="link">My profile</a>
<a class="link" onclick=logout()>Logout</a>
<a class="link">About Us</a>
<a class="link">Contact Us</a>
<a class="link"><span class="material-icons">help</span>Help</a>
</div>
<div id="floatbutton" onclick="message()"><span class="material-icons" id="chat_icon">question_answer</span></div>
<script>timerClock();</script>
<section id="chatbar"><div><?php include("search.php") ?></div></section>
<section><?php include('admin_page.php')?></section>
