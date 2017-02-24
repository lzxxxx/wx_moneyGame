<?php 
// https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx474cfa64fb9de233&redirect_uri=http%3A%2F%2F1.lzxdemo1.applinzi.com%2FmoneyGame%2Findex.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect
$code = $_GET['code'];
$appid = 'wx474cfa64fb9de233';
$secret = 'd247fd4450c057cc0c705f5b0dfc00af';
// 根据code获取access_token
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
$str = file_get_contents($url);
$json = json_decode($str);
// var_dump($json);
// echo "<br>";
//获取单个用户信息
$openid = $json->openid;
$access_token = $json->access_token;
$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
//获取接口信息
echo $url."<br>";
$user = file_get_contents($url);
$obj = json_decode($user);
// var_dump($obj);
echo "<br>";
echo "<table>";
echo "<tr>
    <td><img style='width:50px;' src='{$obj->headimgurl}' /></td>
    <td>{$obj->nickname}</td>
    <td>".($obj->sex==1?"男":"女")."</td>
    <td>{$obj->city}</td>
    </tr>";
echo "</table>";

 ?>