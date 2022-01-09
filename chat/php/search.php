<form id='searchbar' action="" method="POST">
<br><input type="text" id="search" name="search" placeholder="Search By Username..">&ensp;<input type="submit" name="submit" value="Search" id="search_btn">
<?php echo"<input type=hidden value='$my_id' name='id'><input type='hidden' value=0 name=notify>" ?>
<?php
echo"<br><br>";
$stmt="select * from chat where chat_id='$my_id' and notify='1' ORDER BY `time` DESC";
$res=$conn->query($stmt);
if(mysqli_num_rows($res)>0){
echo "<section class=notif>";
echo"<h2 class='notify'>&ensp;New messages:</h2>";
while($i=$res->fetch_assoc()){
$finder=$i['my_id'];
$stmt="SELECT * FROM register_user where id='$finder'";
$res1=$conn->query($stmt);
while($j=$res1->fetch_assoc()){
    $name=$j['uname'];
    $msg=$i['message'];
    $file=$i['file'];
    $date=$i['time'];
    $date/=1000;
    $stmt="UPDATE chat SET notify='0' where chat_id=$my_id";
    $conn->query($stmt);
    echo"<form></form>";
    if($file==0){
    echo "<form action='' method='POST' name=$name ><input type='hidden' name='search' value=$name><input type=hidden value=$my_id name='id'><input type='hidden' value=1 name=notify><input type='submit'  class='notify not1' name=submit value='$name : $msg (".date('d/m H:i',$date).")'></form>";
}else{
    echo "<form action='' method='POST' name=$name ><input type='hidden' name='search' value=$name><input type=hidden value=$my_id name='id'><input type='hidden' value=1 name=notify><input type='submit'  class='notify not1' name=submit value='$name : file recieved 💬 (".date('d/m H:i',$date).")'></form>";

}
}
}
echo "</section>";
}
echo "<section class='recent notif' id='rece'>";
echo "<h2>&ensp;Recent chats:</h2>";
$stmt="select * from chat  where chat_id=$my_id or my_id=$my_id ORDER BY `time` DESC";
$res=$conn->query($stmt);
$stmt="select * from register_user";
$res1=$conn->query($stmt);
$n=mysqli_num_rows($res1)+1;
$arr=array();
for($i=0;$i<$n;$i++){
for($j=0;$j<$n;$j++){
    $arr[$i][$j]=0;
}
}
if(mysqli_num_rows($res)>0){
while($i=$res->fetch_assoc()){
    $a=$i['chat_id'];
    $b=$i['my_id'];
    $date=$i['time'];
    $date/=1000;
    if($arr[$a][$b]==0&&$arr[$b][$a]==0){
    $stmt="SELECT * FROM register_user where id=".$i['chat_id'];
    $res1=$conn->query($stmt);
    while($j=$res1->fetch_assoc()){
        $name=$j['uname'];
        $msg=$i['message'];
        $file=$i['file'];
        echo"<form></form>";
        if($b==$my_id){
            if($file==0){
            echo "<form action='' method='POST' name=$name ><input type='hidden' name='search' value=$name><input type=hidden value=$my_id name='id'><input type='hidden' value=1 name=notify><input type='submit'  class='notify not1' name=submit value='$name        you: $msg (".date('d/m H:i',$date).")'></form>";
            }else{
                echo "<form action='' method='POST' name=$name ><input type='hidden' name='search' value=$name><input type=hidden value=$my_id name='id'><input type='hidden' value=1 name=notify><input type='submit'  class='notify not1' name=submit value='$name        you: file sent 💬 (".date('d/m H:i',$date).")'></form>";  
            }
        }else{
            $stmt="SELECT * FROM register_user where id=".$i['my_id'];
            $res2=$conn->query($stmt);
            $k=$res2->fetch_assoc();
            $name=$k['uname'];
        if($file==0){
        echo "<form action='' method='POST' name=$name ><input type='hidden' name='search' value=$name><input type=hidden value=$my_id name='id'><input type='hidden' value=1 name=notify><input type='submit'  class='notify not1' name=submit value='$name : $msg (".date('d/m H:i',$date).")'></form>";
        }else{
            echo "<form action='' method='POST' name=$name ><input type='hidden' name='search' value=$name><input type=hidden value=$my_id name='id'><input type='hidden' value=1 name=notify><input type='submit'  class='notify not1' name=submit value='$name :file recieved 💬 (".date('d/m H:i',$date).")'></form>";
 
        }
    }
    }
    $arr[$a][$b]=1;
    $arr[$b][$a]=1;
}
}
}
else{
echo"<h2 style='color:red;'>&ensp;&ensp;No chats still.....</h2>";
}
echo"</section>";
?>
</form>
<?php
$name_of_chat;
$stmt="SELECT * FROM chat";
$res=$conn->query($stmt);
$n=mysqli_num_rows($res);
if(isset($_POST['submit'])){
$noti=$_POST['notify'];
echo"<style>#chatbar{right:40px;display:block;}</style>";
$name_of_chat=$_POST['search'];
echo"<style>.notif{display:none;}</style>";
$stmt="SELECT id FROM register_user WHERE uname='".$name_of_chat."'";
$result1=$conn->query($stmt);
$chat_id=0;
while($i=$result1->fetch_assoc()){
    $chat_id=$i['id'];
}
if($chat_id==0||$chat_id==$my_id){
    echo"<h2 style='color:red;text-decoration:underline;'>No records found</h2>";
}
else{
echo"<b><h3 id='resu'><a id=round_cls onclick='closed()'>x</a>&ensp;Search Results:</h3></b><br>";
    echo"<div><div id='found'><span id='founded'><span id='back' class='material-icons name1' style='position:relative;border:2px;color:white;background:black;border-radius:50px;' onclick='closeit()'>arrow_left</span>";
    echo " ".$name_of_chat."</span>";
    $my_id=$_POST['id'];
    echo "</span>&ensp;&ensp;&ensp;&ensp;&ensp;<a  id='message' onclick='openit()' >Message</a><br></div>
    <div id='inputer'>
    <form action='' method='POST' enctype='multipart/form-data'>
    <input type=hidden value='$my_id' name='id'>
    <input type=hidden value='$my_id' name='my_id'>
    <input type=hidden value='$chat_id' name='chat_id'>
    <input type='hidden' id='time' name='timer'>
    <input type=hidden value='$name_of_chat' name='search'>
    <input type=hidden value=0 name=notify>
    <input type='hidden' value='submit' name='submit'>
    <input type='file' name='file' id='file' style='display:none' onchange='file_up()'>
    <input type=hidden name='is_file' id='is_file' value='0'>
    <input type='text' name='msg' id='inputbar' placeholder='Enter your Message..'><input type=submit value='Send' id='send_msg' name='sent_msg'>&ensp;<label for='file'><span class='material-icons' id='attach'>attachment</span></label>
    </form>
    </div>";
    if($noti==1){
        echo"<style>
        #chatbar{display:block;}
        #inner_chat{display:block;}
        #inputer{display:block;}
        #message{display:none;}
        #back{display:inline}
        #resu{display:none;}
        #founded{font-size:xx-large}
        #found{
        border-bottom-right-radius:0px;
        border-bottom-left-radius:0px;
        }</style><script>document.getElementById('c').value=1;</script>";
    }
    echo"
    <div id='inner_chat'>
    <script>
    timeClock();
    function timeClock()
{
    setTimeout('timeClock()',1);        
    const d = new Date();
    let time = d.getTime();
    document.getElementById('time').value=((time)-(19800000));
}
    </script>
    ";
    $stmt="SELECT * FROM `chat` ORDER BY `chat`.`time` DESC";
    $res=$conn->query($stmt);
    $id=0;
    while($i=$res->fetch_assoc()){
        $id=$i['my_id'];
        $id1=$i['chat_id'];
        $isf=$i['file'];
        if($id==$my_id&&$id1==$chat_id){
            if($isf==0){
            echo "<div class='my_chat'><p>";
            echo $i['message']."</p></div><br>";
        }else{
            if($i['message']!=''){
                echo "<div class='my_chat'><p>";
                echo $i['message']."</p></div><br>";
                }
                echo"<div class='my_chat centerize'><p>".$i['filename']."</p><div class=download ><a target='_blank' href='../files/".$i['filename']."'><span class='material-icons'>download</span></a></div></div><br>";
           
                 }
        }else if($id==$chat_id&&$id1==$my_id){
            if($isf==0){
                echo "<div class='his_chat'><p>";
                echo $i['message']."</p></div><br>";
            }else{
                if($i['message']!=''){
                echo "<div class='his_chat'><p>";
                echo $i['message']."</p></div><br>";
                }
                echo"<div class='his_chat centerize'><p>".$i['filename']."</p><div class=download ><a target='_blank' href='../files/".$i['filename']."'><span class='material-icons'>download</span></a></div></div><br>";
            }
        }
        $en=$i['time'];
    }
    if($id==0){echo "<h2>No messages<h2>";}
    echo "</div></div>";
}
echo"</section>";
}
?>
<?php
if(isset($_POST['sent_msg'])){
$ti=time();
$timer=$_POST['timer'];
echo "<input type='number' style='display:none' id='ee' value=$timer><script>reloader();</script>";
echo "
<input type='number' style='display:none' id='ee' value=0>
<style>
#chatbar{display:block;}
#inner_chat{display:block;}
#inputer{display:block;}
#message{display:none;}
#founded{font-size:xx-large}
#found{
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;
}</style>
<script>document.getElementById('c').value=1;</script>
";
$my_id=$_POST['my_id'];
$chat_id=$_POST['chat_id'];
$msg=$_POST['msg'];
$file=0;
$filename='';
$file=$_POST['is_file'];
if($file==1){
$filename=$_FILES['file']['name'];
}
$stmt="insert into chat(my_id,chat_id,message,time,file,filename) values('$my_id','$chat_id','$msg','$timer','$file','$filename')";
$stmt1="select * from chat where time=$timer";
$res=$conn->query($stmt1);
if(mysqli_num_rows($res)==0){
if($msg!=''||$file==1){
    $conn->query($stmt);
}
if($file==1){
$target='../files/';
$target_file=$target.basename($_FILES['file']['name']);
move_uploaded_file($_FILES['file']['tmp_name'],$target_file);
}
}

echo "<style>
#chatbar{display:block;}
#inner_chat{display:block;}
#inputer{display:block;}
#message{display:none;}
#searchbar{display:none;}
#back{display:inline;}
#resu{display:none;}
#founded{font-size:xx-large}
#found{
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;
}
</style><script>document.getElementById('c').value=1;</script>
";
}
?>