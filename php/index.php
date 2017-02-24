<?php 
header("Content-type:text/html;charset:utf-8");
$conn = mysqli_connect("localhost","root","root","moneyGame");
$conn->query('set names utf8');

$name = $_GET['username'];
$score = $_GET['score'];
$tel = $_GET['tel'];
$sel = "select * from users where username='$name'";
$upd = "update users set score=$score,tel=$tel where username='$name'";
$ins = "insert into users(username,score,tel) values ('$name','$score','$tel')";
$res = $conn->query($sel);
if(mysqli_affected_rows($conn)>0){
	$conn->query($upd);
	echo "update";
}else{
	$conn->query($ins);
	echo "insert";
}
?>