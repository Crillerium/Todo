<?php
function todo(){
$text = file_get_contents('todo.txt');
$strarr = explode(';',$text);
$num = 0;
for($i=0;$i<count($strarr);$i++){
if(false !== strstr($strarr[$i],":::")){
$num++;
}
}
return '今日有 '.$num.' 项任务待完成';
}

function when()
{
    $week = array("日", "一", "二", "三", "四", "五", "六");
    return date("Y-m-d")." 星期".$week[date("w")];
}

function color()
{
    $str = '0123456789ABCDEF';
    $estr = '#';
    $len = strlen($str);
    for ($i = 1; $i <= 6; $i++) {
        $num = rand(0, $len - 1);
        $estr = $estr . $str[$num];
    }
    return $estr;
}

function word()
{
    $get = @file_get_contents('https://v1.jinrishici.com/all.json');
    $data = json_decode($get, true);
    return $data['content'];
}

function push()
{
    $access_token = access_token();
    if ($access_token == 400) {
        return json_encode(array('code' => 0, 'message' => '获取access_token失败'));
    }
    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
    $myurl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$pushurl = str_replace("wxpush.php","",$myurl);
    $data = array(
        "touser" => 'oNrTH5l6F-O4PoCRu5fb2WWerU5s', //openid
        "template_id" => 'pDkfV6yMYQ85lgK8qcpCrX96cxSeS0nuF_MtXBuDr2g', //模板id
        "url" => $pushurl,
        "data" => array(
            'date' => array(
                'value' => when(),
                'color' => color()
            ),
            'todo' => array(
                'value' => todo(),
                'color' => color()
            ),
            'word' => array(
                'value' => word(),
                'color' => color()
            )
        ) //模板数据
    );
    return http_post_json($url, json_encode($data)); //发送请求
}


function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr)
        )
    );
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return json_encode(array($httpCode, $response));
}

//获取access_token
function access_token()
{
    $appId = 'wx66aac0c8ae53741c';
    $appSecret = '45040afa6b9c36af3629bbdc0b464e1b';
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appId . "&secret=" . $appSecret;
    $ch = curl_init(); //初始化curl
    curl_setopt($ch, CURLOPT_URL, $url); //要访问的地址
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //跳过证书验证
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
    $data = json_decode(curl_exec($ch), true);
    if (curl_errno($ch)) {
        var_dump(curl_error($ch)); //若错误打印错误信息
    }

    curl_close($ch); //关闭curl
    if ($data['access_token'] != "400") {
        return $data['access_token'];
    } else {
        return 400;
    }
}
echo push();
