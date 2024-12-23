<?php

//decode by nige112
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$arr = [["code" => "201", "msg" => "非法请求"]];
	exit(json_encode($arr, JSON_UNESCAPED_UNICODE));
}
if (isset($_SERVER["HTTP_REFERER"])) {
	$previousPage = $_SERVER["HTTP_REFERER"];
	if (strpos($previousPage, "home.php") !== false) {
		$tiaourl = "./home.php";
	} elseif (strpos($previousPage, "edit.php") !== false) {
		$tiaourl = "./home.php";
	} elseif (strpos($previousPage, "index.php") !== false) {
		$tiaourl = "./index.php";
	} elseif (strpos($previousPage, "archives.php") !== false) {
		$tiaourl = $previousPage;
	}
} else {
	$tiaourl = "./index.php";
}
$iteace = "0";
if (is_file("./config.php")) {
	require "./config.php";
} else {
	exit("未检测到配置文件：<span style=\"color: red;\">config.php</span>，若您是首次使用请先进行安装,删除文件夹 <span style=\"color: red;\">[install/]</span> 下的 <span style=\"color: red;\">[ins.bak]</span> 文件后进行安装。");
}
require "./api/wz.php";
$cid = addslashes(htmlspecialchars($_GET["cid"]));
if ($cid == "") {
	exit("<script language=\"JavaScript\">;alert(\"未传入ID!\");location.href=\"" . $tiaourl . "\";</script>");
}
$sql = "select * from essay where cid = '{$cid}'";
$result = $conn->query($sql);
if (!mysqli_num_rows($result) > 0) {
	exit("<script language=\"JavaScript\">;alert(\"此朋友圈不存在或已被删除!\");location.href=\"" . $tiaourl . "\";</script>;");
}
$data_result = mysqli_query($conn, "select * from essay where cid='{$cid}'");
$data_row = mysqli_fetch_array($data_result);
if ($data_row["ptpys"] == 1 && $data_row["ptpaud"] == 1 || $user_zh == $glyadmin) {
} else {
	if ($userdlzt == 1) {
		$sql = "SELECT ptpuser FROM essay WHERE cid = '{$cid}'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$ptpuser = $row["ptpuser"];
			if ($ptpuser == $user_zh) {
			} else {
				exit("<script language=\"JavaScript\">;alert(\"此朋友圈未通过审核或已被隐藏,暂时不可查看!\");location.href=\"" . $tiaourl . "\";</script>;");
			}
		}
	} else {
		exit("<script language=\"JavaScript\">;alert(\"此朋友圈未通过审核或已被隐藏,暂时不可查看!\");location.href=\"" . $tiaourl . "\";</script>;");
	}
}
if ($userdlzt == 1) {
	$sql = "SELECT ptpuser FROM essay WHERE cid = '{$cid}'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$ptpuser = $row["ptpuser"];
		if ($ptpuser == $user_zh) {
			$dewzbs = "<i class=\"iconfont icon-shanchu\" id=\"sh-delewza-" . $cid . "\" title=\"点击删除此内容\" onclick=\"delewenz()\"></i>";
			$headrigft1 = "<div class=\"sh-main-head-top-right-s\" onclick=\"viewsetk()\">
                   <i class=\"iconfont icon-gengduo al-sxb\" id=\"top-right-1\"></i>
                 </div>";
			$dewzplz = "1";
		} else {
			$dewzbs = "";
			$headrigft1 = "";
			$dewzplz = "0";
		}
	}
	if ($user_zh == $glyadmin) {
		$dewzbs = "<i class=\"iconfont icon-shanchu\" id=\"sh-delewza-" . $cid . "\" title=\"点击删除此内容\" onclick=\"delewenz()\"></i>";
		$headrigft1 = "<div class=\"sh-main-head-top-right-s\" onclick=\"viewsetk()\">
                   <i class=\"iconfont icon-gengduo al-sxb\" id=\"top-right-1\"></i>
                 </div>";
		$dewzplz = "1";
		$glyszd = "terewsq";
	} else {
		$glyszd = "";
	}
} else {
	$dewzbs = "";
	$headrigft1 = "";
	$dewzplz = "0";
}
$conn->close();
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>内容详情</title>
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
    <link rel="stylesheet" type="text/css" href="./assets/css/jquery.fancybox.min.css?v=<?php echo $resversion;?>">
    <style>
        .sh-zanp{
            width: auto;
            margin-left: -55px;
        }
    </style>
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
        <div class="sh-main">
            <div class="sh-main-head">
                <div class="sh-main-head-top" id="sh-main-head-top">
                    <!-- 左边 -->
                    <div class="sh-main-head-top-left">
                        <div class="sh-main-head-top-left-s" onclick="location.href='<?php echo $tiaourl;?>'">
                            <i class="iconfont icon-weibiaoti al-sxb" id="top-left-1"></i>
                        </div>
                        <div class="sh-view-head-top-left-s">
                            <span class="setup-view-title" id="setup-view-title">内容详情</span>
                        </div>
                    </div>
                    <!-- 右边 -->
                    <div class="sh-main-head-top-right">
                        <?php echo $headrigft1;?>                    </div>
                </div>

