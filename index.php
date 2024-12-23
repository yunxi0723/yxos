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
	exit("请先安装程序！<a href=\"./install/\">点击安装</a>");
}
require "./api/wz.php";
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo $name;?></title>
    <!--为搜索引擎定义关键词-->
    <meta name="keywords" content="<?php echo $keywords;?>">
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
                        
                        <?php 
$so = addslashes(htmlspecialchars($_GET["so"]));
if ($so != "") {
	?><div class="sh-main-head-top-left-s" onclick="location.href='./index.php'">
                            <i class="iconfont icon-weibiaoti al-sxb" id="top-left-xx"></i>
                        </div><?php 
}
if ($userdlzt == 0) {
	if ($loginkg == 1) {
		?>

                            <div class="sh-main-head-top-left-s" onclick="kqlogin()">
                            <!--img src="./assets/img/wo.svg" alt="" id="top-left-1"-->
                            <i class="iconfont icon-account-circle-fill ri-sxzytx" id="top-left-1"></i>
                            </div><?php 
	}
}
echo "                        <!--音乐-->
                        ";
if ($wzmusic == -1) {
} else {
	$arr = explode(PHP_EOL, $wzmusic);
	$arry = array_filter($arr);
	$ary = count($arry);
	$mu = rand(0, $ary - 1);
	$yiny = $arry[$mu];
	$arys = explode("|", $yiny);
	$mum = $arys[0];
	$muurl = $arys[1];
	$muurl = preg_replace("/[\\s\\r\\n]+/", "", $muurl);
	if ($mum == "网易音乐" && is_numeric($muurl)) {
		$mum = $arys[0];
		$muurl = "//music.163.com/song/media/outer/url?id=" . $muurl . ".mp3";
	}
	echo "
                                <div class=\"sh-main-head-top-left-mu\">
                            <div class=\"sh-main-top-mu\" lang=\"0\" onclick=\"syaudbf()\"><i class=\"iconfont icon-jixu ri-z-sx\" id=\"sh-main-top-mu\" lang=\"0\" data-bfzt=\"bb\"></i></div>
                            <div id=\"sh-main-top-g-m\" class=\"sh-main-top-g-container\" lang=\"" . $mum . "\">
                                        <div id=\"sh-main-top-mucisjd\" lang=\"0\" style=\"display:none\">
                                        <!--音乐动画-->
                                           <div class=\"shaft-load2\">
		                                     <div class=\"shaft1\"></div>
		                                     <div class=\"shaft2\"></div>
		                                     <div class=\"shaft3\"></div>
		                                     <div class=\"shaft4\"></div>
		                                     <div class=\"shaft5\"></div>
		                                     <div class=\"shaft6\"></div>
		                                     <div class=\"shaft7\"></div>
		                                     <div class=\"shaft8\"></div>
		                                     <div class=\"shaft9\"></div>
		                                     <!--div class=\"shaft10\"></div-->
	                                       </div>
                                        </div>
                                    </div>
                            <div class=\"sh-main-top-mu-bgmq\" onclick=\"sjsyyy()\"><i class=\"iconfont icon-yinle_2 ri-z-sx\" id=\"sh-main-top-mu-bgmq\"></i></div>
                            <audio id=\"sh-main-top-musicplay-b\" src=\"" . $muurl . "\" type=\"audio/mp3\" controls=\"controls\" style=\"display: none;\">
                                        您的浏览器不支持音频元素。
                            </audio>
                        </div>
                                ";
}
?>                        
                        
                        
                    </div>
                    <!-- 右边 -->
                    <div class="sh-main-head-top-right">
                        
                        
                        
                        <?php 
