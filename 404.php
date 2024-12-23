<?php

//decode by nige112
if ($_GET["close"] != "true") {
	exit("非法访问!");
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>页面出错!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0, user-scalable=no minimal-ui">
    <style>*{margin: 0;padding: 0;}.content{padding: 10px 25px;}.title{font-size: 100px;color: #3e3e3e;}.text{font-size: 30px;margin-top: 20px;color: #3e3e3e;}.time{font-size: 18px;margin-top: 15px;color: #3e3e3e;}</style>
</head>
<body>
    <div class="content">
        <div class="title">:(</div>
        <h2 class="text">暂时无法完成你的请求，请重试!</h2>
        <p class="time">Time：<?php echo date("Y-m-d H:i:s");?></p>
    </div>
</body>
</html>