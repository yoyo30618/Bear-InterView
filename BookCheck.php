<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
	if(isset($_POST['book']))//如果是由post進入
	{
		$week=$_POST['week'];//今天星期幾
		$today=$_POST['today'];//現在往未來幾天或是往前幾天
		$Account=$_SESSION['Bear-Interview_Account'];
		require("conn_mysql.php");
		if($Account=="")//如果帳號不知道為甚麼沒抓到
			echo"<script  language=\"JavaScript\">alert('出現異常登入情形!請重新登入不好意思');location.href=\"logout.php\";</script>";
		for($Time=8;$Time<18;$Time++){//一天看十個格子
			for($tmp=(-$week);$tmp<7-$week;$tmp++){//今天前本周內
				$NowFind=date("Ymd",strtotime("+".($today+$tmp)." day"))."_".str_pad(($Time-7),2,"0",STR_PAD_LEFT);
				$DateTime=date("Y-m-d",strtotime("+".($today+$tmp)." day"))." ".str_pad(($Time),2,"0",STR_PAD_LEFT).":00:00";
				$_ID=$Account."_".$NowFind;
				$Reason=$_POST['Class'];
				$Venue=$_POST['Venue'];
				$Teams=$_POST['Teams'];
				if(isset($_POST[$NowFind])){//這一格被勾起來了，要登記!
					
					$sql_query_InsertBook="INSERT INTO Appointment(_ID,Account,DataTime,Reason,Venue,Teams,Status,Notice) VALUES ('$_ID','$Account','$DateTime','$Reason','$Venue','$Teams','審核中','') ON DUPLICATE KEY UPDATE `Account`='$Account',`DataTime`='$DateTime',`Reason`='$Reason',`Venue`='$Venue',`Teams`='$Teams',`Status`='審核中'";
					mysqli_query($db_link,$sql_query_InsertBook) or die("查詢失敗");
				}
			}
		}
		echo"<script  language=\"JavaScript\">alert('登記完畢');location.href=\"book.php\";</script>";
	}
	else//不當路徑進入
		echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"index.php\";</script>";
		
?>