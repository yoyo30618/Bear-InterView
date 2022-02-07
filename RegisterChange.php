<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
	require("conn_mysql.php");//連線資料庫
	$FindRegister=false;
	$sql_query_ChkRegister="SELECT * FROM `AccountTable` WHERE `Status`=\"審核中\"";//找尋現在的每一筆登記
	$Rst=mysqli_query($db_link,$sql_query_ChkRegister) or die("操作失敗");
	//審核中 通過! 未通過
	while($row=mysqli_fetch_array($Rst)){//每筆紀錄檢查
		if(isset($_POST["Agree".$row[0]])){//通過某帳號申請
			$sql_query_Refuse="UPDATE AccountTable SET Status=\"學生\" where Account=\"".$row[0]."\"";
			$Rst1=mysqli_query($db_link,$sql_query_Refuse) or die("操作失敗");
			?>
			<script language=javascript> //為了讓跳轉回去可以回到同一頁
				document.write("<form action=\"RegisterStatus.php\" method=post name=\"form1\">");  //新增一個Form傳值回去
				document.write("<input type=\"hidden\" name=\"Pge\" value=<?php echo $_POST['Pge'];?>>");  //隱藏剛過來的頁碼 傳回去
				document.write("</form>");  
				document.form1.submit();  
			</script>  
			<?php
			break;
		}
		else if(isset($_POST["Refuse".$row[0]])) {//拒絕某帳號申請
			$sql_query_Refuse="UPDATE AccountTable SET Status=\"拒絕申請\" where Account=\"".$row[0]."\"";
			$Rst1=mysqli_query($db_link,$sql_query_Refuse) or die("操作失敗");
			?>
			<script language=javascript> //為了讓跳轉回去可以回到同一頁
				document.write("<form action=\"RegisterStatus.php\" method=post name=\"form1\">");  //新增一個Form傳值回去
				document.write("<input type=\"hidden\" name=\"Pge\" value=<?php echo $_POST['Pge'];?>>");  //隱藏剛過來的頁碼 傳回去
				document.write("</form>");  
				document.form1.submit();  
			</script>  
			<?php
			break;
		}
	}
	echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"index.php\";</script>";
?>