<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
	session_destroy();//銷毀session
	//清除cookie
	setcookie("Bear-Interview_Account",'',time()-1);
	setcookie("Bear-Interview_Islogin",'',time()-1);
	setcookie("Bear-Interview_Status",'',time()-1);
	header("Location:index.php"); 
	//確保重定向後,後續程式碼不會被執行 
	exit;
?>