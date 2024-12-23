<?php

//decode by nige112
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$arr = [["code" => "201", "msg" => "非法请求"]];
	exit(json_encode($arr, JSON_UNESCAPED_UNICODE));
}
$iteace = "0";
if (is_file("./config.php")) {
	require "./config.php";
} else {
	exit("未检测到配置文件：<span style=\"color: red;\">config.php</span>，若您是首次使用请先进行安装,删除文件夹 <span style=\"color: red;\">[install/]</span> 下的 <span style=\"color: red;\">[ins.bak]</span> 文件后进行安装。");
}
require "./api/wz.php";
$useke = addslashes(htmlspecialchars($_GET["useke"]));
$sql = "select * from user where username = '{$useke}'";
$result = $conn->query($sql);
if (!mysqli_num_rows($result) > 0) {
	exit("<script language=\"JavaScript\">;alert(\"账号不存在!\");location.href=\"../index.php\";</script>");
}
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>找回密码 - <?php echo $name;?></title>
    <!--为搜索引擎定义关键词-->
    <meta name="keywords" content="<?php echo $name;?>">
    <!--为网页定义描述内容 用于告诉搜索引擎，你网站的主要内容-->
    <meta name="description" content="<?php echo $name . "," . $subtitle;?>">
    <meta name="author" content="<?php echo $name;?>">
    <meta name="copyright" content="<?php echo $name;?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0, user-scalable=no minimal-ui">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $icon;?>" /><!-- Standard iPhone -->
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $icon;?>" /><!-- Retina iPhone -->
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $icon;?>" /><!-- Standard iPad -->
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $icon;?>" /><!-- Retina iPad -->
    <link rel="icon" href="<?php echo $icon;?>" type="image/x-icon" />
    <meta name="robots" content="index,follow">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="x-rim-auto-match" content="none">
    <?php 
if ($rosdomain == 1) {
	?><meta name="referrer" content="no-referrer"><?php 
}
?>    <link rel="stylesheet" href="<?php echo $iconurl_url;?>">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css?v=<?php echo $resversion;?>">
    <link rel="stylesheet" type="text/css" href="./assets/mesg/dist/css/style.css?v=<?php echo $resversion;?>"><!--引入弹窗对话框-->
    <?php echo $scfontzt;?>    <?php 
$folderPath = "./user/bobg/";
if (!file_exists($folderPath)) {
	mkdir($folderPath, 511, true);
}
if (file_exists("./user/bobg/bobg.jpg")) {
	?><!--背景图--><style>body{background-image: url(./user/bobg/bobg.jpg);}</style><?php 
} elseif (file_exists("./user/bobg/bobg.png")) {
	?><!--背景图--><style>body{background-image: url(./user/bobg/bobg.png);}</style><?php 
} elseif (file_exists("./user/bobg/bobg.jpeg")) {
	?><!--背景图--><style>body{background-image: url(./user/bobg/bobg.jpeg);}</style><?php 
} elseif (file_exists("./user/bobg/bobg.gif")) {
	?><!--背景图--><style>body{background-image: url(./user/bobg/bobg.gif);}</style><?php 
}
?>    <?php echo "<style>" . $filtercucss . "</style>";?></head>
<body class="<?php 
if (isset($_COOKIE["dark_theme"])) {
	if ($_COOKIE["dark_theme"] == "dark-theme") {
		echo "dark-theme";
	}
}
echo "\">
    ";
if ($pagepass != "") {
	if (isset($_COOKIE["pagepass"])) {
		if ($_COOKIE["pagepass"] != md5(md5($pagepass))) {
			include "./site/pagepass.php";
		}
	} else {
		include "./site/pagepass.php";
	}
}
?>    <!--网页主体框架-->
    <div class="centent">
        <!-- 页面载体 -->
        <div class="sh-main setup-main">
            <!-- 头部 -->
            <div class="sh-main-head setup-main-head">
                <!-- 顶部菜单 -->
                <div class="sh-main-head-top setup-main-top" id="sh-main-head-top">
                    <!-- 左边 -->
                    <div class="sh-main-head-top-left">
                        <div class="sh-main-head-top-left-s" onclick="location.href='./index.php'">
                            <i class="iconfont icon-weibiaoti al-sxbh" id="top-left-1"></i>
                        </div>
                        <div class="sh-main-head-top-left-s setup-main-head-top-left-s">
                            <span class="setup-main-title">返回</span>
                        </div>
                    </div>
                    <!-- 右边 -->
                    <!--div class="sh-main-head-top-right">
                    </div-->
                </div>

            </div>
            <!-- 头部 end -->
            
            <!-- 设置内容区域 -->

            <div class="sh-login-main-con" style="margin-top: 0px;background: var(--cobg);padding-top: 10px;">
                    <div class="sh-login-main-con-anu">
                    <p>账号</p>
                        <input type="text" name="zh" id="saf-zh" spellcheck="false" minlength="5" maxlength="32" required="required" value="<?php echo $useke;?>" placeholder="账号" disabled style="border-bottom: 0px solid #f0f0f0;">
                    </div>
                    <div class="sh-login-main-con-anu" id="sh-login-main-con-anu">
                    <p>邮箱</p>
                        <input type="email" name="email" id="saf-email" spellcheck="false" maxlength="100" required="required" value="" placeholder="输入您账号绑定的邮箱" pattern="^[a-z0-9]+([._\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$" title="请输入正确的邮箱格式" style="border-bottom: 0px solid #f0f0f0;" autocomplete="off">
                    </div>
                    <div class="sh-login-main-con-anu">
                    <p>验证码</p>
                        <input type="password" name="pwd" id="saf-yzm" spellcheck="false" minlength="3" maxlength="16" required="required" value="" placeholder="输入邮箱验证码" style="border-bottom: 0px solid #f0f0f0;">
                    </div>
                    <div class="sh-login-main-con-anu">
                    <p>新密码</p>
                        <input type="password" name="pwd" id="saf-pass" spellcheck="false" minlength="3" maxlength="16" required="required" value="" placeholder="设置您的新密码" style="border-bottom: 0px solid #f0f0f0;">
                    </div>
                    <div class="sh-login-main-con-anu" id="sh-fsyk">
                    <a href="JavaScript:;" onclick="zhfsyzm()" id="sh-fsyzm-k">发送验证码</a>
                    </div>
                    
                    <div class="sh-login-main-bot" style="margin-bottom: 30px;">
                        <input type="button" value="重置" class="sh-right" id="sh-czmman-a" onclick="czmman()">
                    </div>
                    
                    </div>

            <!-- 设置内容区域 end -->

        </div>
        <!-- 页面载体 end -->
      
      



 
<!--版权-->
<div class="sh-copyright">
    <span class="sh-copyright-banquan" id="sh-copyright-banquan"><?php echo $copyright;?></span>&nbsp;
    <?php 
if ($beian != "") {
	echo "<span class=\"sh-copyright-banquan\">" . html_entity_decode($beian) . "</span>";
}
?></div>
<!--版权-->


    </div>

    <script type="text/javascript" src="./assets/js/repass.js?v=<?php echo $resversion;?>"></script>
    <script type="text/javascript" src="./assets/mesg/dist/js/sh-noytf.js?v=<?php echo $resversion;?>"></script><!--引入弹窗对话框-->
    <?php echo "<script type=\"text/javascript\">" . $filtercujs . "</script>";?></body>
</html>