if ($userdlzt == 1) {
	if ($ptpfan == 1) {
		?>

<div class="sh-main-head-top-right-s" onclick="fby()">
  <i class="iconfont icon-xiangji2 ri-sx" id="top-right-3"></i>
</div><?php 
	}
	?>

                            <div class="sh-main-head-top-right-s" onclick="kqnews()"><?php 
	if ($userdlzt == 1) {
		include "./config.php";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			exit("连接失败: " . $conn->connect_error);
		}
		$sqlxx = "SELECT * FROM message order by id desc";
		$resultxx = $conn->query($sqlxx);
		$xxsl = 0;
		while ($rowxx = $resultxx->fetch_assoc()) {
			$xxsl++;
			$fuserxx = $rowxx["fuser"];
			$fimgxx = $rowxx["fimg"];
			$fnamexx = $rowxx["fname"];
			$suserxx = $rowxx["suser"];
			$titlexx = $rowxx["title"];
			$textxx = $rowxx["text"];
			$ftimexx = $rowxx["ftime"];
			$msgxx = $rowxx["msg"];
			$xxid = $rowxx["id"];
			if ($suserxx == $user_zh) {
				if ($msgxx != "-1") {
					if ($msgxx == 0) {
						$xmsgxx = "<p id=\"xiaoxhd\" class=\"xiaoxhd\"></p>";
					}
				}
			}
		}
		echo $xmsgxx;
	}
	?><i class="xxtbcl iconfont icon-lingdang ri-sx" id="top-right-1"></i>
                            </div>
                            <?php 
}
?>                        <?php 
if ($lnkzt == 0) {
	?>

                            <div class="sh-main-head-top-right-s" onclick="kqlink()">
                            <i class="iconfont icon-tongxunlu-copy ri-sx" id="top-right-2"></i>
                        </div>
                            <?php 
}
?>                        
                    </div>
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
?>                        <div class="sh-pinglun-s">
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
                                       </div><?php 
	}
}
?>                                <!-- 表情开关 -->
                                <div class="sh-pinglun-fs-right-bqimg" id="bqkg" onclick="bqkg()">
                                    <i class="iconfont icon-biaoqing ri-sxbqxz" id="sh-pinglun-fs-right-bqimg"></i>
                                </div>
                                <!-- 发送按钮 -->
                                <div class="sh-pinglun-fs-right-fs" id="sh-pinglun-fs-right-fs" onclick="fasong()">
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
include "./api/topes.php";
$wzsl = 0;
$so = addslashes(htmlspecialchars($_GET["so"]));
if ($so != "" && $so != "null") {
	$sql = "SELECT * FROM essay where ptpaud<>'0' and ptpaud<>'-1' and ptpys<>'0' and ptptext LIKE '%{$so}%' order by id desc limit {$essgs}";
} else {
	$sql = "SELECT * FROM essay where ptpaud<>'0' and ptpaud<>'-1' and ptpys<>'0' order by id desc limit {$essgs}";
}
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$wzsl = $wzsl + 1;
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
	if ($snk == "-201-201-1") {
	} else {
		if (in_array($wid, $ars)) {
			continue;
		}
	}
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
	if ($ptpys == 1 && $ptpaud == 1) {
		$contenttext0 = preg_replace("/<img[^>]+>/i", "", $ptptext);
		$contenttext1 = preg_replace("/<span[^>]+>/i", "", $contenttext0);
		$contenttext = preg_replace("/<a href=[^>]+>/i", "", $contenttext1);
		$contenttext = str_replace(" ", "", $contenttext);
		if (iconv_strlen($contenttext, "UTF-8") > 100) {
			$ptptext = "<span class=\"wzndhycyc\" id=\"sh-content-qwdid-" . $cid . "\">" . $ptptext . "</span><a href=\"JavaScript:;\" class=\"sh-content-quanwenan\" id=\"sh-content-quanwenan-" . $cid . "\" lang=\"0\" onclick=\"quanwenan()\">全文</a>";
		} else {
			$ptptext = "<span>" . $ptptext . "</span>";
		}
		if ($ptpname == "匿名用户") {
			$arcuserurl = "";
		} else {
			$arcuserurl = "onclick=\"location.href='./archives.php?user=" . md5(md5($ptpuser)) . "'\"";
		}
		echo "
                    <div class=\"sh-content\" id=\"sh-content-" . $cid . "\">
                <!-- 左边 -->
                <div class=\"sh-content-left\">
                    <!-- 头像 -->
                    <img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $ptpimg . "\" alt=\"头像\" " . $arcuserurl . ">
                </div>
                <!-- 右边 -->
                <div class=\"sh-content-right\">
                    <!-- 昵称与内容 -->
                    <div class=\"sh-content-right-head\">
                        <!-- 昵称 -->
                        <div class=\"sh-content-right-head-title\">
                            <p>" . $ptpname . "</p>
                            <div class=\"sh-content-right-head-title-ad\" style=\"" . $ggdiv . "\">
                                <p>广告</p>
                            </div>
                        </div>
                        <!-- 内容 -->
                        " . $ptptext;
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
		?>

                    </div>
                    <!-- 地址 --><?php 
		if ($ptpdw != "") {
			echo $gps;
		}
		echo "<!--广告-->";
		echo $ggurl;
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
		} else {
			$dianzmlnr = "赞";
			$dianzmlimg = "iconfont icon-aixin ri-sxdzlike";
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
                        <div class=\"sh-content-right-time-left\"><span>" . $wzfbsj . "</span></div>
                        <!-- 点赞 -->
                        <div class=\"sh-content-right-time-right\">
                            <!-- 左边合集 -->
                            <div class=\"sh-content-right-time-right-left\" id=\"pl-" . $cid . "\" name=\"pl\">
                                <div class=\"sh-content-right-time-right-left-z\" onclick=\"dinazan()\">
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
		$sql2 = "select * from lcke where lwz= '{$cid}'";
		$result2 = mysqli_query($conn, $sql2);
		if (mysqli_num_rows($result2) > 0) {
			echo "
    <!-- 点赞列表 -->
                        <div class=\"sh-zanp-zan\" id=\"zans-" . $cid . "\">
                            <!-- 左侧点赞图标 -->
                            <div class=\"sh-zanp-zan-left\"><!--img src=\"./assets/img/likel.svg\" alt=\"\"--><i class=\"iconfont icon-aixin ri-sxwzlike\"></i></div>
                            <!-- 右边点赞名列表 -->
                            <ul class=\"sh-zanp-zan-right\" id=\"zlbeh-" . $cid . "\">
                                ";
			$iw = 0;
			$dwys = 0;
			while ($row2 = mysqli_fetch_assoc($result2)) {
				$dianzmys = $row2["luser"];
				if (strpos($dianzmys, "vis#-[") !== false || strpos($dianzmys, "]-#vis") !== false) {
					$dwys++;
				} else {
					$iw++;
					$dianzms = $row2["lname"];
					echo "<li id=\"zan-" . $cid . "\" lang=\"" . $dianzms . "\">" . $dianzms . "</li>";
				}
			}
			if ($dwys != 0) {
				echo "<li id=\"fkzan-" . $cid . "\">" . $dwys . "位好友</li>";
			}
			?>

     </ul>
    </div>
    <?php 
		} else {
			echo "
    
    <!-- 点赞列表 -->
                        <div class=\"sh-zanp-zan\" id=\"zans-" . $cid . "\" style=\"display:none;\">
                            <!-- 左侧点赞图标 -->
                            <div class=\"sh-zanp-zan-left\"><i class=\"iconfont icon-aixin ri-sxwzlike\"></i></div>
                            <!-- 右边点赞名列表 -->
                            <ul class=\"sh-zanp-zan-right\" id=\"zlbeh-" . $cid . "\">
                            
                            
     </ul>
    </div>
    ";
		}
		echo "
                        <!-- 评论列表 -->";
		$sql3 = "select * from comm where wzcid= '{$cid}' and comaud<>'0' and comaud<>'-1'";
		$result3 = mysqli_query($conn, $sql3);
		$pls = 0;
		if (mysqli_num_rows($result3) > 0) {
			echo "<ul class=\"sh-zanp-pl\" id=\"sh-zanp-pl-" . $cid . "\">";
			while ($row3 = mysqli_fetch_assoc($result3)) {
				$pls = $pls + 1;
				if ($commgs < $pls) {
					$plgd = "display:flex";
					break;
				} else {
					$plgd = "display:none";
				}
				$couser = $row3["couser"];
				$coname = $row3["coname"];
				$courl = $row3["courl"];
				$cotext = $row3["cotext"];
				$bcouser = $row3["bcouser"];
				$bconame = $row3["bconame"];
				$comaud = $row3["comaud"];
				if ($comaud != 1) {
					$cotext = "该条评论未通过审核!";
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
                                <div class=\"sh-zanp-pl-n\">
                                    <a " . $plzwze . " class=\"sh-zanp-pl-n-nc\" onclick=\"hfljurl()\" target=\"_blank\">" . $coname . "</a>：
                                    <span class=\"sh-zanp-pl-n-nr\">" . $cotext . "</span>
                                </div>
                            </li>
            ";
				} else {
					echo "
            <li lang=\"" . $coname . "\" " . $pldjhf . " id=\"" . $cid . "\" value=\"" . $couser . "\" data-comkzt=\"0\">
                                <div class=\"sh-zanp-pl-n\">
                                    <a " . $plzwze . " class=\"sh-zanp-pl-n-nc\" onclick=\"hfljurl()\" target=\"_blank\">" . $coname . "</a>
                                    <span>回复</span>
                                    <span class=\"sh-zanp-pl-n-nc\">" . $bconame . "</span>：
                                    <span class=\"sh-zanp-pl-n-nr\">" . $cotext . "</span>
                                </div>
                            </li>
            ";
				}
			}
			?></ul><?php 
		} else {
			$plgd = "display:none";
			echo "<ul class=\"sh-zanp-pl\" id=\"sh-zanp-pl-" . $cid . "\" style=\"display:none;\"></ul>";
		}
		echo "

                        <!-- 显示更多评论 -->
                        <div class=\"sh-zanp-pl-ku\">
                        <a href=\"./view.php?cid=" . $cid . "\" target=\"_blank\" class=\"sh-zanp-pl-gd\" style=\"" . $plgd . "\">
                            <p class=\"zp1\"></p>
                            <p class=\"zp1\"></p>
                            <p></p>
                        </a>
                        </div>

                    </div>
                </div>
            </div>
                    ";
	}
}
$conn->close();
?>            
            </div>


























