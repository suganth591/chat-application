<?php
include('db.php');
$id=$_GET['id'];
$stmt="SELECT * FROM posts WHERE id=".$id;
$res=$conn->query($stmt);
while($i=$res->fetch_assoc()){
   echo"<head>
    <title>".$i['title']."</title>
    </head><body style='background:light-grey;border:2px solid black;padding:10px;'>
    <style>";
    echo file_get_contents('../style/view.css');
    echo"</style>";
    echo "<h1 id='heading1' style='text-align:center'>".$i['title']."</h1>";
    echo"<img id='img2' src='../posts/".$i['image']."'>";
    echo"<br><br><br><h2>Description:</h2>";
    echo"<h3>".$i['description']."<h3>";

}
?>