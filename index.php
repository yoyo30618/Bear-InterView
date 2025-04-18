<!DOCTYPE html>
<html lang="en">
	<head>
		<?php 
			session_start();
			require("conn_mysql.php");
		?>
		<!-- 設定抬頭與預設css -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>佳衛晤談系統</title>		
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">	
		<link href='http://fonts.googleapis.com/css?family=Cousine:400,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Merriweather:400,700,900,300' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/flexslider.css">	
		<link rel="stylesheet" href="assets/venobox/css/venobox.css" />
		<link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.css">	
		<link rel="stylesheet" href="assets/css/animate.css">	
		<link rel="stylesheet" href="assets/css/style.css">	
		<link rel="stylesheet" href="assets/css/switcher/switcher.css"> 	
		<link rel="stylesheet" href="assets/css/switcher/style1.css" id="colors">	
		<style>
			table{
			width:100%;
			border-collapse: collapse;
			}
			th, td {
			border: 1px solid black;
			width:10%;
			text-align:center;
			border-collapse: collapse;
			font-size:25px;
			}
		</style>
	</head>
	
    <body>
		<div class="bear">
			<!--START PRELOADER-->
			<div class="preloader status">
				<div class="status">
					<div class="status-mes"></div>
				</div>
			</div>		
			<!--START NAVBAR-->
			<div class="navbar navbar-default navbar-fixed-top menu-top menu_dropdown">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="index.php" class="navbar-brand"><img src="assets/img/logo.png" alt="logo"></a>
					</div>
					<!--上方橫幅宣告-->
					<div class="navbar-collapse collapse">
						<nav>
							<ul class="nav navbar-nav navbar-right">
								<li><a href="index.php">首頁</a></li>
								<li><a href="book.php">晤談預約</a></li>
								<li><a href="status.php">個人狀態</a></li>
								<?php
									if(isset($_COOKIE['Bear-Interview_Status'])&&($_COOKIE['Bear-Interview_Status'])=="管理員"){
										echo "<li><a href=\"RecordStatus.php\">審核申請</a></li>";
										echo "<li><a href=\"RegisterStatus.php\">註冊申請</a></li>";
										echo "<li><a href=\"BulkImport.php\">批量匯入</a></li>";
										echo "</li>";
									}
									if(isset($_COOKIE['Bear-Interview_Account']))//如果有設定cookie代表已經登入
										echo "<li><a href=\"logout.php\">登出</a></li>";
									else{//尚未登入則顯示登入與註冊按鈕
										echo "<li><a>登入/註冊</a>";
											echo "<ul class=\"sub-menu\">";
												echo "<li><a href=\"login.php\">登入</a></li>";
												echo "<li><a href=\"register.php\">註冊</a></li>";
											echo "</ul>";
										echo "</li>";
									}
								?>
							</ul>
						</nav>
					</div> 
				</div>
			</div> 	
			<!--上方大橫幅 -->
			<section id="home" class="home_slider">
				<div class="flexslider">
					<ul class="slides text-center">
						<li>
							<img src="assets/img/bg/slide1.jpg" alt="">
							<div class="slider_text_one">
								<div class="container">
									<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">								
										<h1>在這個網頁你可以找到老師</h1>
										<h4>為避免大家撲空，可以先利用這個網頁與老師預約晤談時間。</h4>
										<a class="btn-light-bg" href="book.php">點此預約</a>
									</div>	
								</div>	
							</div><!-- //.HERO-TEXT -->
						</li>
						<!-- END SLIDER ONE -->
					</ul>
				</div>
			</section>
			<!--中央重點-->
			<?php //時間根據目前頁碼設定
				$ThisWeek=0;
				$FeaTureWeek=0;
				if(isset($_POST['today'])){//如果是按鈕進入 檢查是上周還是下周
					if(isset($_POST['PgeUp']))
						$today=$_POST['today']+7;//today紀錄偏差日期
					else if(isset($_POST['PgeDown']))
						$today=$_POST['today']-7;
					else if(isset($_POST['PgeToday']))
						$today=0;
				}
				else//如果是剛進入的話 就顯示今天
					$today=0;
				$week=date("w");//week為本日星期
			?> 						
			<section class="feature section-padding">
				<div class="container">
					<div class="row text-center">
						<div class="section-title">
							<h1><?php echo date("m/d",strtotime("+".($today-$week)." day"))."~".date("m/d",strtotime("+".($today-$week+6)." day")); ?>老師的晤談狀態</h1>
							<h4>在這裡先看看你想與老師約的時間吧!<br>如果老師的狀態是可以預約的，那你可以登入系統登記並等待老師審核。</h4>
							<span></span>
						</div>
						<form class="form" name="ChangePage" method="post" action="index.php">
							<table>	
								<tr>
									<th></th>
									<?php 
										for($tmp=(-$week);$tmp<7-$week;$tmp++){//根據偏差日期畫表
											if($tmp==0 && $today==0)//本周 且本日 黃格
												echo "<th style=\"background-color:#F5FF53;\">".date("m/d",strtotime("+".($today+$tmp)." day"))."</th>";
											else
												echo "<th>".date("m/d",strtotime("+".($today+$tmp)." day"))."</th>";
										}
									?>
								</tr>
								<tr>
									<th></th>
									<?php for($tmp=(-$week);$tmp<7-$week;$tmp++){//根據偏差日期畫表
											if($tmp==0 && $today==0)//本周 且本日 黃格
												echo "<th style=\"background-color:#F5FF53;\">".date("D",strtotime("+".($today+$tmp)." day"))."</th>";
											else
												echo "<th>".date("D",strtotime("+".($today+$tmp)." day"))."</th>";
										}
									?>
								</tr>
								<?php 
									for($Time=8;$Time<=18;$Time++){//動態生成儲存格並查詢
										echo "<tr>";
											echo "<th>$Time:10~".($Time+1).":00</th>";
											for($tmp=(-$week);$tmp<7-$week;$tmp++){//由本日星期推斷偏差日期
												$isfind=false;//是否有紀錄
												$sql_query_data="SELECT * FROM `Appointment` WHERE `_ID`LIKE \"%".date("Ymd",strtotime("+".($today+$tmp)." day"))."_".str_pad(($Time-7),2,"0",STR_PAD_LEFT)."\"";
												$data_result=mysqli_query($db_link,$sql_query_data) or die("查詢失敗");//像資料庫查詢當日紀錄
												while($row=mysqli_fetch_array($data_result)){
													if($row[6]=="通過!"){
														if($tmp==0 && $today==0){//若為當日 當周則黃色
															if(isset($_COOKIE['Bear-Interview_Status'])){//如果有設定cookie(登入狀態)
																if($_COOKIE['Bear-Interview_Status']=="管理員")//且他是管理員
																	echo "<th style=\"background-color:#F5FF53;\">".$row[1]."</th>";
																	else if($row[1]==$_COOKIE['Bear-Interview_Account'])//且他是管理員
																		echo "<th style=\"background-color:#F5FF53;color:red;\">自己已登記</th>";
																	else
																		echo "<th style=\"background-color:#F5FF53;color:red;\">已有人登記</th>";
															}
															else//非登入狀態
																echo "<th style=\"background-color:#F5FF53;color:red;\">已有人登記</th>";
														}
														else{//其餘白底
															if(isset($_COOKIE['Bear-Interview_Status'])){//如果有設定cookie(登入狀態)
																if($_COOKIE['Bear-Interview_Status']=="管理員")//且他是管理員
																	echo "<th>".$row[1]."</th>";
																	else if($row[1]==$_COOKIE['Bear-Interview_Account'])//且他是管理員
																		echo "<th style=\"color:red;\">自己已登記</th>";
																	else
																		echo "<th style=\"color:red;\">已有人登記</th>";
															}
															else//非登入狀態
																echo "<th>已有人登記</th>";
														}
														$isfind=true;
														if($tmp>0)//本周的只算未來日期
															$FeaTureWeek+=1;//紀錄本周幾小時
														$ThisWeek+=1;//紀錄查詢當周幾小時
														break;
													}
													else if($row[6]=="審核中"&&$row[1]==$_COOKIE['Bear-Interview_Account']){//自己的登記 但還沒審核
														if($tmp==0 && $today==0)//若為當日 當周則黃色
															echo "<th style=\"background-color:#F5FF53;\">待老師審核</th>";
														else
															echo "<th>待老師審核</th>";
														$isfind=true;
														break;
													}
												}
												if($isfind==false){//沒找到的話
													if($tmp==0 && $today==0)//當周當日黃底
														echo "<th style=\"background-color:#F5FF53;\"></th>";
													else
														echo "<th></th>";
												}
											}
										echo "</tr>";
									}
								?>
								<!--下方換周按鈕-->
								<tr style="padding:1%;border: none;">
									<th style="padding:1%;border: none;"></th>
									<th colspan="7"style="padding:1%;border: none;">
									<?php
										echo "<input type=\"hidden\" name=\"today\" value=\"$today\" />";
										echo "<input type=\"submit\" value=\"上一周\" name=\"PgeDown\" id=\"submitButton\" class=\"btn-light-bg\"style=\"background-color:#FF5D00;\">&nbsp;";
										echo "<input type=\"submit\" value=\"今天\" name=\"PgeToday\" id=\"submitButton\" class=\"btn-light-bg\"style=\"background-color:#FF5D00;\">&nbsp;";
										echo "<input type=\"submit\" value=\"下一周\" name=\"PgeUp\" id=\"submitButton\" class=\"btn-light-bg\"style=\"background-color:#FF5D00;\">&nbsp;";
									?>
									</th>
								</tr>
							</table>
						</form>
					</div><!--- END ROW -->
				</div>
			</section>
			<!--中央酷炫數數區域--> 
			<section class="counter_feature">
				<div class="container-fluid">
					<div class="row text-center">
						<!-- 已註冊人數 -->
						<div class="col-sm-3 col-xs-6 no-padding wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
							<div class="counter counter-color-one">
								<?php
									$sql_query_Count="Select Count(*) from AccountTable where 1";		
									$count_result=mysqli_query($db_link,$sql_query_Count) or die("查詢失敗");//查詢現有帳號數量
									while($row=mysqli_fetch_array($count_result)){
										echo "<h1 class=\"timer\"> $row[0]</h1><h3>人</h3>";
										break;
									}     
								?>
								<p>已註冊人數</p>
							</div>
						</div> 
						<!-- 可預約時段 -->
						<div class="col-sm-3 col-xs-6 no-padding wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
							<div class="counter counter-color-two">
								<?php 
									if($today>0)//未來周
										echo "<h1 class=\"timer\">".(77-$ThisWeek)."</h1><h3>小時</h3>";//未來周可以直接用77去扣全周預約時數($ThisWeek)
									else if($today<0)//過去周
										echo "<h1 class=\"timer\">0</h1><h3>小時</h3>";//過去不可預約 0小時
									else//本周
										echo "<h1 class=\"timer\">".(77-($week+1)*10-$FeaTureWeek)."</h1><h3>小時</h3>";//本周須扣除已過的日子($FeaTureWeek)
								?>
								<p>本周尚可預約時段</p>
							</div>
						</div>
						<!-- 已預約時段 -->
						<div class="col-sm-3 col-xs-6 no-padding wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
							<div class="counter counter-color-three">
								<h1 class="timer"> <?php echo $ThisWeek;?> </h1><!--$ThisWeek為全周預約時數-->
								<h3>小時</h3>                
								<p>本周已預約時段</p>
							</div>
						</div>
						<!-- 成功預約時數 -->
						<div class="col-sm-3 col-xs-6 no-padding wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="0">
							<div class="counter counter-color-four">
								<?php
									$sql_query_Count="Select Count(*) from Appointment where Status=\"通過!\"";		
									$count_result=mysqli_query($db_link,$sql_query_Count) or die("查詢失敗");//查詢所有通過的紀錄
									while($row=mysqli_fetch_array($count_result)){
										echo "<h1 class=\"timer\">".$row[0]."</h1>";
										echo "<h3>小時</h3> ";
										echo "<p>已成功預約時數</p>";
										break;
									}     
								?>
							</div>
						</div>     
				</div>
			</div>
			</section>
			<!--底部資訊-->
			<section class="footer-top">
				<div class="footer_overlay section-padding">	
					<div class="container">
						<div class="row">					
							<div class="col-md-4 col-sm-6  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
								<div class="single_footer">
									<h1>佳衛晤談系統</h1>
									<p>為避免大家撲空，可以先利用這個網頁與老師預約晤談時間。</p>
									<div class="footer_contact">
										<ul>
											<li><i class="fa fa-phone"></i> 連絡電話<br>(089)318855#6212<br>(089)517602</li>
											<li><i class="fa fa-envelope"></i> cwlee@nttu.edu.tw</li>
											<li><i class="fa fa-rocket"></i>95092<br>臺東市大學路二段369號 資訊工程學系</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-6  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
								<div class="single_footer">
									<h1>相關連結</h1>
									<ul>
										<li><a href="book.php">點此預約</a></li>
											<?php
												if(isset($_COOKIE['Bear-Interview_Account'])){//如果設定cookie代表已登入
													echo "<li><a href=\"status.php\">個人狀態</a></li>";
													echo "<li><a href=\"logout.php\">登出</a></li>";
												}
												else{//尚未登入顯示登入與註冊
													echo "<li><a href=\"login.php\">登入</a></li>";
													echo "<li><a href=\"register.php\">註冊</a></li>";
												}
											?>
										<h1></h1>
										<li><a href="http://algotutor.nttu.edu.tw/domjudge">DomJudge</a></li>
										<li><a href="http://algolab.nttu.edu.tw">實驗室網頁</a></li>
										<li><a href="http://www.nttu.edu.tw">臺東大學</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--版權列-->
			<footer class="footer section-padding">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center  wow zoomIn">
							<p class="footer_copyright">Copyright &copy; 2021.BEAR All rights reserved.</p>						
						</div>
					</div>
				</div>
			</footer>
			<!--無用換色功能-->
			<div id="style-switcher">
				<h2>選擇你喜愛的顏色<a href="#"><i class="fa fa-cog fa-spin"></i></a></h2>
				<div>
				<ul class="colors" id="color1">
					<li><a href="#" class="style1"></a></li>
					<li><a href="#" class="style2"></a></li>
					<li><a href="#" class="style3"></a></li>
					<li><a href="#" class="style4"></a></li>
					<li><a href="#" class="style5"></a></li>
					<li><a href="#" class="style6"></a></li>
					<li><a href="#" class="style7"></a></li>
					<li><a href="#" class="style8"></a></li>
					<li><a href="#" class="style9"></a></li>
					<li><a href="#" class="style10"></a></li>
					<li><a href="#" class="style11"></a></li>
					<li><a href="#" class="style12"></a></li>
					<li><a href="#" class="style13"></a></li>
					<li><a href="#" class="style14"></a></li>
					<li><a href="#" class="style15"></a></li>
					<li><a href="#" class="style16"></a></li>
					<li><a href="#" class="style17"></a></li>
					<li><a href="#" class="style18"></a></li>
					<li><a href="#" class="style19"></a></li>
					<li><a href="#" class="style20"></a></li>
				</ul>
				</div>
			</div>  
			<script src="assets/js/jquery-1.11.3.min.js"></script>
			<script src="assets/bootstrap/js/bootstrap.min.js"></script>
			<script src="assets/js/scrolltopcontrol.js"></script>
			<script src="assets/js/jquery.flexslider.js"></script>		
			<script src="assets/venobox/js/venobox.min.js"></script>
			<script src="assets/js/jquery.mixitup.js"></script>
			<script src="assets/js/jquery.countTo.js"></script>
			<script src="assets/js/jquery.inview.min.js"></script>
			<script src="assets/owlcarousel/js/owl.carousel.min.js"></script>
			<script src="assets/js/wow.min.js"></script>
			<script src="assets/js/switcher.js"></script>			
			<script src="assets/js/scripts.js"></script>
			<script type="text/javascript">
				$(".partner").owlCarousel({
				autoPlay: 3000, //Set AutoPlay to 3 seconds
				items : 4,
				itemsDesktop : [1199,3],
				itemsDesktopSmall : [979,3]
				});
			</script>
		</div>
    </body>
</html>