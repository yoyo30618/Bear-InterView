<!DOCTYPE html>
<html lang="en">

	<head>
		<?php session_start();?>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<!-- SITE TITLE -->
		<title>佳衛晤談系統</title>			
		<!-- Latest Bootstrap min CSS -->
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">		
		<!-- Google Font -->
		<link href='http://fonts.googleapis.com/css?family=Cousine:400,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Merriweather:400,700,900,300' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<!-- Font Awesome CSS -->
		<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
		<!-- flexslider CSS -->	
		<link rel="stylesheet" href="assets/css/flexslider.css">		
		<!-- venobox -->
		<link rel="stylesheet" href="assets/venobox/css/venobox.css" />
		<!---owl carousel Css-->
		<link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.css">	
		<!-- animate CSS -->	
		<link rel="stylesheet" href="assets/css/animate.css">		
		<!-- Style CSS -->
		<link rel="stylesheet" href="assets/css/style.css">	
		<!-- CSS FOR COLOR SWITCHER -->
		<link rel="stylesheet" href="assets/css/switcher/switcher.css"> 	
		<link rel="stylesheet" href="assets/css/switcher/style1.css" id="colors">		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	
    <body>
<div class="bear">
		<!-- START PRELOADER -->
		<div class="preloader">
			<div class="status">
				<div class="status-mes"></div>
			</div>
		</div>
		<!-- END PRELOADER -->	
		
		<!-- START NAVBAR -->
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
                <div class="navbar-collapse collapse">
                    <nav>
						 <ul class="nav navbar-nav navbar-right">
							<li><a href="index.php">首頁</a>
							</li>
							<li><a href="book.php">晤談預約</a>
							</li>
							<li><a href="status.php">個人狀態</a>
							</li>
							<?php
								if(isset($_COOKIE['Bear-Interview_Account'])){
									?>
									<li><a href="logout.php">登出</a></li>
									<?php
								}
								else{	
									?>
									<li><a>登入/註冊</a>
										<ul class="sub-menu">
											<li><a href="login.php">登入</a></li>
											<li><a href="register.php">註冊</a></li>
										</ul>
									</li>
									<?php								
								}
							?>
						</ul>
					</nav>
                </div> 
            </div><!--- END CONTAINER -->
        </div> 	
		<!-- END NAVBAR -->	

		<!-- START HOME DESIGN -->
       <section id="home" class="home_slider">
            <div class="flexslider">
                <ul class="slides text-center">
                    <!-- SLISER ONE -->
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
		<!-- END  HOME DESIGN -->
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
		<!-- START FEATURE CONTENT -->
		<section class="feature section-padding">
			<div class="container">
				<div class="row text-center">
					<div class="section-title">
						<h1>本周老師的晤談狀態</h1>
						<h4>在這裡先看看你想與老師約的時間吧！<br>如果老師的狀態是可以預約的，那你可以登入系統登記並等待老師審核。</h4>
						<span></span>
					</div>
					<form class="form" name="ChangePage" method="post" action="index.php">
						<table>
							<?php 
								$ThisWeek=0;
								if(isset($_POST['today'])){//如果是按鈕進入 檢查是上周還是下周
									if(isset($_POST['PgeUp']))
										$today=$_POST['today']+7;
									else if(isset($_POST['PgeDown']))
										$today=$_POST['today']-7;
									else if(isset($_POST['PgeToday']))
										$today=0;
								}
								else//如果是剛進入的話 就顯示今天
									$today=0;
								$week=date("w");
							?> 
							
							<tr>
								<th></th>
								<?php 
									for($tmp=(-$week);$tmp<7-$week;$tmp++){
										if($tmp==0 && $today==0)
											echo "<th style=\"background-color:#F5FF53;\">".date("m/d",strtotime("+".($today+$tmp)." day"))."</th>";
										else
											echo "<th>".date("m/d",strtotime("+".($today+$tmp)." day"))."</th>";
									}
								?>
							</tr>
							<tr>
								<th></th>
								<?php for($tmp=(-$week);$tmp<7-$week;$tmp++){
										if($tmp==0 && $today==0)
											echo "<th style=\"background-color:#F5FF53;\">".date("D",strtotime("+".($today+$tmp)." day"))."</th>";
										else
											echo "<th>".date("D",strtotime("+".($today+$tmp)." day"))."</th>";
									}
								?>
							</tr>
							<?php 
								require("conn_mysql.php");
								for($Time=8;$Time<18;$Time++){
									echo "<tr>";
									echo "<th>$Time:10~".($Time+1).":00</th>";
									//SELECT * FROM `Appointment` WHERE `_ID`="20211207_01"
									for($tmp=(-$week);$tmp<7-$week;$tmp++){//今天前本周內
										$isfind=false;
										$sql_query_data="SELECT * FROM `Appointment` WHERE `_ID`=\"".date("Ymd",strtotime("+".($today+$tmp)." day"))."_".str_pad(($Time-7),2,"0",STR_PAD_LEFT)."\"";
										$data_result=mysqli_query($db_link,$sql_query_data) or die("查詢失敗");
										while($row=mysqli_fetch_array($data_result)){
											if($tmp==0 && $today==0)
												echo "<th style=\"background-color:#F5FF53;\">".$row[1]."</th>";
											else
												echo "<th>".$row[1]."</th>";
											$isfind=true;
											if($tmp>0)
												$ThisWeek+=1;//紀錄本周幾小時
											break;
										}
										if($isfind==false){
											if($tmp==0 && $today==0)
												echo "<th style=\"background-color:#F5FF53;\"></th>";
											else
												echo "<th></th>";
										}
									}
									echo "</tr>";
								}
							?>
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
		<!-- END FEATURE CONTENT -->
		<!-- START COUNDOWN --> 
		<section class="counter_feature">
			<div class="container-fluid">
				<div class="row text-center">
					<div class="col-sm-3 col-xs-6 no-padding wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
						<div class="counter counter-color-one">
							<?php
								$AccountTmp=$_SESSION['Bear-Interview_Account'];
								$sql_query_Count="Select Count(*) from AccountTable where 1";		
								$count_result=mysqli_query($db_link,$sql_query_Count) or die("查詢失敗");
								while($row=mysqli_fetch_array($count_result)){
									echo "<h1 class=\"timer\"> $row[0]</h1><h3>人</h3>";
									break;
								}     
							?>
							<p>已註冊人數</p>
						 </div>
					</div> <!--- END COL -->   
					<div class="col-sm-3 col-xs-6 no-padding wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<div class="counter counter-color-two">
							<h1 class="timer"> <?php echo (70-($week+1)*10-$ThisWeek);?> </h1><h3>小時</h3>
							<p>本周尚可預約時段</p>
						</div>
					</div><!--- END COL -->   
					<div class="col-sm-3 col-xs-6 no-padding wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
						<div class="counter counter-color-three">
							<h1 class="timer"> <?php echo $ThisWeek;?> </h1><h3>小時</h3>                
							<p>本周已預約時段</p>
						 </div>
					</div> <!--- END COL --> 
					<div class="col-sm-3 col-xs-6 no-padding wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="0">
						<div class="counter counter-color-four">
							<?php
								$sql_query_Count="Select Count(*) from Appointment where Status=\"通過!\"";		
								$count_result=mysqli_query($db_link,$sql_query_Count) or die("查詢失敗");
								while($row=mysqli_fetch_array($count_result)){
									echo "<h1 class=\"timer\"> $row[0]</h1><h3>小時</h3> ";
									echo "<p>已成功預約時數</p>";
									break;
								}     
							?>
						 </div>
					</div> <!--- END COL -->                
			  </div><!--- END ROW -->
		   </div><!--- END CONTAINER -->
		</section>
		<!-- END COUNDOWN -->

		<!-- START FOOTER TOP-->
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
						</div><!--- END COL -->
						<div class="col-md-2 col-sm-6  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
							<div class="single_footer">
								<h1>相關連結</h1>
								<ul>
									<li><a href="book.php">點此預約</a></li>
										<?php
											if(isset($_COOKIE['Bear-Interview_Account'])){
												?>
													<li><a href="status.php">個人狀態</a></li>
													<li><a href="logout.php">登出</a></li>
												<?php
											}
											else{
												?>
												<li><a href="login.php">登入</a></li>
												<li><a href="register.php">註冊</a></li>
												<?php								
											}
										?>
									
									<h1></h1>
									<li><a href="http://algotutor.nttu.edu.tw/domjudge">DomJudge</a></li>
									<li><a href="http://algolab.nttu.edu.tw">實驗室網頁</a></li>
									<li><a href="http://www.nttu.edu.tw">臺東大學</a></li>
								</ul>
							</div>
						</div><!--- END COL -->
					</div><!--- END ROW -->
				</div><!--- END CONTAINER -->
			</div><!--- END OVERLAY -->
		</section>
		<!-- END FOOTER TOP -->
		
		<!-- START FOOTER BOTTOM -->
		<footer class="footer section-padding">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center  wow zoomIn">
						<p class="footer_copyright">Copyright &copy; 2021.BEAR All rights reserved.</p>						
					</div><!--- END COL -->
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</footer>
		<!-- END FOOTER BOTTOM-->			

		<!-- STYLE SWITCHER -->
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
		 <!-- END OF STYLE SWITCHER -->	

		<!-- Latest jQuery -->
        <script src="assets/js/jquery-1.11.3.min.js"></script>
		<!-- Latest compiled and minified Bootstrap -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<!-- scrolltopcontrol js -->
		<script src="assets/js/scrolltopcontrol.js"></script>
		<!-- flexslider js -->
        <script src="assets/js/jquery.flexslider.js"></script>		
		<!-- venobox js -->
		<script src="assets/venobox/js/venobox.min.js"></script>
		<!-- jquery mixitup min js -->
        <script src="assets/js/jquery.mixitup.js"></script>
		<!-- countTo js -->
		<script src="assets/js/jquery.countTo.js"></script>
		<script src="assets/js/jquery.inview.min.js"></script>
		<!-- owl-carousel min js  -->
		<script src="assets/owlcarousel/js/owl.carousel.min.js"></script>
		<!-- WOW - Reveal Animations When You Scroll -->
        <script src="assets/js/wow.min.js"></script>
		<!-- switcher js -->
        <script src="assets/js/switcher.js"></script>			
		<!-- scripts js -->
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