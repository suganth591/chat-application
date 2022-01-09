function show_menu(){
    if(document.getElementById('arrow').innerHTML=="arrow_drop_down"){
    document.getElementById('arrow').innerHTML="arrow_drop_up";
    document.getElementById('menubar').style.display="block";
    }
    else{
        document.getElementById('arrow').innerHTML="arrow_drop_down";
         document.getElementById('menubar').style.display="none";
    }
}
function message(){
if(document.getElementById('c').value=='0'){
document.getElementById("chatbar").style.right="40px";
document.getElementById("chatbar").style.display="block";
document.getElementById('searchbar').style.display='block';
document.getElementById('c').value='1';
}else{
    document.getElementById("chatbar").style.right="-1000px";
    document.getElementById("chatbar").style.display="none";
    document.getElementById('c').value='0';
}
}
function openit(){
    document.getElementById('inner_chat').style.display='block';
    document.getElementById('inputer').style.display='block';
    document.getElementById('message').style.display='none';
    document.getElementById('resu').style.display='none';
    document.getElementById('searchbar').style.display='none';
    document.getElementById('back').style.display='inline';
    document.getElementById('founded').style.fontSize='xx-large';
    document.getElementById('found').style.borderBottomRightRadius='0px';
    document.getElementById('found').style.borderBottomLeftRadius='0px';
    document.getElementById('found').style.borderRadius='0px';
}
function reloader(){
    var i=document.getElementById('ee').value;
    const da = new Date();
    let timee = ((da.getTime())-(19800000));
    rem=timee%1000;
    timee-=rem;
    timee/=1000;
    rem=i%1000;
    i-=rem;
    i/=1000;
    if((timee)-(i)<=0.001){
        location.reload();
    }
}
function closeit(){
    document.getElementById('inner_chat').style.display='none';
    document.getElementById('inputer').style.display='none';
    document.getElementById('back').style.display='none';
    document.getElementById('message').style.display='block';
    document.getElementById('searchbar').style.display='block';
    document.getElementById('resu').style.display='block';
    document.getElementById('founded').style.fontSize='xx-large';
    document.getElementById('found').style.borderBottomRightRadius='0px';
    document.getElementById('found').style.borderBottomLeftRadius='0px';
    document.getElementById('found').style.borderRadius='0px';
}
function logout(){
    window.location.replace('../php/login.php');
    window.history.replaceState(null,null,window.location.href);
}
function timerClock()
{
setTimeout('timerClock()',1);        
const d = new Date();
let time = d.getTime();
document.getElementById('timering').value=(time-19800000);
let rem=time%1000;
time-=rem;
time/=1000;
let s=(time%60);
rem=time%60;
time-=rem;
time/=60;
let m=(time%60);
rem=time%60;
time-=rem;
time/=60;
let h=time%24;
if(s<10){
    s='0'+s;
}
if(m<10){
    m='0'+m;
}
if(h<10){
    h='0'+h;
}
document.getElementById('showtime').innerHTML=h+':'+m+':'+s;
}
function closed(){
    document.getElementById('found').style.display='none';
    document.getElementById('resu').style.display='none';
    document.getElementById('rece').style.display='block';
}
function file_up(){
    var filee=document.getElementById('file');
    if(filee.files.length>0){
        document.getElementById('attach').style.background='rgb(158, 231, 99)';
        document.getElementById('is_file').value=1;
    }
text=filee.value +"\n\n Was selected . Is that ok for you to upload.";
if(confirm(text)==true){

}else{
    location.reload();
}
}
function post(a){
    if(a==0){
    document.getElementById("post").style.display="none";
    document.getElementById("new_posts").style.display="block";
    }
    else{
        document.getElementById("post").style.display="block";
        document.getElementById("new_posts").style.display="none";
    }
    }
    var id=document.getElementById("hidden_id").value;
    var name=document.getElementById("hidden_name").value;
    var email=document.getElementById("hidden_email").value;
    var phone=document.getElementById("hidden_phone").value;
    var DOB=document.getElementById("hidden_DOB").value;
    document.getElementById("name_1").innerHTML=name;
    document.getElementById("set").value=id;
    document.getElementById("email").innerHTML=email;
    document.getElementById("DOB").innerHTML=DOB;
    document.getElementById("phone").innerHTML=phone
    document.getElementById("name").innerHTML=name;
    function profile(){
        
        document.getElementById("my_profile").style.display="block";
    }