<?php 
if ($userdlzt == 0) {
	$wymz = $glyname;
	$wylj = "JavaScript:;";
	$wyimg = $glyimg;
	$wyqm = $sign;
	$wyhomeimg = $homimg;
} else {
	$wymz = $zjnc;
	$wylj = "./home.php";
	$wyimg = $zjimg;
	$wyqm = $zjsign;
	$wyhomeimg = $homimg;
}
?>

                <div class="sh-main-head-img"
                    style="background-image:url(<?php echo $wyhomeimg;?>)">
                </div>
            </div>
            
            <div class="sh-main-head-headimg">
                <div class="sh-main-head-headimg-tx">
                    <h4><?php echo $wymz;?></h4>
                    
                    <a href="<?php echo $wylj;?>"><img src="./assets/img/thumbnail.svg" data-src="<?php echo $wyimg;?>" alt="头像"></a>
                </div>
                <div class="sh-main-head-headimg-qm">
                    <p><?php echo $wyqm;?></p>
                </div>
            </div>
            
            
            

            <div style="display:none;position: absolute;top: -100%;" id="pinglunkfk">
             <div class="sh-pinglunkuang" id="pinglunkuang">
                    
                    
                    <div class="sh-pinglun" id="sh-pinglun">
                        <!--游客模式-->
                    <?php 
if ($userdlzt == 0) {
	if ($viscomm == 0) {
		?>

                        <div class="sh-plk-yk" id="sh-plk-yk">
                        <div class="sh-plk-yk-z" style="margin-left: 8px;"><input id="vis_name" type="text" value="" maxlength="10" minlength="1" placeholder="昵称*" autocomplete="off"></div>
                        <div class="sh-plk-yk-zz"><input id="vis_email" type="text" value="" maxlength="100" minlength="1" placeholder="邮箱*" autocomplete="off"></div>
                        <div class="sh-plk-yk-z" style="margin-right: 8px;"><input id="vis_url" type="text" value="" maxlength="500" minlength="1" placeholder="网站" autocomplete="off"></div>
                    </div>
                        <?php 
	}
}
?>                        <!-- 输入框 -->
                        <div class="sh-pinglun-s">
                            <textarea name="text" id="bletext" class="form-controll" placeholder="评论" required="" spellcheck="false" maxlength="500" onchange="this.value=this.value.substring(0, 500)" onkeydown="this.value=this.value.substring(0, 500)" onkeyup="this.value=this.value.substring(0, 500)" oninput="myjtbl()"></textarea>
                        </div>
                        <!-- 表情 -->
                        <div class="sh-pinglun-biao" id="biaoqing">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E591B5E591B5_2x.png" alt="::(呵呵)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E59388E59388_2x.png" alt="::(哈哈)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E59090E8888C_2x.png" alt="::(吐舌)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E5A4AAE5BC80E5BF83_2x.png" alt="::(太开心)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E7AC91E79CBC_2x.png" alt="::(笑眼)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E88AB1E5BF83_2x.png" alt="::(花心)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E5B08FE4B996_2x.png" alt="::(小乖)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E4B996_2x.png" alt="::(乖)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E68D82E598B4E7AC91_2x.png" alt="::(捂嘴笑)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E6BB91E7A8BD_2x.png" alt="::(滑稽)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E4BDA0E68782E79A84_2x.png" alt="::(你懂的)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E4B88DE9AB98E585B4_2x.png" alt="::(不高兴)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E68092_2x.png" alt="::(怒)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E6B197_2x.png" alt="::(汗)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E9BB91E7BABF_2x.png" alt="::(黑线)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E6B3AA_2x.png" alt="::(泪)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E79C9FE6A392_2x.png" alt="::(真棒)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E596B7_2x.png" alt="::(喷)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E6838AE593AD_2x.png" alt="::(惊哭)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E998B4E999A9_2x.png" alt="::(阴险)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E98499E8A786_2x.png" alt="::(鄙视)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E985B7_2x.png" alt="::(酷)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E5958A_2x.png" alt="::(啊)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E78B82E6B197_2x.png" alt="::(狂汗)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/what_2x.png" alt="::(what)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E79691E997AE_2x.png" alt="::(疑问)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E985B8E788BD_2x.png" alt="::(酸爽)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E59180E592A9E788B9_2x.png" alt="::(呀咩蹀)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E5A794E5B188_2x.png" alt="::(委屈)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E6838AE8AEB6_2x.png" alt="::(惊讶)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E79DA1E8A789_2x.png" alt="::(睡觉)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E7AC91E5B0BF_2x.png" alt="::(笑尿)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E68C96E9BCBB_2x.png" alt="::(挖鼻)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E59090_2x.png" alt="::(吐)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E78A80E588A9_2x.png" alt="::(犀利)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E5B08FE7BAA2E884B8_2x.png" alt="::(小红脸)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E68792E5BE97E79086_2x.png" alt="::(懒得理)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E58B89E5BCBA_2x.png" alt="::(勉强)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E788B1E5BF83_2x.png" alt="::(爱心)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E5BF83E7A28E_2x.png" alt="::(心碎)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E78EABE791B0_2x.png" alt="::(玫瑰)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E7A4BCE789A9_2x.png" alt="::(礼物)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E5BDA9E899B9_2x.png" alt="::(彩虹)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E5A4AAE998B3_2x.png" alt="::(太阳)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E6989FE6989FE69C88E4BAAE_2x.png" alt="::(星星月亮)"
                                onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E992B1E5B881_2x.png" alt="::(钱币)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E88CB6E69DAF_2x.png" alt="::(茶杯)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E89B8BE7B395_2x.png" alt="::(蛋糕)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E5A4A7E68B87E68C87_2x.png" alt="::(大拇指)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E8839CE588A9_2x.png" alt="::(胜利)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/haha_2x.png" alt="::(haha)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/OK_2x.png" alt="::(OK)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E6B299E58F91_2x.png" alt="::(沙发)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E6898BE7BAB8_2x.png" alt="::手纸" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E9A699E89589_2x.png" alt="::(香蕉)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E4BEBFE4BEBF_2x.png" alt="::(便便)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E88DAFE4B8B8_2x.png" alt="::(药丸)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E7BAA2E9A286E5B7BE_2x.png" alt="::(红领巾)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E89CA1E7839B_2x.png" alt="::(蜡烛)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E99FB3E4B990_2x.png" alt="::(音乐)" onclick="biaoqzj()">
                            <img src="./assets/img/thumbnail.svg" data-src="./assets/owo/paopao/E781AFE6B3A1_2x.png" alt="::(灯泡)" onclick="biaoqzj()">
                        </div>
                        <!-- 表情 end-->

                        <!-- 表情开关与评论发送 -->
                        <div class="sh-pinglun-fs">
                            <div class="sh-pinglun-fs-right">
                                <!-- 游客开关 -->
                                <?php 
