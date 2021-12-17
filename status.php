<!DOCTYPE html>
<html lang="en">
	<head>
		<?php 
			session_start();
			require("conn_mysql.php");
			if(!isset($_COOKIE['Bear-Interview_Account'])){//未登入 跳轉離開
				header('refresh:0;url=index.php');
			}
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
									if(isset($_COOKIE['Bear-Interview_Status'])&&($_COOKIE['Bear-Interview_Status'])=="管理員")
										echo "<li><a href=\"RecordStatus.php\">審核申請</a></li>";
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
			<!--中上橫幅-->
			<section class="section-top" style="background-image: url(assets/img/bg/section-bg.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;">
				<div class="overlay">
					<div class="container">
						<div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
							<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
								<h1>個人狀態</h1>
								<ol class="breadcrumb">
								<li><a href="index.php">首頁</a></li>
								<li class="active">個人狀態</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</section>	
			
			<?php
				$tp=$_SESSION['Bear-Interview_Account'];
				$sql_query_data="SELECT * FROM AccountTable where Account='$tp'";//資料撈取
				$Data_result=mysqli_query($db_link,$sql_query_data) or die("查詢失敗");
				while($row=mysqli_fetch_array($Data_result))
				{
					$Account=$row[0];
					$Password=$row[1];
					$Stauts=$row[2];
					$EMail=$row[3];
					$Name=$row[4];
				}
			?>
			<!--中央重點-->
			<section class="service-promotion section-padding">
				<div class="container">
					<div class="row text-center">
						<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
							<div class="single_service_promotion">
								<h1>個人資料</h1>
								<p>
									您的帳號：<?php echo $Account;?><br>
									身分狀態：<?php echo $Stauts;?><br>
									使用者名稱：<?php echo $Name;?><br>
									登記信箱：<?php echo $EMail;?><br>
								</p>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
							<div class="single_service_promotion">
								<h1>密碼修改</h1>
								<form class="form" name="ChangePWD" method="post" action="ChangePassword.php">
									<p>目前密碼：<?php echo $Password;?></p>
									<input type="password" name="NewPassword1" class="form-control" placeholder="輸入新密碼"required="required"><br>
									<input type="password" name="NewPassword2" class="form-control" placeholder="二次確認新密碼"required="required"><br>
									<input type="submit" value="密碼修改" name="ChangePWD" id="submitButton" class="btn-light-bg" title="密碼修改"/><br>
								</form>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
							<div class="single_service_promotion">
								<h1>點此與Line連結</h1>
								<p>還沒想</p>
							</div>
						</div>
					</div>
				</div>
			</section>	
			<section class="service">			
				<div class="container">
					<div class="row text-center">
						<h1>預約紀錄</h1>
						<table>
						<tr>
							<th>日期&時間</th>
							<th>原因</th>
							<th>地點</th>
							<th>參與人</th>
							<th>狀態</th>
						</tr>
							<?php
								$sql_query_Count="Select Count(*) from Appointment where Account='$tp'";							
								$Count_result=mysqli_query($db_link,$sql_query_Count) or die("查詢失敗");
								$NowPage=1;
								while($row=mysqli_fetch_array($Count_result))//無條件進位，產生頁碼(共有幾頁)
									$DataLine=(int)(($row[0]+9)/10);//+9為了進位
								if($DataLine==0)$DataLine=1;//如果沒資料也要有一頁
								if(isset($_POST['Pge'])){
									if($_POST['Pge']=="第一頁") $NowPage=1;
									else if($_POST['Pge']=="最後一頁")$NowPage=$DataLine;
									else $NowPage=$_POST['Pge'];//i現在顯示第幾頁面
								}
								$FirstData=(int)(($NowPage-1)*10);
								//資料撈取
								$sql_query_Record="SELECT * FROM Appointment where Account='$tp' order by `_ID` desc limit  $FirstData, 10";
								$Record_result=mysqli_query($db_link,$sql_query_Record) or die("查詢失敗");
								while($row=mysqli_fetch_array($Record_result))
								{
									echo "<tr>";
										echo "<th>".substr($row[2],0,16)."</th>";
										echo "<th>".$row[3]."</th>";
										echo "<th>".$row[4]."</th>";
										echo "<th>".$row[5]."</th>";
										echo "<th>".$row[6]."</th>";
									echo "</tr>";
								}
							?>
						</table><br>
						<form class="form" name="ChangePage" method="post" action="status.php"><!--換頁用Form-->
							<?php
								echo "<input type=\"submit\" value=\"第一頁\" name=\"Pge\" id=\"submitButton\" class=\"btn-light-bg\"style=\"background-color:#FF5D00;\">&nbsp;";
								for($tmp=$NowPage-2,$j=0;($tmp<=$DataLine)&&$j<5;$tmp++){//j代表顯示五頁面 從現在頁面往前三 往後二
									if($tmp>0){
										$j++;
										if( $NowPage==$tmp)//i要無條件進位!
											echo "<input type=\"submit\" value=\"$tmp\" name=\"Pge\" id=\"submitButton\" class=\"btn-light-bg\" style=\"background-color:blue;\">&nbsp;";
										else
											echo "<input type=\"submit\" value=\"$tmp\" name=\"Pge\" id=\"submitButton\" class=\"btn-light-bg\">&nbsp;";
									}
								}
								echo "<input type=\"submit\" value=\"最後一頁\" name=\"Pge\" id=\"submitButton\" class=\"btn-light-bg\"style=\"background-color:#FF5D00;\">&nbsp;";
							?>
						</form><br>
						
					</div>
				</div>
			</section>		
			<!--預約廣告-->
			<section class="buy_now">
				<div class="container text-center">
					<h1 class="buy_now_title">準備好要預約了嗎?<a href="book.php" class="btn btn-default btn-promotion-bg">點此預約</a> </h1>
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