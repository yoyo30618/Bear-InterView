<?php
	header("Content-Type:text/html;charset=utf-8");
	session_start();
	session_destroy();
	//清除cookie
	setcookie("Bear-Interview_Account",'',time()-1);
	setcookie("Bear-Interview_Islogin",'',time()-1);
	setcookie("Bear-Interview_Status",'',time()-1);
	header("Location:index.php"); 
	//確保重定向後,後續程式碼不會被執行 

	exit;
?>