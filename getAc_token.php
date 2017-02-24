<?php 
// https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx474cfa64fb9de233&redirect_uri=http%3A%2F%2F1.wxmoneygame.applinzi.com%2FmoneyGame%2Findex.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect

$appid = 'wx474cfa64fb9de233';
$secret = 'd247fd4450c057cc0c705f5b0dfc00af';
//获取access_token地址
$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret;
//先查看access_token.txt里是否有access_token
//新浪云上面不能直接写入文件，需要用到新浪云上的Memcached缓存空间
$str = file_get_contents("saemc://access_token.txt");
$data = json_decode($str);
//判断是否过期，如果是重新获取access_token值
if ($data->time<time()) {
    // 获取access_token地址的内容
    $str = file_get_contents($url);
    // 把获取到的JSON字符串转为json对象
    $json = json_decode($str);
    //记录获取到的access_token和时间，+7000意思是在7000秒后就重新申请
    $data->access_token = $json->access_token;
    $data->time = time()+7000;
    $str = json_encode($data);
    //把获取到access_token值保存到access_token.txt
    file_put_contents("saemc://access_token.txt", $str);
}
$access_token = $data->access_token;

//获取用户列表
// $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token={$access_token}";
// //获取借口信息
// $list = file_get_contents($url);
// $listObj = json_decode($list);
// // var_dump($listObj);
// //获取列表中openid信息
// $arr = $listObj->data->openid;
// // 循环openid
// for ($i=0; $i < count($arr); $i++) { 
//     $openid = $arr[$i];
//     // 获取用户接口信息
//     $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}&lang=zh_CN";
//     $user = file_get_contents($url);
//     $obj = json_decode($user);
//     // 输出信息
//     echo "<table>";
//     echo "<tr>
//         <td><img style='width:50px;' src='{$obj->headimgurl}' /></td>
//         <td>{$obj->nickname}</td>
//         <td>".($obj->sex==1?"男":"女")."</td>
//         <td>{$obj->city}</td>
//         </tr>";
//     echo "</table>";
// }

// exit();

//获取单个用户信息
// $openid = "oKxnav_KL5VczaHH8xzRB2Ej_RcE";
// $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}&lang=zh_CN";
// //获取借口信息
// $user = file_get_contents($url);
// $obj = json_decode($user);
// echo "<table>";
// echo "<tr>
//     <td><img style='width:50px;' src='{$obj->headimgurl}' /></td>
//     <td>{$obj->nickname}</td>
//     <td>".($obj->sex==1?"男":"女")."</td>
//     <td>{$obj->city}</td>
//     </tr>";
// echo "</table>";

 ?>