if ($userdlzt == 0) {
	if ($viscomm == 0) {
		?>

                        <div class="sh-pinglun-fs-right-bqimg" id="ykkg" onclick="ykkg()">
                                    <i class="iconfont icon-yonghu1 ri-sxbqxz" id="sh-pinglun-fs-right-ykkgb" title="游客模式"></i>
                                </div>
                        <?php 
	}
}
?>                                <!-- 表情开关 -->
                                <div class="sh-pinglun-fs-right-bqimg" id="bqkg" onclick="bqkg()">
                                    <i class="iconfont icon-biaoqing ri-sxbqxz" id="sh-pinglun-fs-right-bqimg"></i>
                                </div>
                                <!-- 发送按钮 -->
                                <div class="sh-pinglun-fs-right-fs" id="sh-pinglun-fs-right-fs" onclick="fasongv()">
                                    <span>发送</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- cs -->
                    <div class="huifucanshu">
                        <p id="sh-tieid">-</p>
                        <p id="sh-tiehf">-</p>
                        <p id="sh-tieea">-</p>
                    </div>
                </div>
            </div>
            



            <div class="sh-nrbk" id="sh-nrbk" style="width:100%">
                <?php 
require "./config.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	exit("连接失败: " . $conn->connect_error);
}
$data_result = mysqli_query($conn, "select * from essay where cid='{$cid}'");
$row = mysqli_fetch_array($data_result);
$ptpuser = $row["ptpuser"];
$ptpimg = $row["ptpimg"];
$ptpname = $row["ptpname"];
$ptptext = $row["ptptext"];
$ptpimag = $row["ptpimag"];
$ptpvideo = $row["ptpvideo"];
$ptpmusic = $row["ptpmusic"];
$ptplx = $row["ptplx"];
$ptpdw = $row["ptpdw"];
$ptptime = $row["ptptime"];
$ptpgg = $row["ptpgg"];
$ptpggurl = $row["ptpggurl"];
$ptpys = $row["ptpys"];
$commauth = $row["commauth"];
$ptpaud = $row["ptpaud"];
$ptpip = $row["ip"];
$cid = $row["cid"];
$wid = $row["id"];
$partssp = explode("|", $ptpvideo);
$ptpvideo = $partssp[0];
$ptpvideofm = $partssp[1];
$imgar = explode("(+@+)", $ptpimag);
$coun = count($imgar);
if ($coun == 1) {
	$tusty = "grid-template-columns:1fr;width: 55%;";
} else {
	if ($coun == 4 || $coun == 2) {
		$tusty = "grid-template-columns:1fr 1fr;width: 55%;";
	} else {
		$tusty = "grid-template-columns:1fr 1fr 1fr;";
	}
}
if ($ptpgg == 1) {
	$ggdiv = "display: flex;";
	$ggurl = "<div class=\"sh-content-right-ggurl\"><i class=\"iconfont icon-lianjie1 ri-sxwzgg\"></i><a href=\"" . $ptpggurl . "\" target=\"_blank\">进一步了解</a></div>";
	$gps = "";
} else {
	$ggdiv = "display: none;";
	$ggurl = "";
	$gps = "<div class=\"sh-content-right-gps\"><a href=\"javascript:;\">" . $ptpdw . "</a></div>";
}
$time = strtotime($ptptime);
$wzfbsj = ReckonTime($time);
?>                <div class="sh-content sh-content2" id="sh-content-<?php echo $cid;?>">
                <!-- 左边 -->
                <div class="sh-content-left">
                    <!-- 头像 -->
                    <img src="./assets/img/thumbnail.svg" data-src="<?php echo $ptpimg;?>" alt="头像">
                </div>
                <!-- 右边 -->
                <div class="sh-content-right">
                    <!-- 昵称与内容 -->
                    <div class="sh-content-right-head">
                        <!-- 昵称 -->
                        <div class="sh-content-right-head-title">
                            <p><?php echo $ptpname;?></p>
                            <div class="sh-content-right-head-title-ad" style="<?php echo $ggdiv;?>">
                                <p>广告</p>
                            </div>
                        </div>
                        <!-- 内容 -->
                        <?php 
