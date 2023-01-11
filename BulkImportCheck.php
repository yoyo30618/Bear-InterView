<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	if(isset($_POST['BulkImport']))//如果是由post進入
	{
		if(strtotime($_POST['StartDate'])>strtotime($_POST['EndDate'])){
			echo"<script  language=\"JavaScript\">alert('起始日期不得大於結束日期');location.href=\"BulkImport.php\";</script>";
		}
		else if($_POST['StartTime']>=$_POST['EndTime']){
			echo"<script  language=\"JavaScript\">alert('起始時段不得大於/等於結束時段');location.href=\"BulkImport.php\";</script>";
		}
		else{
			require("conn_mysql.php");
							
			$tpday=strtotime($_POST['StartDate']);
			$res="";
			while($tpday<=strtotime($_POST['EndDate'])){
				$nowAdd=date("Y-m-d",$tpday);
				//檢查本日是否被預約
				for($hour=$_POST['StartTime'];$hour<$_POST['EndTime'];$hour++){
					$sql_Find_IsUsed="SELECT * FROM `Appointment` WHERE `DataTime` like '".$nowAdd." ".str_pad($hour,2,"0",STR_PAD_LEFT)."%' AND `Status`='通過!'";
					$Find_IsUsed_result=mysqli_query($db_link,$sql_Find_IsUsed) or die("查詢失敗");
					$Find=false;

					while($row=mysqli_fetch_array($Find_IsUsed_result))
					{
						$Find=true;
					}
					if($Find==true){
						$res=$res.$nowAdd." ".str_pad($hour,2,"0",STR_PAD_LEFT)."此時段有人!";
					}
					else{
						$_ID=$_POST['Account']."_".date("Ymd",$tpday)."_".str_pad($hour-7,2,"0",STR_PAD_LEFT);
						$Account=$_POST['Account'];
						$DateTime=$nowAdd." ".str_pad($hour,2,"0",STR_PAD_LEFT).":00:00";
						$Reason=$_POST['Reason'];
						$Venue=$_POST['Venue'];
						$Teams=$_POST['Teams'];
						$sql_query_InsertBook="INSERT INTO Appointment(_ID,Account,DataTime,Reason,Venue,Teams,Status,Notice) VALUES ";
						$sql_query_InsertBook=$sql_query_InsertBook."('$_ID','$Account','$DateTime','$Reason','$Venue','$Teams','通過!','');";
						mysqli_query($db_link,$sql_query_InsertBook) or die("查詢失敗");
					}
				}
				$tpday=strtotime('+7 days',$tpday);
			}
			if($res==""){
				$res="完成";
			}
			echo"<script  language=\"JavaScript\">alert('$res');location.href=\"BulkImport.php\";</script>";
		}
	}
	else//不當路徑進入
		echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"index.php\";</script>";
		
?>