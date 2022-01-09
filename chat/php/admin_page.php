<?php
include('db.php');
$id=$_SESSION['id'];
$stmt="SELECT * FROM register_user where id=".$id;
$result=$conn->query($stmt);
$num=0;
while($i=$result->fetch_assoc()){
    echo"<html>
    <head>
        <title>Admin_page</title>

        <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
    </head>
</html>";
echo"<style>";
include('../style/admin.css');
echo"</style>";
echo"
<body style='background:rgb(245, 241, 188)'>
        <div id='content'>
            <br>
            &ensp;<input type='button' id='post_btn' value='New Post' onclick='post(1)'><br><br><br>
            <form action='' id='post' method='post' enctype='multipart/form-data'>
                <input type=button value='X' id='close1' onclick='post(0)'>
               <input type='text' placeholder='Enter your Title...' style='width:60%' name='title' maxlength='200' required>
                <br>
                <textarea name='description' style='width:60%' placeholder='Description about post.. ' required maxlength='5000'></textarea><br><br>
                <input type=hidden name='timer' id='timering' value=0>
            &ensp;<input type='file' name='upload_file' required><br><br>
            &ensp;<input type='submit' name='upload' value='post now'>
            </form>
            </div>
        </div>
        ";
}
if(isset($_POST['upload'])){
$adminid=$id;
$title=$_POST['title'];
$description=$_POST['description'];
$filename=$_FILES['upload_file']['name'];
$timer=$_POST['timer'];
$stmt="SELECT * FROM posts where time=$timer";
$res=$conn->query($stmt);
$stmt="insert into posts(title,description,image,adminid,time) values('$title','$description','$filename','$adminid','$timer')";
if(mysqli_num_rows($res)==0){
$conn->query($stmt);
}
$target='../posts/';
$target_file=$target.basename($_FILES['upload_file']['name']);
move_uploaded_file($_FILES['upload_file']['tmp_name'],$target_file);

}
$count="SELECT * from posts";
$result=$conn->query($count);
$total=mysqli_num_rows($result);
echo "<div id='new_posts'>";
echo"<table>";
if($total==0){
    echo"<h1>No posts available..</h1>";
}
while($total){
    if($num%2==0){
        echo"</tr><tr>";
    }
    echo"<td class='post'>";
    echo"<div>";
    $stmt1="SELECT * from posts where id=".$total;
    $res=$conn->query($stmt1);
    while($i=$res->fetch_assoc()){
        $stmt2="SELECT uname from register_user where id=".$i['adminid'];
        $res2=$conn->query($stmt2);
        while($j=$res2->fetch_assoc()){
            if($id==$i['adminid']){
                echo "<a class='h'>You said (<span style='font-size:large;'>".date('d/m/y H/i',$i['time']/1000)."</span>) :<br></a>";
            }else{
            echo"<h1 class='h'>&ensp;".$j['uname']." Says (<span style='font-size:large;'>".date('d/m/y H/i',$i['time']/1000)."</span>) :<br> <br>";
            }
        }
    echo"</h1>";
    echo "<h2 id='heading'><b>Title: </b>".$i['title']."</h2><hr>";
    echo"<img class='img' src='/chat/posts/".$i['image']."'><br>";
    echo"<h2 id ='des'><hr><hr>Description:</h2>";
    echo"<h3 id=des>".$i['description']."</h3>";
    echo"&ensp;<b><a style='color:black;background:yellow;padding:3px;margin-bottom:40px;border:2px solid blue;text-decoration:none;text-align:right;' target='blank' href='view.php?id=".$total."'>View Blog</a></b><br><br>";
    echo"</div>";

    }
    echo"</td>";
    $num+=1;
    $total-=1;
}
echo "</div>";
$conn->close();
?>