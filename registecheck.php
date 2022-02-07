<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
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
		echo"<script  language=\"JavaScript\">alert('註冊完畢');location.href=\"index.php\";</script>";
	}
	else//不當路徑進入
		echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"index.php\";</script>";
		
?>