<?php 
if ($userdlzt == 0) {
	if ($loginkg == 1) {
		?><div class="sh-login" id="sh-login" onclick="gblogin()">
                <form class="sh-login-main" onsubmit="return false;" autocomplete="off" onclick="hfljurl()">
                    <!-- 顶部 -->
                    <div class="sh-login-main-top">
                        <div class="sh-news-main-top-div" onclick="gblogin()"><i class="iconfont icon-quxiao al-sxb2h"></i></div>
                    </div>
                    
                    
                    <div class="sh-login-main-kko">
                    
                    <div class="sh-login-main-kko-kok">
                    <p class="sh-login-main-kko-kok-p" id="zhdzsx">朋友圈通行证</p>
                    <!-- 中间 -->
                    <div class="sh-login-main-con">
                    <div class="sh-login-main-con-anu">
                    <p>UID</p>
                        <input type="text" name="zh" id="login-zh" spellcheck="false" minlength="5" maxlength="32" value="" placeholder="账号" onKeyUp="value=value.replace(/[\W]/g,'')">
                    </div>
                    <div class="sh-login-main-con-anu" id="sh-login-main-con-anu" style="display:none;">
                    <p>Email</p>
                        <input type="email" name="email" id="login-email" spellcheck="false" maxlength="100"  value="" placeholder="邮箱" pattern="^[a-z0-9]+([._\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$" title="请输入正确的邮箱格式">
                    </div>
                    <div class="sh-login-main-con-anu">
                    <p>PW</p>
                        <input type="password" name="pwd" id="login-pass" spellcheck="false" minlength="3" maxlength="16" value="" placeholder="密码">
                    </div><?php 
		if ($regverify == "1") {
			?><div class="sh-login-main-con-anu" id="sh-login-main-con-yzmwk" style="display:none;">
                    <p>验证码</p>
                        <input type="password" name="yzm" id="login-yzm" spellcheck="false" minlength="3" maxlength="16" value="" placeholder="验证码" style="margin-right: 5px;">
                        <p style="color: var(--thetitle);margin: 0 30px 0 0;font-size: 14px;cursor: pointer;" id="yzm">发送</p>
                    </div><?php 
		}
		?>

                    <!--div class="sh-login-main-con-anu">
                    <a href="JavaScript:;" onclick="zhmm()">忘记密码</a>
                    </div-->
                    </div>
                    <!-- 底部 -->
                    <div class="sh-login-main-bot">
                        <input type="submit" value="登录" class="sh-right" id="sh-left-dlzc" onclick="logy()">
                    </div>
                    </div>
                    
                    <div class="sh-login-main-bottom">
                    <a href="JavaScript:;" onclick="zhmm()" onkeydown="return checkKeyDown(event)">忘记密码</a><?php 
		if ($regqx == 0) {
			?><p></p>
                    <a href="JavaScript:;" id="sh-zck-an" onclick="zcanxy()" onkeydown="return checkKeyDown(event)">注册账号</a><?php 
		}
		?>
                    </div>

                    </div>
                </form>
            </div><?php 
	}
}
echo "














            

