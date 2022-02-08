<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require '/usr/share/php/PHPMailer/src/Exception.php';
	require '/usr/share/php/PHPMailer/src/PHPMailer.php';
	require '/usr/share/php/PHPMailer/src/SMTP.php';
	function sendmail($Acc){
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
			$mail->Subject = '有人申請了晤談系統2.0的帳號!';
			$mail->Body    = '<b>有人申請了晤談系統2.0的帳號</b>：<br>申請時間為：'.date('Y/m/d H:i:s').'<br>該生申請的帳號是：'.$Acc;
			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
	if(isset($_POST['submit']))//如果是由post進入
	{
		$studentid=$_POST['studentid'];
		$pwd=$_POST['pwd'];
		$email=$_POST['email'];
		$name=$_POST['name'];
		require("conn_mysql.php");
		$FindReg=false;
		$sql_query_RegStatus="SELECT * FROM AccountTable where Account='".$studentid."'";
		$Rst=mysqli_query($db_link,$sql_query_RegStatus) or die("操作失敗");
		//審核中 通過! 未通過
		while($row=mysqli_fetch_array($Rst)){//已經被註冊過
			if($row[2]!="拒絕申請"){//被退件的人可以重新申請
				$FindReg=true;
				break;
			}
		}
		if(!$FindReg){
			$sql_query_NewAcc="INSERT INTO AccountTable(`Account`, `Password`, `Status`, `EMail`, `Name`, `LineToken`, `Notice`)VALUES ('$studentid','$pwd','審核中','$email','$name','','') ON DUPLICATE KEY UPDATE `Account`='$studentid',`Password`='$pwd',`Status`='審核中',`EMail`='$email',`Name`='$name',`LineToken`='',`Notice`=''";
			mysqli_query($db_link,$sql_query_NewAcc) or die("查詢失敗");
		}
		else{
			echo"<script  language=\"JavaScript\">alert('帳號已被註冊');location.href=\"index.php\";</script>";
		}
		sendmail($studentid);
		echo"<script  language=\"JavaScript\">alert('註冊完畢');location.href=\"index.php\";</script>";
	}
	else//不當路徑進入
		echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"index.php\";</script>";
		
?>