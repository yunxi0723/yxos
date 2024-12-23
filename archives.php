<?php

//decode by nige112
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$arr = [["code" => "201", "msg" => "非法请求"]];
	exit(json_encode($arr, JSON_UNESCAPED_UNICODE));
}
$referer = $_SERVER["HTTP_REFERER"];
if ($referer == "") {
	$tiaourl = "./index.php";
} else {
	$tiaourl = $referer;
}
$arcuser = addslashes(htmlspecialchars($_GET["user"]));
if ($arcuser == "") {
	exit("<script language=\"JavaScript\">;alert(\"非法请求\");location.href=\"" . $tiaourl . "\";</script>");
}
$iteace = "0";
if (is_file("./config.php")) {
	require "./config.php";
} else {
	exit("未检测到配置文件：<span style=\"color: red;\">config.php</span>，若您是首次使用请先进行安装,删除文件夹 <span style=\"color: red;\">[install/]</span> 下的 <span style=\"color: red;\">[ins.bak]</span> 文件后进行安装。");
}
require "./api/wz.php";
$sql = "SELECT * FROM user";
$result = $conn->query($sql);
$data = [];
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$encrypted_username = md5(md5($row["username"]));
		$data[$encrypted_username] = $row["username"];
	}
} else {
	exit("<script language=\"JavaScript\">;alert(\"用户不存在\");location.href=\"" . $tiaourl . "\";</script>");
}
if (array_key_exists($arcuser, $data)) {
	$arcuser = $data[$arcuser];
} else {
	exit("<script language=\"JavaScript\">;alert(\"此用户不存在\");location.href=\"" . $tiaourl . "\";</script>");
}
$sql = "select * from user where username= '{$arcuser}'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$arcusernc = $row["name"];
		$arcuserimg = $row["img"];
		$arcuserhomeimgy = $row["homeimg"];
		$arcusersign = $row["sign"];
	}
} else {
	exit("<script language=\"JavaScript\">;alert(\"此用户不存在\");location.href=\"" . $tiaourl . "\";</script>");
}
if ($arcuserhomeimgy == -1) {
	$arcuserhomeimgy = $homimg;
}
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo $arcusernc;?>的主页</title>
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
        <div class="sh-main">
            <div class="sh-main-head">
                <div class="sh-main-head-top" id="sh-main-head-top">
                    <!-- 左边 -->
                    <div class="sh-main-head-top-left">
                        <div class="sh-main-head-top-left-s" onclick="location.href='./index.php'">
                            <i class="iconfont icon-weibiaoti al-sxb" id="top-left-1"></i>
                        </div>
                    </div>
                    <!-- 右边 -->
                    <div class="sh-main-head-top-right">
                            
                    </div>
                </div>
                <div class="sh-main-head-img" style="background-image:url(<?php echo $arcuserhomeimgy;?>)">
                </div>
            </div>

            <div class="sh-main-head-headimg">
                <div class="sh-main-head-headimg-tx">
                    <h4><?php echo $arcusernc;?></h4>
                    <a href="JavaScript:;"><img src="./assets/img/thumbnail.svg" data-src="<?php echo $arcuserimg;?>" alt="头像"></a>
                </div>
                <div class="sh-main-head-headimg-qm">
                    <p><?php echo $arcusersign;?></p>
                </div>
            </div>




