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
if ($userdlzt == 0) {
	header("Location:./index.php");
	exit;
}
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>个人后台</title>
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
?>    <div class="centent">
        <div class="sh-main setup-main">
            <div class="sh-main-head setup-main-head">
                <!-- 顶部菜单 -->
                <div class="sh-main-head-top setup-main-top" id="sh-main-head-top">
                    <!-- 左边 -->
                    <div class="sh-main-head-top-left">
                        <div class="sh-main-head-top-left-s" onclick="location.href='./home.php'">
                            <i class="iconfont icon-weibiaoti al-sxbh" id="top-left-1"></i>
                        </div>
                        <div class="sh-main-head-top-left-s setup-main-head-top-left-s">
                            <span class="setup-main-title">设置</span>
                        </div>
                    </div>
                    <!-- 右边 -->
                    <!--div class="sh-main-head-top-right">
                    </div-->
                </div>

            </div>

            
            <div class="sh-setup-main-xbb" id="setuptx" lang="60">
            <!--新版UI-头像-->
                <div class="setup-main-lieb-xtitle" onclick="setuptx()">
                    <span>头像</span>
                    <div class="setup-main-lieb-title-y">
                        <img src="./assets/img/thumbnail.svg" data-src="<?php echo $zjimg;?>" id="setup-main-lieb-qx-imgt" class="setup-main-lieb-title-y-imgt" alt="">
                        <i class="iconfont icon-weibiaotiy al-sxbh-setup1" id="setup-main-lieb-qtx-img"></i>
                    </div>
                </div>
                <!-- 嵌入内容 -->
                <form action="./api/uploadavatar.php" method="post" enctype="multipart/form-data" class="setup-main-lieb-xcontent">
                    <!--内容标题-->
                    <div class="sh-setup-formup">
                        <img src="./assets/img/thumbnail.svg" data-src="" id="setup-formup-img" alt="">
                        <span class="cupload-upload-btn" id="cupload-upload-btn">+</span>
                        <input type="file" name="file" accept="image/*" id="files" required>
                    </div>
                    
                    <div id="sctxs"><input type="submit" class="setup-main-tj" name="submit" value="上传" onclick="sctxs()"></div>
                    
                </form>
            </div>
            
            <div class="sh-setup-main-xb" id="setupnc" lang="45">
                <!--新版UI-昵称-->
                <div class="setup-main-lieb-xtitlee" onclick="setupnc()">
                    <span>昵称</span>
                    <div class="setup-main-lieb-title-y">
                        <p id="setup-main-lieb-title-y-usernc"><?php echo $zjnc;?></p>
                        <i class="iconfont icon-weibiaotiy al-sxbh-setup1" id="setup-main-lieb-qnc-img"></i>
                    </div>
                </div>
                <!-- 嵌入内容 -->
                <div class="setup-main-lieb-xcontent">
                    <!--内容标题-->
                    <input type="text" name="" id="usernc" value="<?php echo $zjnc;?>" placeholder="设置昵称"minlength="1" maxlength="10" spellcheck="false"/>
                    <div class="setup-main-lieb-xgxan" id="zhnc" onclick="zhnc()">
                    <span>更新</span>
                    </div>
                </div>
            </div>
            
            <div class="sh-setup-main-xb" id="setupqm" lang="45">
                <!--新版UI-签名-->
                <div class="setup-main-lieb-xtitlee" onclick="setupqm()">
                    <span>签名</span>
                    <div class="setup-main-lieb-title-y">
                        <p id="setup-main-lieb-title-y-userqm"><?php echo $zjsign;?></p>
                        <i class="iconfont icon-weibiaotiy al-sxbh-setup1" id="setup-main-lieb-qqm-img"></i>
                    </div>
                </div>
                <!-- 嵌入内容 -->
                <div class="setup-main-lieb-xcontent">
                    <!--内容标题-->
                    <input type="text" name="" id="userqm" value="<?php echo $zjsign;?>" placeholder="设置签名" minlength="1" maxlength="50" spellcheck="false"/>
                    <div class="setup-main-lieb-xgxan" id="zhqm" onclick="zhqm()">
                    <span>更新</span>
                    </div>
                </div>
            </div>
            
            <div class="sh-setup-main-xb" id="setupwz" lang="45">
                <!--新版UI-网址-->
                <div class="setup-main-lieb-xtitlee" onclick="setupwz()">
                    <span>网址</span>
                    <div class="setup-main-lieb-title-y">
                        <p id="setup-main-lieb-title-y-userurl"><?php echo $zjurl;?></p>
                        <i class="iconfont icon-weibiaotiy al-sxbh-setup1" id="setup-main-lieb-qwz-img"></i>
                    </div>
                </div>
                <!-- 嵌入内容 -->
                <div class="setup-main-lieb-xcontent">
                    <!--内容标题-->
                    <input type="url" name="" id="userurl" value="<?php echo $zjurl;?>" placeholder="填写您的网站" minlength="1" spellcheck="false"/>
                    <div class="setup-main-lieb-xgxan" id="zhwz" onclick="zhwz()">
                    <span>更新</span>
                    </div>
                </div>
            </div>
            

                
                
                
                
                
                
            
            <!-- 账号与安全 -->
            <div class="setup-main-lieb" id="setup-main-lieb-aq" lang="45">
                <!-- 标题 -->
                <div class="setup-main-lieb-title" onclick="anquan()">
                    <span>安全中心</span>
                    <i class="iconfont icon-weibiaotiy al-sxbh-setup" id="setup-main-lieb-aq-img"></i>
                </div>
                <!-- 嵌入内容 -->
                <div class="setup-main-lieb-content">
                    <!--内容标题-->
                    <span>账号</span>
                    <input type="text" name="" id="userzh" value="<?php echo $zjzhq;?>" placeholder="UID不可更改" readonly="readonly" disabled/>
                </div>
                <div class="setup-main-lieb-content">
                    <!--内容标题-->
                    <span>旧密码</span>
                    <input type="password" name="" id="usermm" value="" placeholder="输入旧密码"minlength="3" maxlength="16" spellcheck="false"/>
                </div>
                <div class="setup-main-lieb-content">
                    <!--内容标题-->
                    <span>新密码</span>
                    <input type="text" name="" id="userxmm" value="" placeholder="输入新密码"minlength="3" maxlength="16" spellcheck="false"/>
                </div>
                <div class="setup-main-lieb-content">
                    <!--内容标题-->
                    <span>邮箱</span>
                    <input type="email" name="" id="userem" value="<?php echo $zjemail;?>" placeholder="设置您的邮箱" spellcheck="false"/>
                </div>
                
                <!--按钮-->
                <div class="setup-main-lieb-gxan" id="zhyanxg" onclick="zhyanxg()">
                    <span>更新</span>
                </div>

            </div>
            
            
            
            
            
            
            
            
            
            
            
            <!-- 权限与状态 -->
            <div class="setup-main-lieb" id="setup-main-lieb-qx" lang="45">
                <!-- 标题 -->
                <div class="setup-main-lieb-title" onclick="quanxian()">
                    <span>权限管理</span>
                    <i class="iconfont icon-weibiaotiy al-sxbh-setup" id="setup-main-lieb-qx-img"></i>
                </div>
                <!-- 嵌入内容 -->
                <div class="setup-main-lieb-content-kg">
                    <!--开关-->
                    <span>后台管理权限</span>
                    <div class="setup-main-lieb-content-kg-an">
                        <?php 
