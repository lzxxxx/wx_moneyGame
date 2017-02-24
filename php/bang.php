<?php 
header("Content-type:text/html;charset:utf-8");
$conn = mysqli_connect("localhost","root","root","moneyGame");
$conn->query('set names utf8');

$sel = "select * from users order by score desc limit 0,5";
$res = $conn->query($sel);

$arr = array();
while ($row = $res->fetch_assoc()) {
	$arr[] = $row;
}
$json = json_encode($arr);
echo $json;
?>