";
if ($userdlzt == 1) {
	?><div class="sh-news" id="sh-news" onclick="gbnews()">
                <div class="sh-news-main" id="sh-news-main" onclick="hfljurl()">
                    <!-- 顶部 -->
                    <div class="sh-news-main-top">
                        <div class="sh-news-main-top-xiaoxih"><span>通知</span></div>
                        <div class="sh-news-main-top-div" style="display:none;" id="xxscztqbk" class="sh-news-main-top-img" onclick="xxscztqb()"><i class="iconfont icon-shanchuwenjian ri-sxhsh ri-sxhs" id="xxscztqb"></i></div>
                        
                        <div class="sh-news-main-top-div sh-news-main-top-div2" onclick="js_menu()">
                          <i class="iconfont icon-xialajiantouxiao ri-sxhqx"></i>
                          <div id="js_menu" class="sh-news-main-top-div-menu" style="display: none;">
                            <a href="JavaScript:;" onclick="xxscyd()" class="iconfont icon-icon-09 ri-sxhs">全部已读</a>
                            <a href="JavaScript:;" onclick="xxsczt()" class="iconfont icon-xuanze ri-sxhs" id="xxsczt" lang="0">选择消息</a>
                            <a href="JavaScript:;" onclick="xxscztqb()" class="iconfont icon-shanchu ri-sxhs">删除所有</a>
                          </div>
          
                        </div>
                        <div class="sh-news-main-top-div" onclick="gbnews()"><i class="iconfont icon-quxiao ri-sxhqx"></i></div>
                    </div>
                    <!-- 内容 -->
                    <div class="sh-news-con" id="sh-news-con"><?php 
	include "./config.php";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		exit("连接失败: " . $conn->connect_error);
	}
	$sqlxx = "SELECT * FROM message order by id desc";
	$resultxx = $conn->query($sqlxx);
	$xxsl = 0;
	while ($rowxx = $resultxx->fetch_assoc()) {
		$xxsl++;
		$fuserxx = $rowxx["fuser"];
		$fimgxx = $rowxx["fimg"];
		$fnamexx = $rowxx["fname"];
		$suserxx = $rowxx["suser"];
		$titlexx = $rowxx["title"];
		$textxx = $rowxx["text"];
		$ftimexx = $rowxx["ftime"];
		$msgxx = $rowxx["msg"];
		$xxid = $rowxx["id"];
		if ($titlexx == "新的点赞") {
			$sql = "select * from lcke where luser= '{$fuserxx}' and ltime='{$ftimexx}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			if ($row) {
				$wzssid = $row["lwz"];
			} else {
				$wzssid = "#-1";
			}
		} else {
			$sql = "select * from comm where couser= '{$fuserxx}' and cotime='{$ftimexx}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			if ($row) {
				$wzssid = $row["wzcid"];
			} else {
				$wzssid = "#-1";
			}
		}
		$data_result = mysqli_query($conn, "select * from essay where cid='{$wzssid}'");
		$data_row = mysqli_fetch_array($data_result);
		$wzdlx = $data_row["ptplx"];
		$wzdtp = $data_row["ptpimag"];
		$wzdnr = $data_row["ptptext"];
		if ($wzdlx == "img") {
			if ($wzdtp != "") {
				$imgar = explode("(+@+)", $wzdtp);
				$coun = count($imgar);
				$wzdtp = $imgar[0];
			} else {
				$wzdtp = "./assets/img/thumbnailbg.svg";
			}
			$wzfmd = "<img src=\"./assets/img/thumbnailbg.svg\" data-src=\"" . $wzdtp . "\" alt=\"动态封面\">";
		} elseif ($wzdlx == "only") {
			$wzfmd = "<div class=\"sh-xxliebwb\"><span>" . $wzdnr . "</span></div>";
		} else {
			$wzdtp = "./assets/img/thumbnailbg.svg";
			$wzfmd = "<img src=\"./assets/img/thumbnailbg.svg\" data-src=\"" . $wzdtp . "\" alt=\"动态封面\">";
		}
		$time = strtotime($ftimexx);
		$ftimexx = ReckonTime($time);
		if ($suserxx == $user_zh) {
			if ($msgxx != "-1") {
				if ($msgxx == 0) {
					echo "<div id=\"" . $xxid . "\" class=\"sh-news-con-lie\" lang=\"" . $wzssid . "\" onclick=\"mesgxq()\">
                            <!-- 左 -->
                            <div class=\"sh-news-con-lie-left\">
                                <p id=\"xxztx-" . $xxid . "\"></p>
                                <div class=\"sh-news-con-lie-left-imgt\">
                                <img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $fimgxx . "\" alt=\"头像\" class=\"sh-news-con-lie-left-img\"></div>
                            </div>
                            <!-- 右 -->
                            <div class=\"sh-news-con-lie-right\">
                                <p id=\"xxtzidtitle-" . $xxid . "\" class=\"sh-news-con-lie-right-title\">" . $fnamexx . "<span class=\"sh-news-con-lie-right-time\">" . $ftimexx . "</span>" . "</p>
                                <p id=\"xxtzidtext-" . $xxid . "\" class=\"sh-news-con-lie-right-text\" lang=\"" . $titlexx . "\">" . $textxx . "</p>  
                            </div>
                            <div class=\"sh-xxliebfm\">" . $wzfmd . "<div class=\"delmes\" id=\"" . $xxid . "\" onclick=\"demes()\">删除</div></div>
                        </div>
                ";
				} elseif ($msgxx == 1) {
					echo "<div id=\"" . $xxid . "\" class=\"sh-news-con-lie\" lang=\"" . $wzssid . "\" onclick=\"mesgxq()\">
                            <!-- 左 -->
                            <div class=\"sh-news-con-lie-left\">
                                <p id=\"xxztx-" . $xxid . "\" style=\"display:none\"></p>
                                <div class=\"sh-news-con-lie-left-imgt\">
                                <img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $fimgxx . "\" alt=\"头像\" class=\"sh-news-con-lie-left-img\"></div>
                            </div>
                            <!-- 右 -->
                            <div class=\"sh-news-con-lie-right\">
                                <p id=\"xxtzidtitle-" . $xxid . "\" class=\"sh-news-con-lie-right-title\">" . $fnamexx . "<span class=\"sh-news-con-lie-right-time\">" . $ftimexx . "</span>" . "</p>
                                <p id=\"xxtzidtext-" . $xxid . "\" class=\"sh-news-con-lie-right-text\" lang=\"" . $titlexx . "\">" . $textxx . "</p>  
                            </div>
                            <div class=\"sh-xxliebfm\">" . $wzfmd . "<div class=\"delmes\" id=\"" . $xxid . "\" onclick=\"demes()\">删除</div></div>
                        </div>
                ";
				}
			} else {
				$xxsl--;
			}
		} else {
			$xxsl--;
		}
	}
	echo "</div>
        <!-- 内容 end -->
        <!-- 提示 -->
        <div class=\"sh-news-tishi\">
            <P>共<span id=\"xxtzsul\">" . $xxsl . "</span>条消息</P>
        </div>
    </div>