<div class="sh-homecontent" id="sh-nrbk">
<?php 
require "./config.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	exit("连接失败: " . $conn->connect_error);
}
$prevYear = $prevMonth = $prevDay = "";
$timebss = "";
$wzsl = 0;
$query = "SELECT * FROM essay WHERE ptpuser = '{$arcuser}' and ptpys='1' and ptpaud='1'";
$result = mysqli_query($conn, $query);
$ptptime_values = [];
while ($row = mysqli_fetch_assoc($result)) {
	$ptptime = date("Y", strtotime($row["ptptime"])) . date("m", strtotime($row["ptptime"])) . date("d", strtotime($row["ptptime"])) . date("H", strtotime($row["ptptime"])) . date("i", strtotime($row["ptptime"])) . date("s", strtotime($row["ptptime"]));
	if (strpos($ptptime, "-") !== false) {
		$timestamp = strtotime($ptptime);
	} else {
		$timestamp = DateTime::createFromFormat("YmdHis", $ptptime)->getTimestamp();
	}
	$ptptime_values[$timestamp] = $row;
}
krsort($ptptime_values);
foreach ($ptptime_values as $row) {
	$wzsl = $wzsl + 1;
	if ($essgs < $wzsl) {
		$wzsl = $wzsl - 1;
		break;
	}
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
	$year = date("Y", strtotime($ptptime));
	$month = date("m", strtotime($ptptime));
	$day = date("d", strtotime($ptptime));
	$hour = date("H", strtotime($ptptime));
	$minute = date("i", strtotime($ptptime));
	$second = date("s", strtotime($ptptime));
	$givenDates = $year . "-" . $month . "-" . $day;
	if (date("Ymd") - ($year . $month . $day) == "0") {
		$day = "今天";
		$month = "";
	} elseif (date("Ymd") - ($year . $month . $day) == "1") {
		$day = "昨天";
		$month = "";
	} else {
		$day = $day;
		$month = $month . "月";
	}
	if ($year != $prevYear) {
		if (date("Y") != $year) {
			echo "<h2 class=\"sh-homecontent-timed\">" . $year . "<span class=\"sh-homecontent-timed-n\">年</span></h2>";
		}
		$prevYear = $year;
	}
	if ($ptpys == 0) {
		$wzsdbs = "<i class=\"iconfont icon-suoding sh-homecontent-wzsbs\"></i>";
	} else {
		$wzsdbs = "";
	}
	if ($ptplx == "img") {
		$imgar = explode("(+@+)", $ptpimag);
		$coun = count($imgar);
		if ($coun == 1) {
			$wzbank = "<div class=\"sh-homecontent-lie\">
            <!-- 左边 -->
            <div class=\"sh-homecontent-left\">
                <!-- 日期 -->
                <div class=\"sh-homecontent-left-time\" lang=\"year-" . $givenDates . "\" style=\"" . $shougbsx . "\">
                    <span class=\"homecontent-left-time-h\">" . $day . "</span>
                    <span class=\"homecontent-left-time-y\">" . $month . "</span>
                </div>
                <!-- 地址 -->
                <div class=\"sh-homecontent-left-time-dw\">" . $ptpdw . "</div>
            </div>
            <!-- 右边内容框架 -->
            <div class=\"sh-homecontent-right-wk\">

                <!-- 右边内容主体 -->
                <div class=\"sh-homecontent-right-lie\" onclick=\"window.location.href = './view.php?cid=" . $cid . "';\">
                    <!-- 图片 -->
                    <div class=\"homecontent-right-tw\">
                        <!-- 图片 -->
                        <div class=\"homecontent-right-tw-img\" style=\"grid-template-columns: 1fr;grid-template-rows: 1fr;\">
                            <div class=\"homecontent-right-tw-img-wk\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $imgar[0] . "\" alt=\"\"></div>
                            " . $wzsdbs . "
                        </div>
                    </div>
                    <!-- 文字内容 -->
                    <div class=\"homecontent-right-nr\">
                        <div class=\"homecontent-right-nr-text\">" . $ptptext . "</div>
                        <p class=\"homecontent-right-nr-tus\">共" . $coun . "张</p>
                    </div>
                </div>
            </div>
        </div>";
		} elseif ($coun == 2) {
			$wzbank = "<div class=\"sh-homecontent-lie\">
            <!-- 左边 -->
            <div class=\"sh-homecontent-left\">
                <!-- 日期 -->
                <div class=\"sh-homecontent-left-time\" lang=\"year-" . $givenDates . "\" style=\"" . $shougbsx . "\">
                    <span class=\"homecontent-left-time-h\">" . $day . "</span>
                    <span class=\"homecontent-left-time-y\">" . $month . "</span>
                </div>
                <!-- 地址 -->
                <div class=\"sh-homecontent-left-time-dw\">" . $ptpdw . "</div>
            </div>
            <!-- 右边内容框架 -->
            <div class=\"sh-homecontent-right-wk\">

                <!-- 右边内容主体 -->
                <div class=\"sh-homecontent-right-lie\" onclick=\"window.location.href = './view.php?cid=" . $cid . "';\">
                    <!-- 图片 -->
                    <div class=\"homecontent-right-tw\">
                        <!-- 图片 -->
                        <div class=\"homecontent-right-tw-img\">
                            <div class=\"homecontent-right-tw-img-wk\" style=\"grid-row: 1 / 3;\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $imgar[0] . "\" alt=\"\"></div>
                            <div class=\"homecontent-right-tw-img-wk\" style=\"grid-row: 1 / 3;\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $imgar[1] . "\" alt=\"\"></div>
                            " . $wzsdbs . "
                        </div>
                    </div>
                    <!-- 文字内容 -->
                    <div class=\"homecontent-right-nr\">
                        <div class=\"homecontent-right-nr-text\">" . $ptptext . "</div>
                        <p class=\"homecontent-right-nr-tus\">共" . $coun . "张</p>
                    </div>
                </div>
            </div>
        </div>";
		} elseif ($coun == 3) {
			$wzbank = "<div class=\"sh-homecontent-lie\">
            <!-- 左边 -->
            <div class=\"sh-homecontent-left\">
                <!-- 日期 -->
                <div class=\"sh-homecontent-left-time\" lang=\"year-" . $givenDates . "\" style=\"" . $shougbsx . "\">
                    <span class=\"homecontent-left-time-h\">" . $day . "</span>
                    <span class=\"homecontent-left-time-y\">" . $month . "</span>
                </div>
                <!-- 地址 -->
                <div class=\"sh-homecontent-left-time-dw\">" . $ptpdw . "</div>
            </div>
            <!-- 右边内容框架 -->
            <div class=\"sh-homecontent-right-wk\">

                <!-- 右边内容主体 -->
                <div class=\"sh-homecontent-right-lie\" onclick=\"window.location.href = './view.php?cid=" . $cid . "';\">
                    <!-- 图片 -->
                    <div class=\"homecontent-right-tw\">
                        <!-- 图片 -->
                        <div class=\"homecontent-right-tw-img\">
                            <div class=\"homecontent-right-tw-img-wk\" style=\"grid-row: 1 / 3;\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $imgar[0] . "\" alt=\"\"></div>
                            <div class=\"homecontent-right-tw-img-wk\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $imgar[1] . "\" alt=\"\"></div>
                            <div class=\"homecontent-right-tw-img-wk\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $imgar[2] . "\" alt=\"\"></div>
                            " . $wzsdbs . "
                        </div>
                    </div>
                    <!-- 文字内容 -->
                    <div class=\"homecontent-right-nr\">
                        <div class=\"homecontent-right-nr-text\">" . $ptptext . "</div>
                        <p class=\"homecontent-right-nr-tus\">共" . $coun . "张</p>
                    </div>
                </div>
            </div>
        </div>";
		} elseif ($coun == 4 || $coun >= 4) {
			$wzbank = "<div class=\"sh-homecontent-lie\">
            <!-- 左边 -->
            <div class=\"sh-homecontent-left\">
                <!-- 日期 -->
                <div class=\"sh-homecontent-left-time\" lang=\"year-" . $givenDates . "\" style=\"" . $shougbsx . "\">
                    <span class=\"homecontent-left-time-h\">" . $day . "</span>
                    <span class=\"homecontent-left-time-y\">" . $month . "</span>
                </div>
                <!-- 地址 -->
                <div class=\"sh-homecontent-left-time-dw\">" . $ptpdw . "</div>
            </div>
            <!-- 右边内容框架 -->
            <div class=\"sh-homecontent-right-wk\">

                <!-- 右边内容主体 -->
                <div class=\"sh-homecontent-right-lie\" onclick=\"window.location.href = './view.php?cid=" . $cid . "';\">
                    <!-- 图片 -->
                    <div class=\"homecontent-right-tw\">
                        <!-- 图片 -->
                        <div class=\"homecontent-right-tw-img\">
                            <div class=\"homecontent-right-tw-img-wk\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $imgar[0] . "\" alt=\"\"></div>
                            <div class=\"homecontent-right-tw-img-wk\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $imgar[1] . "\" alt=\"\"></div>
                            <div class=\"homecontent-right-tw-img-wk\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $imgar[2] . "\" alt=\"\"></div>
                            <div class=\"homecontent-right-tw-img-wk\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $imgar[3] . "\" alt=\"\"></div>
                            " . $wzsdbs . "
                        </div>
                    </div>
                    <!-- 文字内容 -->
                    <div class=\"homecontent-right-nr\">
                        <div class=\"homecontent-right-nr-text\">" . $ptptext . "</div>
                        <p class=\"homecontent-right-nr-tus\">共" . $coun . "张</p>
                    </div>
                </div>
            </div>
        </div>";
		}
	} elseif ($ptplx == "video") {
		if ($videoauplay == 1) {
			$videobf = "autoplay";
			$videobfplas = "";
		} else {
			$videobf = "";
			$videobfplas = "<i class=\"iconfont icon-sa4f56\" id=\"sh-content-video-videobfb-" . $cid . "\" style=\"width: fit-content;height: fit-content;grid-column: 1;grid-row: 1;z-index: 10;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);font-size: 30px;color: #ffffff;display: flex;cursor: pointer;padding: 15px;pointer-events: none;\"></i>";
		}
		$wzbank = "<div class=\"sh-homecontent-lie\">
            <!-- 左边 -->
            <div class=\"sh-homecontent-left\">
                <!-- 日期 -->
                <div class=\"sh-homecontent-left-time\" lang=\"year-" . $givenDates . "\" style=\"" . $shougbsx . "\">
                    <span class=\"homecontent-left-time-h\">" . $day . "</span>
                    <span class=\"homecontent-left-time-y\">" . $month . "</span>
                </div>
                <!-- 地址 -->
                <div class=\"sh-homecontent-left-time-dw\">" . $ptpdw . "</div>
            </div>
            <!-- 右边内容框架 -->
            <div class=\"sh-homecontent-right-wk\">
                <!-- 右边内容主体 -->
                <div class=\"sh-homecontent-right-lie\" onclick=\"window.location.href = './view.php?cid=" . $cid . "';\">
                    <!-- 视频 -->
                    <div class=\"homecontent-right-tw\">
                        <!-- 视频 -->
                        <div class=\"homecontent-right-tw-video\">
                            <video class=\"homecontent-right-tw-videoau\" poster=\"" . $ptpvideofm . "\" src=\"" . $ptpvideo . "\" playsinline=\"\" webkit-playsinline=\"\" preload=\"metadata\" " . $videobf . " muted=\"\" loop=\"\"></video>
                                " . $videobfplas . "
                                <span class=\"sh-video-span\" style=\"left: 4px;bottom: 4px;\">查看</span>
                                " . $wzsdbs . "
                        </div>
                    </div>
                    <!-- 文字内容 -->
                    <div class=\"homecontent-right-nr\">
                        <div class=\"homecontent-right-nr-text\">" . $ptptext . "</div>
                    </div>
                </div>
            </div>
        </div>";
	} elseif ($ptplx == "music") {
		$mus = explode("|", $ptpmusic);
		if ($mus[3] == "") {
			$musimg = "./assets/img/musicba.jpg";
		} else {
			$musimg = $mus[3];
		}
		if ($ptptext == "") {
			$ptpnr = "";
		} else {
			$ptpnr = "<div class=\"sh-homecontent-right-lie-music-title\">" . $ptptext . "</div>";
		}
		$wzbank = "<div class=\"sh-homecontent-lie\">
            <!-- 左边 -->
            <div class=\"sh-homecontent-left\">
                <!-- 日期 -->
                <div class=\"sh-homecontent-left-time\" lang=\"year-" . $givenDates . "\" style=\"" . $shougbsx . "\">
                    <span class=\"homecontent-left-time-h\">" . $day . "</span>
                    <span class=\"homecontent-left-time-y\">" . $month . "</span>
                </div>
                <!-- 地址 -->
                <div class=\"sh-homecontent-left-time-dw\">" . $ptpdw . "</div>
            </div>
            <!-- 右边内容框架 -->
            <div class=\"sh-homecontent-right-wk\">
                <!-- 右边内容主体 -->
                <div class=\"sh-homecontent-right-lie-musicwk\" onclick=\"window.location.href = './view.php?cid=" . $cid . "';\">" . $wzsdbs . "
                    " . $ptpnr . "
                    <div class=\"sh-homecontent-right-lie sh-homecontent-right-lie-music\">
                        <!-- 音乐 -->
                        <div class=\"homecontent-right-tw homecontent-right-tw-music\">
                            <!-- 图片 -->
                            <div class=\"homecontent-right-tw-img\" style=\"grid-template-columns: 1fr;grid-template-rows: 1fr;\">
                                <div class=\"homecontent-right-tw-img-wk homecontent-right-tw-img-wk-music\"><img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $musimg . "\" alt=\"\"><i class=\"iconfont icon-sa4f56\"></i></div>
                            </div>
                        </div>
                        <!-- 文字内容 -->
                        <div class=\"homecontent-right-nr homecontent-right-nr-music\">
                            <div class=\"homecontent-right-nr-text homecontent-right-nr-text-music\" style=\"color: var(--thetitle);\">" . $mus[1] . "</div>
                            <p class=\"homecontent-right-nr-text-music-p homecontent-right-nr-text-music\">" . $mus[2] . "</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
	} elseif ($ptplx == "only") {
		$wzbank = "<div class=\"sh-homecontent-lie\">
            <!-- 左边 -->
            <div class=\"sh-homecontent-left\">
                <!-- 日期 -->
                <div class=\"sh-homecontent-left-time\" lang=\"year-" . $givenDates . "\" style=\"" . $shougbsx . "\">
                    <span class=\"homecontent-left-time-h\">" . $day . "</span>
                    <span class=\"homecontent-left-time-y\">" . $month . "</span>
                </div>
                <!-- 地址 -->
                <div class=\"sh-homecontent-left-time-dw\">" . $ptpdw . "</div>
            </div>
            <div class=\"sh-homecontent-right-wk\">
                <!-- 右边内容主体 -->
                <div class=\"sh-homecontent-right-lie\" onclick=\"window.location.href = './view.php?cid=" . $cid . "';\">
                    <!-- 仅文字 -->
                    <!-- 文字内容 -->
                    <div class=\"homecontent-right-nr\" style=\"min-height: 10px;background: var(--fgxys);position:relative;\">
                        <div class=\"homecontent-right-nr-text homecontent-right-nr-textjw\" style=\"margin: 10px;\">" . $ptptext . "</div>
                        " . $wzsdbs . "
                    </div>
                </div>
            </div>
        </div>";
	}
	echo $wzbank;
}
?></div>






















            <div class="footer">
                <div class="footer-text" id="footer-text-zt" onclick="hqgd()">加载更多..</div>
                <p style="display:none" id="footer-text-hqgd"><?php echo $wzsl;?></p>
            </div>



        </div>

 
 
 