$contenttext0 = preg_replace("/<img[^>]+>/i", "", $ptptext);
$contenttext1 = preg_replace("/<span[^>]+>/i", "", $contenttext0);
$contenttext = preg_replace("/<a href=[^>]+>/i", "", $contenttext1);
$contenttext = str_replace(" ", "", $contenttext);
if (iconv_strlen($contenttext, "UTF-8") > 100) {
	$ptptext = "<span class=\"wzndhycyc\" id=\"sh-content-qwdid-" . $cid . "\">" . $ptptext . "</span><a href=\"JavaScript:;\" class=\"sh-content-quanwenan\" id=\"sh-content-quanwenan-" . $cid . "\" lang=\"0\" onclick=\"quanwenan()\">全文</a>";
} else {
	$ptptext = "<span>" . $ptptext . "</span>";
}
echo $ptptext;
echo "                        <!--span><!--?php echo \$ptptext;?></span--><!-- 图片 -->
                        ";
if ($ptplx == "only") {
	echo "<!-- 图片 -->";
} elseif ($ptplx == "img") {
	if ($coun > "1") {
		$picimg = "style=\"width: 100%;\"";
	} else {
		$picimg = "";
	}
	echo "<!-- 图片 -->
                        <div class=\"sh-content-right-img\" id=\"imglib-" . $cid . "\" style=\"" . $tusty . "\">";
	for ($i = 0; $i < $coun; $i++) {
		$tuimg = $imgar[$i];
		if ($i > 7) {
			$duoimg = $coun - $i - 1;
			if ($coun > 9) {
				if ($i == 8) {
					echo "<a href=\"" . $tuimg . "\" class=\"sh-content-right-img-pic\" data-fancybox=\"gallery" . $cid . "\" data-caption=\"\">
                                             <span class=\"sh-content-right-img-pic-mask\">+" . $duoimg . "</span>
                                             <img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $tuimg . "\" alt=\"\" " . $picimg . ">
                                             </a>";
				} else {
					echo "<a href=\"" . $tuimg . "\" class=\"sh-content-right-img-pic\" data-fancybox=\"gallery" . $cid . "\" data-caption=\"\"  style=\"display:none;\">
                                             <img src=\"" . $tuimg . "\" data-src=\"" . $tuimg . "\" alt=\"\" " . $picimg . ">
                                             </a>";
				}
			} else {
				echo "<a href=\"" . $tuimg . "\" class=\"sh-content-right-img-pic\" data-fancybox=\"gallery" . $cid . "\" data-caption=\"\">
                                         <img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $tuimg . "\" alt=\"\" " . $picimg . ">
                                         </a>";
			}
		} else {
			echo "<a href=\"" . $tuimg . "\" class=\"sh-content-right-img-pic\" data-fancybox=\"gallery" . $cid . "\" data-caption=\"\">
                                     <img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $tuimg . "\" alt=\"\" " . $picimg . ">
                                     </a>";
		}
	}
	?></div><?php 
} elseif ($ptplx == "video") {
	if ($videoauplay == 1) {
		$videobf = "autoplay";
		$videobfplas = "";
	} else {
		$videobf = "";
		$videobfplas = "<i class=\"iconfont icon-sa4f56\" id=\"sh-content-video-videobfb-" . $cid . "\" style=\"width: fit-content;height: fit-content;grid-column: 1;grid-row: 1;z-index: 5;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);font-size: 40px;color: #ffffff;display: flex;cursor: pointer;padding: 15px;pointer-events: none;\"></i>";
	}
	if ($filterpiccir == 1) {
		$vidoyuan = "1";
	} else {
		$vidoyuan = "0";
	}
	echo "
                            <!-- 视频 -->
                        <div class=\"sh-video\" id=\"sh-content-video-" . $cid . "\" onclick=\"videofdgb()\" lang=\"0\">
                            <video name=\"sh-videokid\" class=\"sh-content-video\" data-ybs=\"" . $vidoyuan . "\" poster=\"" . $ptpvideofm . "\" id=\"sh-content-videok-" . $cid . "\" src=\"" . $ptpvideo . "\" playsinline webkit-playsinline preload=\"metadata\" " . $videobf . " muted loop onclick=\"videofd()\" lang=\"0\" disablePictureInPicture=\"true\" controlslist=\"nodownload nofullscreen noremoteplayback\"></video>
                            " . $videobfplas . "
                            <i class=\"iconfont icon-quxiao\" id=\"sh-content-videog-" . $cid . "\" lang=\"0\"></i>
                            <span class=\"sh-video-span\" id=\"sh-video-span-" . $cid . "\">查看</span>
                        </div>
                            ";
} elseif ($ptplx == "music") {
	echo "<!-- 音乐 -->";
	if (is_numeric($ptpmusic)) {
	} else {
		$mus = explode("|", $ptpmusic);
		include "./site/musicplay.php";
	}
}
?>                    </div>
                    <!-- 地址 -->
                    <?php 