if ($zjfbqx == 0) {
	$fbsty = "background: rgb(238 238 238);justify-content: flex-start";
} elseif ($zjfbqx == 1) {
	$fbsty = "background: var(--theme);justify-content: flex-end";
}
?>                        <div class="setup-main-lieb-content-kg-an-xin" style="<?php echo $fbsty;?>;cursor: not-allowed;"><p></p></div>
                    </div>
                </div>
                <div class="setup-main-lieb-content-kg">
                    <!--开关-->
                    <span>接收邮件通知</span>
                    <div class="setup-main-lieb-content-kg-an">
                        <?php 
if ($zjemtz == 0) {
	$fbstyy = "background: rgb(238 238 238);justify-content: flex-start";
	$ztema = "0";
} elseif ($zjemtz == 1) {
	$fbstyy = "background: var(--theme);justify-content: flex-end";
	$ztema = "1";
}
?>                        <div id="emaitz"  onclick="emailkq()" class="setup-main-lieb-content-kg-an-xin" style="<?php echo $fbstyy;?>" lang="<?php echo $ztema;?>"><p></p></div>
                    </div>
                </div>
            </div>



            <div class="setup-main-lieb-logout" onclick="logut()">
                <p>退出账号</p>
            </div>


        </div>

      
      




 <div class="sh-copyright">
    <span class="sh-copyright-banquan" id="sh-copyright-banquan"><?php echo $copyright;?></span>&nbsp;
    <?php 
if ($beian != "") {
	echo "<span class=\"sh-copyright-banquan\">" . html_entity_decode($beian) . "</span>";
}
?></div>





    </div>

    <script type="text/javascript" src="./assets/js/setup.js?v=<?php echo $resversion;?>"></script>
    <script type="text/javascript" src="./assets/mesg/dist/js/sh-noytf.js?v=<?php echo $resversion;?>"></script>
    <?php echo "<script type=\"text/javascript\">" . $filtercujs . "</script>";?></body>
</html>