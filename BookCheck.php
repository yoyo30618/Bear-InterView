<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require '/usr/share/php/PHPMailer/src/Exception.php';
	require '/usr/share/php/PHPMailer/src/PHPMailer.php';
	require '/usr/share/php/PHPMailer/src/SMTP.php';
	if(isset($_POST['book']))//如果是由post進入
	{
		$week=$_POST['week'];//今天星期幾
		$today=$_POST['today'];//現在往未來幾天或是往前幾天
		$Account=$_SESSION['Bear-Interview_Account'];
		$RegTime="";
		require("conn_mysql.php");
		if($Account=="")//如果帳號不知道為甚麼沒抓到
			echo"<script  language=\"JavaScript\">alert('出現異常登入情形!請重新登入不好意思');location.href=\"logout.php\";</script>";
		else
		{
			for($Time=8;$Time<=18;$Time++){//一天看十個格子
				for($tmp=(-$week);$tmp<7-$week;$tmp++){//今天前本周內
					$NowFind=date("Ymd",strtotime("+".($today+$tmp)." day"))."_".str_pad(($Time-7),2,"0",STR_PAD_LEFT);
					$DateTime=date("Y-m-d",strtotime("+".($today+$tmp)." day"))." ".str_pad(($Time),2,"0",STR_PAD_LEFT).":00:00";
					$_ID=$Account."_".$NowFind;
					$Reason=$_POST['Class'];
					$Venue=$_POST['Venue'];
					$Teams=$_POST['Teams'];
					if(isset($_POST[$NowFind])){//這一格被勾起來了，要登記!
						$RegTime=$RegTime.$DateTime." ";
						$sql_query_InsertBook="INSERT INTO Appointment(_ID,Account,DataTime,Reason,Venue,Teams,Status,Notice) VALUES ('$_ID','$Account','$DateTime','$Reason','$Venue','$Teams','審核中','') ON DUPLICATE KEY UPDATE `Account`='$Account',`DataTime`='$DateTime',`Reason`='$Reason',`Venue`='$Venue',`Teams`='$Teams',`Status`='審核中'";
						mysqli_query($db_link,$sql_query_InsertBook) or die("查詢失敗");
					}
				}
			}
			function sendmail($RegTime,$Cname){
				$mail = new PHPMailer(true);
				try {
					//Server settings
					$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
					$mail->isSMTP();                                            //Send using SMTP
					$mail->Charset='UTF-8';
					$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
					$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
					$mail->Username   = 'algolab.nttucsie@gmail.com';                     //SMTP username
					$mail->Password   = 'ignsvhvygvzyvshk';                               //SMTP password
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
					$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
					//Recipients
					$mail->setFrom('algolab.nttucsie@gmail.com', "演算法實驗室");
					$mail->addAddress('cwlee@nttu.edu.tw', 'cwlee');     //Add a recipient
					//Content
					$mail->isHTML(true);                                  //Set email format to HTML
					$mail->Subject = $Cname.'預約了晤談系統!';
					$mail->Body    = '<b>'.$Cname.'預約了晤談系統2.0</b>：<br>登記時間為：'.date('Y/m/d H:i:s').'<br>欲預約的時間是：'.$RegTime;
					$mail->send();
					echo 'Message has been sent';
				} catch (Exception $e) {
					echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}
			}
			$Cname=$_SESSION['Bear-Interview_Account'];
			sendmail($RegTime,$Cname);
			echo"<script  language=\"JavaScript\">alert('".$RegTime."');location.href=\"book.php\";</script>";
		}
	}
	else//不當路徑進入
		echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"index.php\";</script>";
		
?>