if ($ptpdw != "") {
	echo $gps;
}
echo "                    <!--广告-->
                    ";
echo $ggurl;
echo "
                    ";
$sql2b = "select * from lcke where lwz= '{$cid}'";
$result2b = mysqli_query($conn, $sql2b);
if (mysqli_num_rows($result2b) > 0) {
	$sql2a = "SELECT * FROM lcke";
	$result2a = $conn->query($sql2a);
	while ($row2a = $result2a->fetch_assoc()) {
		if ($row2a["lwz"] == $cid) {
			$dianzmlnr = $row2a["luser"];
			if ($user_zh == "" || $user_name == "" || $user_img == "" || $user_passid == "") {
				if ($dianzmlnr == $_SESSION["visykmz_userip"]) {
					$dianzmlnr = "取消";
					$dianzmlimg = "iconfont icon-aixin2 ri-sxdzlikehs";
					break;
				} else {
					$dianzmlnr = "赞";
					$dianzmlimg = "iconfont icon-aixin ri-sxdzlike";
				}
			} else {
				if ($dianzmlnr == $user_zh) {
					$dianzmlnr = "取消";
					$dianzmlimg = "iconfont icon-aixin2 ri-sxdzlikehs";
					break;
				} else {
					$dianzmlnr = "赞";
					$dianzmlimg = "iconfont icon-aixin ri-sxdzlike";
				}
			}
		}
	}
	$dzzha = "display:flex";
} else {
	$dianzmlnr = "赞";
	$dianzmlimg = "iconfont icon-aixin ri-sxdzlike";
	$dzzha = "display:none";
}
if ($commauth == 1) {
	$gwzkplzt = "
    <div class=\"sh-content-right-time-right-left-y\" id=\"" . $cid . "\" onclick=\"plkkg()\">
                                    <i class=\"iconfont icon-pinglun2 ri-sxdzcomm\"></i>
                                    <span>评论</span>
                                </div>
    ";
} else {
	$gwzkplzt = "
    <div class=\"sh-content-right-time-right-left-y\" id=\"" . $cid . "\">
                                    <i class=\"iconfont icon-pinglun2 ri-sxdzcomm\"></i>
                                    <span>评论关闭</span>
                                </div>
    ";
}
echo "
                    <!-- 时间与点赞 -->
                    <div class=\"sh-content-right-time\">
                        <!-- 时间 -->
                        <div class=\"sh-content-right-time-left\"><span>" . $wzfbsj . "</span>" . $dewzbs . "</div>
                        <!-- 点赞 -->
                        <div class=\"sh-content-right-time-right\">
                            <!-- 左边合集 -->
                            <div class=\"sh-content-right-time-right-left\" id=\"pl-" . $cid . "\" name=\"pl\">
                                <div class=\"sh-content-right-time-right-left-z\" onclick=\"dinazanv()\">
                                    <i class=\"" . $dianzmlimg . "\" id=\"tiezimg-" . $cid . "\"></i>
                                    <span id=\"tiezdz-" . $cid . "\">" . $dianzmlnr . "</span>
                                </div>
                                <p></p>
                                " . $gwzkplzt . "
                            </div>
                            <!-- 右边点赞控制按钮 -->
                            <div class=\"sh-content-right-time-right-right\" id=\"" . $cid . "\" onclick=\"plk()\">
                                <p class=\"zp1\"></p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <!-- 点赞列表与评论 -->
                    <div class=\"sh-zanp\" id=\"zanss-" . $cid . "\">
                    ";
