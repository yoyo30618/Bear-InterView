<?php
	header("Content-Type:text/html;charset=utf-8");
	session_start();
	if(isset($_POST['ChangePWD']))
	{
		$NewPassword1 = trim($_POST['NewPassword1']);
		$NewPassword2 = trim($_POST['NewPassword2']);
		if(($NewPassword1=='')||($NewPassword2==''))
			echo"<script  language=\"JavaScript\">alert('密碼不能為空');location.href=\"login.php\";</script>";
		require("conn_mysql.php");
		if($NewPassword1!=$NewPassword2)
			echo"<script  language=\"JavaScript\">alert('兩次密碼輸入不一致');location.href=\"login.php\";</script>";
		else{
			$Account=$_SESSION['Bear-Interview_Account'];
			$sql_query_ChgPwd="UPDATE `AccountTable` SET `Password`=\"$NewPassword1\" WHERE `Account`=\"$Account\"";
			$Rst=mysqli_query($db_link,$sql_query_ChgPwd) or die("操作失敗");
			if($Rst){
				session_destroy();
				//清除cookie
				setcookie("Bear-Interview_Account",'',time()-1);
				setcookie("Bear-Interview_Islogin",'',time()-1);
				setcookie("Bear-Interview_Status",'',time()-1);
				echo"<script  language=\"JavaScript\">alert('密碼修改完畢，請重新登入！');location.href=\"login.php\";</script>";
			}
			else{
				echo"<script  language=\"JavaScript\">alert('操作可能失敗，請重新確認！');location.href=\"status.php\";</script>";
			}
		}
	}
	else
		echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"login.php\";</script>";
		
?>