<!--右下角悬浮菜单-->
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


<div class="sh-copyright">
    <span class="sh-copyright-banquan" id="sh-copyright-banquan"><?php echo $copyright;?></span>&nbsp;
    <?php 
if ($beian != "") {
	echo "<span class=\"sh-copyright-banquan\">" . html_entity_decode($beian) . "</span>";
}
?></div>


    </div>






    <script type="text/javascript" src="./assets/js/home.js?v=<?php echo $resversion;?>"></script>
    <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/mesg/dist/js/sh-noytf.js?v=<?php echo $resversion;?>"></script>
    <script type="text/javascript">
        //删除重复年
        var timedElements = document.getElementsByClassName('sh-homecontent-timed');
        var timedElementsArray = Array.from(timedElements);

        timedElementsArray.forEach((element, index) => {
            if (index > 0 && element.innerHTML === timedElementsArray[index - 1].innerHTML) {
                element.remove();
            }
        });
        //隐藏重复日期
        var elements = document.getElementsByClassName('sh-homecontent-left-time');
        var langValues = [];
        var duplicateIndexes = [];
        for (var i = 0; i < elements.length; i++) {
            var lang = elements[i].lang;

            if (langValues.includes(lang)) {
                duplicateIndexes.push(i);
            } else {
                langValues.push(lang);
            }
        }
        for (var j = 0; j < elements.length; j++) {
            if (duplicateIndexes.includes(j)) {
                elements[j].style.display = 'none';
                elements[j].lang = '';
            }
        }

        //设置每个不同月日的顶部间距
        // 获取所有class为sh-homecontent-left-time的元素
        var elements = document.querySelectorAll('.sh-homecontent-left-time');
        // 遍历元素
        for (var i = 0; i < elements.length; i++) {
            // 判断元素是否有display: none;属性
            if (window.getComputedStyle(elements[i]).display !== 'none') {
                // 给父元素的父元素添加属性 margin-top: 20px;
                elements[i].parentNode.parentNode.style.marginTop = '25px';
            }
        }
        
        //恢复时间颜色
        document.querySelectorAll(".homecontent-left-time-h, .homecontent-left-time-y").forEach(function(element) {
            element.style.color = "var(--textqh)";
        });
    </script>
    <?php echo "<script type=\"text/javascript\">" . $filtercujs . "</script>";?></body>
</html>