echo "



";
echo "
<!-- 点赞列表 -->
                        <div class=\"sh-zanp-zan zan2\" id=\"zans-" . $cid . "\" style=\"" . $dzzha . "\">
                            <!-- 左侧点赞图标 -->
                            <div class=\"sh-zanp-zan-left sh-zanp-zan-left2\"><i class=\"iconfont icon-aixin ri-sxwzlike\"></i></div>
                            <!-- 右边点赞名列表 -->
                            <ul class=\"sh-zanp-zan-right sh-zanp-zan-right2\" id=\"sh-zanp-ul\">
";
$sql2 = "select * from lcke where lwz= '{$cid}'";
$result2 = mysqli_query($conn, $sql2);
$vissul = 0;
if (mysqli_num_rows($result2) > 0) {
	while ($row2 = mysqli_fetch_assoc($result2)) {
		$dzzzh = $row2["luser"];
		$data_result = mysqli_query($conn, "select * from user where username='{$dzzzh}'");
		$data_row = mysqli_fetch_array($data_result);
		$zhtximg = $data_row["img"];
		$dzdzh = $data_row["username"];
		if ($zhtximg == "") {
			$zhtximg = "./assets/img/tx.png";
		}
		if ($dzdzh != "") {
			echo "<li id=\"zan-" . $dzdzh . "\">
            <img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $zhtximg . "\" alt=\"头像\">
            </li>";
		} else {
			$vissul++;
		}
	}
	if ($vissul != "0") {
		echo "<li id=\"fkzan-zan\" style=\"width: fit-content;height: 30px;margin-right: 5px;margin-bottom: 5px;display: flex;align-items: center;\"><span style=\"font-size: 12px;color: var(--adgg);max-width: 100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;\">" . $vissul . "位访客</span></li>";
	}
	?></ul></div><?php 
} else {
	?></ul></div><?php 
}
echo "                    
    

                            