</div>";
}
echo "

";
if ($lnkzt == 0) {
	?><div class="sh-link" id="sh-link" onclick="gblink()">
<div class="sh-link-main" id="sh-link-main" onclick="hfljurl()">
    <!-- 顶部 -->
    <div class="sh-link-main-top">
        <div class="sh-news-main-top-xiaoxih"><span>我的邻居</span></div>
        <!--img src="./assets/img/light.svg" alt="" class="sh-link-main-top-img" onclick="gblink()"-->
        <div class="sh-news-main-top-div" onclick="gblink()"><i class="iconfont icon-quxiao ri-sxhqx"></i></div>
    </div>
    <!-- 内容 -->
    <div class="sh-link-con"><?php 
	include "./config.php";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		exit("连接失败: " . $conn->connect_error);
	}
	$iy = 0;
	$sqllink = "SELECT * FROM link";
	$resultlink = $conn->query($sqllink);
	while ($rowlink = $resultlink->fetch_assoc()) {
		$iy++;
		$linkurl = $rowlink["url"];
		$linkurls = $rowlink["urls"];
		$linkurlimg = $rowlink["urlimg"];
		echo "<a href=\"" . $linkurl . "\" class=\"sh-link-con-lie\" target=\"_blank\">
                            <!-- 左 -->
                            <div class=\"sh-link-con-lie-left\">
                                <img src=\"./assets/img/thumbnail.svg\" data-src=\"" . $linkurlimg . "\" alt=\"\" class=\"sh-link-con-lie-left-img\">
                            </div>
                            <!-- 右 -->
                            <div class=\"sh-link-con-lie-right\">
                                <p class=\"sh-link-con-lie-right-title\">" . $linkurls . "</p> 
                            </div>
                        </a>";
	}
	$conn->close();
	echo "</div>
    <!-- 内容 end -->
        <!-- 提示 -->
        <div class=\"sh-link-tishi\">
        <P>共" . $iy . "个邻居</P>
        </div>
    </div>
    </div>";
}
?>




            <div class="footer">
                <div class="footer-text" id="footer-text-zt" onclick="hqgd()">正在加载中...</div>
                <p style="display:none" id="footer-text-hqgd"><?php echo $wzsl;?></p>
            </div>


        </div>


