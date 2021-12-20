<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
	if(isset($_POST['book']))//如果是由post進入
	{
		//理論上可以送出 代表尚未被通過預約，所以目前不考慮重複問題((可能同時多人預約待審核，但不可能預約通過後還可以到這))
		$week=$_POST['week'];//今天星期幾
		$today=$_POST['today'];//現在往未來幾天或是往前幾天
		$Account=$_SESSION['Bear-Interview_Account'];
		require("conn_mysql.php");
		for($Time=8;$Time<18;$Time++){//一天看十個格子
			for($tmp=(-$week);$tmp<7-$week;$tmp++){//今天前本周內
				$NowFind=date("Ymd",strtotime("+".($today+$tmp)." day"))."_".str_pad(($Time-7),2,"0",STR_PAD_LEFT);
				$DateTime=date("Y-m-d",strtotime("+".($today+$tmp)." day"))." ".str_pad(($Time),2,"0",STR_PAD_LEFT).":00:00";
				$_ID=$Account."_".$NowFind;
				$Reason=$_POST['Class'];
				$Venue=$_POST['Venue'];
				$Teams=$_POST['Teams'];
				if(isset($_POST[$NowFind])){//這一格被勾起來了，要登記!
					$sql_query_InsertBook="INSERT INTO Appointment(_ID,Account,DataTime,Reason,Venue,Teams,Status,Notice) VALUES ('$_ID','$Account','$DateTime','$Reason','$Venue','$Teams','審核中','')";
					mysqli_query($db_link,$sql_query_InsertBook) or die("查詢失敗");
				}
			}
		}
		echo"<script  language=\"JavaScript\">alert('登記完畢');location.href=\"book.php\";</script>";
	}
	else//不當路徑進入
		echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"index.php\";</script>";
		
?>