";
$sql3 = "select * from comm where wzcid= '{$cid}' and comaud<>'0' and comaud<>'-1'";
$result3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($result3) > 0) {
	echo "
    <!-- 评论列表 -->
                        <div class=\"sh-dz-z\" id=\"sh-dz-z-" . $cid . "\">
                            <!-- 左侧评论图标 -->
                            <div class=\"sh-zanp-zan-left sh-zanp-zan-left2\"><i class=\"iconfont icon-pinglun2 ri-sxdzcommls\"></i></div>
                        <ul class=\"sh-zanp-pl sh-zanp-pl2 sh-zanp-pl3\" id=\"sh-zanp-pl-" . $cid . "\">
    ";
	while ($row3 = mysqli_fetch_assoc($result3)) {
		$couser = $row3["couser"];
		$coname = $row3["coname"];
		$coecid = $row3["ecid"];
		$coimg = $row3["coimg"];
		$courl = $row3["courl"];
		$cotext = $row3["cotext"];
		$cotime = $row3["cotime"];
		$bcouser = $row3["bcouser"];
		$bconame = $row3["bconame"];
		$timee = strtotime($cotime);
		$cotime = ReckonTime($timee);
		$comaud = $row3["comaud"];
		if ($comaud != 1) {
			$cotext = "该条评论未通过审核!";
		}
		if ($dewzplz == "1") {
			$dewzpl = "<a href=\"JavaScript:;\" class=\"sh-zanp-pl-del\" onclick=\"pldels(this)\" id=\"" . $coecid . "\" lang=\"yswid-" . $cid . "\">删除</a>";
		} else {
			$dewzpl = "";
		}
		if ($courl == "") {
			$plzwze = "";
		} else {
			$plzwze = "href=\"" . $courl . "\" style=\"pointer-events: all;\"";
		}
		if ($commauth == 1) {
			$pldjhf = "onclick=\"plhuifu()\"";
		} else {
			$pldjhf = "";
		}
		if ($bcouser == "false" || $bconame == "false") {
			echo "
            <li lang=\"" . $coname . "\" " . $pldjhf . " id=\"" . $cid . "\" value=\"" . $couser . "\" data-comkzt=\"0\">
                                <div class=\"sh-zanp-pl-tx\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $coimg . "\" alt=\"头像\"></div>
                                <div class=\"sh-zanp-pl-n sh-zanp-pl-n2\">
                                    <div class=\"sh-zanp-pl-n-mz\"><a " . $plzwze . " class=\"sh-zanp-pl-n-nc\" onclick=\"hfljurl()\" target=\"_blank\">" . $coname . "</a> <span>· " . $cotime . "</span></div>
                                    <span class=\"sh-zanp-pl-n-nr\">" . $cotext . "</span>
                                </div>
                                " . $dewzpl . "
                            </li>
            ";
		} else {
			echo "
            <li lang=\"" . $coname . "\" " . $pldjhf . " id=\"" . $cid . "\" value=\"" . $couser . "\" data-comkzt=\"0\">
                                <div class=\"sh-zanp-pl-tx\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $coimg . "\" alt=\"头像\"></div>
                                <div class=\"sh-zanp-pl-n sh-zanp-pl-n2\">
                                    <div class=\"sh-zanp-pl-n-mz\"><a " . $plzwze . " class=\"sh-zanp-pl-n-nc\" onclick=\"hfljurl()\" target=\"_blank\">" . $coname . "</a> <span>· " . $cotime . "</span></div>
                                    
                                    <span>回复</span>
                                    <span class=\"sh-zanp-pl-n-nc\">" . $bconame . "</span>：
                                    <span class=\"sh-zanp-pl-n-nr\">" . $cotext . "</span>
                                </div>
                                " . $dewzpl . "
                            </li>
            ";
		}
	}
	?></ul></div><?php 
} else {
	$plgd = "display:none";
	echo "
    <!-- 评论列表 -->
                        <div class=\"sh-dz-z\" style=\"display:none;\" id=\"sh-dz-z-" . $cid . "\">
                            <!-- 左侧评论图标 -->
                            <div class=\"sh-zanp-zan-left sh-zanp-zan-left2\"><i class=\"iconfont icon-pinglun2 ri-sxdzcommls\"></i></div>
                        <ul class=\"sh-zanp-pl sh-zanp-pl2 sh-zanp-pl3\" id=\"sh-zanp-pl-" . $cid . "\" style=\"display:none;\">
                            </ul>
                           </div>
    ";
}
?>

            

                        
                        

                    </div>
                </div>
            </div>
            </div>
            </div>








             






        </div>

        
        
        






<!-- 设置弹窗层-->
<?php 
if ($userdlzt == 1) {
	$sql = "SELECT ptpuser FROM essay WHERE cid = '{$cid}'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$ptpuser = $row["ptpuser"];
		if ($ptpuser == $user_zh) {
			$xstcbs = "1";
		} else {
			if ($user_zh == $glyadmin) {
				$xstcbs = "1";
			} else {
				$xstcbs = "0";
			}
		}
	}
	if ($xstcbs == 1) {
		?><div class="sh-view-set" id="sh-view-set">
    <div class="sh-view-set-wk" id="sh-view-set-wk" onclick="viewsetg()">
        <div class="sh-view-set-wk-con" id="sh-view-set-wk-con"><?php 
		if ($user_zh == $glyadmin) {
			$arsj = explode(PHP_EOL, $topes);
			if (in_array($wid, $arsj)) {
				echo "<div class=\"sh-view-set-wk-con-title\" style=\"margin-bottom: 1px;\" id=\"sh-wzzdyqx-" . $wid . "\" lang=\"qx\" onclick=\"wzszd()\">
                <span>取消置顶</span>
            </div>";
			} else {
				echo "<div class=\"sh-view-set-wk-con-title\" style=\"margin-bottom: 1px;\" id=\"sh-wzzdyqx-" . $wid . "\" lang=\"sw\" onclick=\"wzszd()\">
                <span>置顶</span>
            </div>";
			}
		}
		if ($xstcbs == 1) {
			echo "<div class=\"sh-view-set-wk-con-title\" style=\"margin-bottom: 1px;\" id=\"sh-wzzdyqx-" . $wid . "\" lang=\"qx\" onclick=\"location.href='./edit.php?cid=" . $cid . "'\">
                <span>编辑</span>
            </div>";
		}
		if ($ptpys == 1) {
			echo "<div class=\"sh-view-set-wk-con-title\" id=\"sh-wzdsdzt-" . $cid . "\" lang=\"1\" onclick=\"wzsdyj()\">
                <span>设为私密</span>
            </div>";
		} else {
			echo "<div class=\"sh-view-set-wk-con-title\" id=\"sh-wzdsdzt-" . $cid . "\" lang=\"0\" onclick=\"wzsdyj()\">
                <span>取消私密</span>
            </div>";
		}
		?><div class="sh-view-set-wk-con-title" style="margin-top: 5px;padding-bottom: 10px;" onclick="viewsetg()">
                <span>取消</span>
            </div>
        </div>
    </div>
</div><?php 
	}
}
?>