<?php 
if ($search == "1") {
	?><div class="so" id="so" onclick="gbso()">
    <form class="sobd" method="get" action="./index.php?so=" onclick="hfljurl()">
          <input class="sobd-in" maxlength="50" autocomplete="off" placeholder="请输入关键字.." name="so" value="" type="text" required>
          <button class="sobd-bu" type="submit">搜一搜</button>
        </form>
</div><?php 
}
?>



<!--右下角悬浮菜单-->
<div class="sh-menu" id="sh-menu">
    <?php 
if ($search == "1") {
	?><div class="sh-menu-k" id="scrtop" onclick="kqso()"><i class="iconfont icon-sousuoxiao"></i></div><?php 
}
if ($daymode == "1") {
	$darktheme = $_COOKIE["dark_theme"];
	if ($darktheme == "dark-theme") {
		?><div class="sh-menu-k" id="day" lang="0"><i class="iconfont icon-yueliang" id="day-i"></i></div><?php 
	} else {
		?><div class="sh-menu-k" id="day" lang="1"><i class="iconfont icon-ai250" id="day-i"></i></div><?php 
	}
}
if ($gotop == "1") {
	?><div class="sh-menu-k" id="scrtop" onclick="scrollToTop()"><i class="iconfont icon-weibiaoti-x-copy"></i></div><?php 
}
?></div>




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

    <script type="text/javascript" id="script-id1">
    var myallkeyVar ="<?php echo $allkey;?>";//获取发文章用的key
    // 获取要删除的 script 标签的引用  
    var scriptTag = document.getElementById("script-id1");  
    // 删除 script 标签  
    scriptTag.parentNode.removeChild(scriptTag);
    </script>
    
    <script type="text/javascript" src="./assets/js/index.js?v=<?php echo $resversion;?>"></script>
    <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/mesg/dist/js/sh-noytf.js?v=<?php echo $resversion;?>"></script>
    <script type="text/javascript" src="./assets/js/jquery.fancybox.min.js?v=<?php echo $resversion;?>"></script>
    <?php echo "<script type=\"text/javascript\">" . $filtercujs . "</script>";?>    
</body>
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