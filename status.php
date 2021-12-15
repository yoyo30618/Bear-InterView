<!DOCTYPE html>
<html lang="en">
	<?php
		session_start();
		if(!isset($_COOKIE['Bear-Interview_Account'])){
			header('refresh:0;url=index.php');
		}
	?>

	<head>
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
		
		<!-- START  HOME DESIGN -->
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
						</div><!-- //.HERO-TEXT -->
					</div><!--- END COL -->
				</div><!--- END CONTAINER -->
			</div><!--- END HOME OVERLAY -->
		</section>	
		<!-- END  HOME DESIGN -->	
	    <?php
			//資料撈取
			require("conn_mysql.php");
			$tp=$_SESSION['Bear-Interview_Account'];
			$sql_query_data="SELECT * FROM AccountTable where Account='$tp'";
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
	   	<!-- START SERVICE PROMOTION-->
		<section class="service-promotion section-padding">
			<div class="container">
				<div class="row text-center">
					<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
						<div class="single_service_promotion">
							<h1>個人資料</h1>
							<p>您的帳號：<?php echo $Account;?><br>
							   身分狀態：<?php echo $Stauts;?><br>
							   使用者名稱：<?php echo $Name;?><br>
							   登記信箱：<?php echo $EMail;?><br>
							</p>
						</div>
					</div><!--- END COL -->
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
					</div><!--- END COL -->
					<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
						<div class="single_service_promotion">
							<h1>點此與Line連結</h1>
							<p>還沒想</p>
						</div>
					</div><!--- END COL -->
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</section>	
		<!-- END SERVICE PROMOTION -->
		<style>
		table{
		  border: 1px solid black;
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
		
		<!-- START SERVICE DESIGN --> 
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
								?>
								<tr>
									<th><?php echo $row[0]?></th>
									<th><?php echo $row[3]?></th>
									<th><?php echo $row[4]?></th>
									<th><?php echo $row[5]?></th>
									<th><?php echo $row[6]?></th>
								</tr>
								<?php
							}
						?>
					</table><br>
					<form class="form" name="ChangePage" method="post" action="status.php">
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
					
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</section>
		<!-- END SERVICE DESIGN --> 		
		<!-- PROMOTION -->
		<section class="buy_now">
			<div class="container text-center">
				<h1 class="buy_now_title">準備好要預約了嗎?<a href="book.php" class="btn btn-default btn-promotion-bg">點此預約</a> </h1>
			</div><!--- END CONTAINER -->
		</section>
		<!-- END PROMOTION -->

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