<!--右下角悬浮菜单-->
<!--div class="sh-menu" id="sh-menu">
    <-?php
    if ($config_search == "1") {
        echo '<div class="sh-menu-k" id="scrtop" onclick="scrollToTop()"><i class="iconfont icon-sousuoxiao"></i></div>';
    }
    
    if ($config_daynmode == "1") {
        $darktheme = $_COOKIE["dark_theme"];//取日夜状态
        if ($darktheme == "dark-theme") {
            echo '<div class="sh-menu-k" id="day" lang="0"><i class="iconfont icon-yueliang" id="day-i"></i></div>';
        }else{
            echo '<div class="sh-menu-k" id="day" lang="1"><i class="iconfont icon-ai250" id="day-i"></i></div>';
        }
    }
    
    if ($config_gotop == "1") {
        echo '<div class="sh-menu-k" id="scrtop" onclick="scrollToTop()"><i class="iconfont icon-fanhuidingbu"></i></div>';
    }
    ?>
</div-->
<div class="sh-menu" id="sh-menu">
    <?php 
$darktheme = $_COOKIE["dark_theme"];
if ($darktheme == "dark-theme") {
	?><div class="sh-menu-k" id="day" lang="0"><i class="iconfont icon-yueliang" id="day-i"></i></div><?php 
} else {
	?><div class="sh-menu-k" id="day" lang="1"><i class="iconfont icon-ai250" id="day-i"></i></div><?php 
}
?>    <div class="sh-menu-k" id="scrtop" onclick="scrollToTop()"><i class="iconfont icon-weibiaoti-x-copy"></i></div>
</div>




<?php 
if ($musplay == 0) {
	include "./site/musicbk.php";
} elseif ($musplay == 1) {
	include "./site/musicbkcla.php";
}
?>

    <span class="sh-copyright-banquan" id="sh-copyright-banquan"><?php echo $copyright;?></span>&nbsp;
    <?php 
if ($beian != "") {
	echo "<span class=\"sh-copyright-banquan\">" . html_entity_decode($beian) . "</span>";
}
?></div>


    </div>



<?php 
$conn->close();
?>

    <script type="text/javascript" src="./assets/js/index.js?v=<?php echo $resversion;?>"></script>
    <script type="text/javascript" src="./assets/js/view.js?v=<?php echo $resversion;?>"></script>
    <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/mesg/dist/js/sh-noytf.js?v=<?php echo $resversion;?>"></script>
    <script type="text/javascript" src="./assets/js/jquery.fancybox.min.js?v=<?php echo $resversion;?>"></script>
    <?php echo "<script type=\"text/javascript\">" . $filtercujs . "</script>";?></body>
</html><?php 
function ReckonTime($time)
{
	$NowTime = time();
	if ($NowTime < $time) {
		return false;
	}
	$TimePoor = $NowTime - $time;
	if ($TimePoor == 0) {
		$str = "一眨眼之间";
	} elseif ($TimePoor < 60 && $TimePoor > 0) {
		$str = $TimePoor . "秒之前";
	} elseif ($TimePoor >= 60 && $TimePoor <= 3600) {
		$str = floor($TimePoor / 60) . "分钟前";
	} elseif ($TimePoor > 3600 && $TimePoor <= 86400) {
		$str = floor($TimePoor / 3600) . "小时前";
	} elseif ($TimePoor > 86400 && $TimePoor <= 604800) {
		if (floor($TimePoor / 86400) == 1) {
			$str = "昨天";
		} elseif (floor($TimePoor / 86400) == 2) {
			$str = "前天";
		} else {
			$str = floor($TimePoor / 86400) . "天前";
		}
	} elseif ($TimePoor > 604800) {
		$str = date("Y-m-d", $time);
	}
	return $str;
}