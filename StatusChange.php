<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
	require("conn_mysql.php");//連線資料庫
	$FindPost=false;
	$sql_query_ChkRecord="SELECT * FROM Appointment where 1 order by `Status` ASC , `DataTime` ASC";//找尋現在的每一筆登記
	$Rst=mysqli_query($db_link,$sql_query_ChkRecord) or die("操作失敗");
	while($row=mysqli_fetch_array($Rst)){//每筆紀錄檢查
		
		if(isset($_POST["Agree".$row[0]])){/*檢查通過部分*/
			$FindPost=true;
			//資料庫寫入通過
			
			?>
			<script language=javascript> //為了讓跳轉回去可以回到同一頁
				document.write("<form action=\"RecordStatus.php\" method=post name=\"form1\">");  //新增一個Form傳值回去
				document.write("<input type=\"hidden\" name=\"Pge\" value=<?php echo $_POST['Pge'];?>>");  //隱藏剛過來的頁碼 傳回去
				document.write("</form>");  
				document.form1.submit();  
			</script>  
			<?php
			break;//一次只做一筆，找到可跳出(理論上上面應該會跳轉了)
		}
		else if(isset($_POST["Refuse".$row[0]])){/*檢查拒絕部分*/
			$FindPost=true;0
			//資料庫寫入拒絕
			
			
			?>
			<script language=javascript> //為了讓跳轉回去可以回到同一頁
				document.write("<form action=\"RecordStatus.php\" method=post name=\"form1\">");  //新增一個Form傳值回去
				document.write("<input type=\"hidden\" name=\"Pge\" value=<?php echo $_POST['Pge'];?>>");  //隱藏剛過來的頁碼 傳回去
				document.write("</form>");  
				document.form1.submit();  
			</script>  
			<?php
			break;//一次只做一筆，找到可跳出(理論上上面應該會跳轉了)
		}
		else if(isset($_POST["Repent".$row[0]])){/*檢查反悔部分*/
			$FindPost=true;
			//資料庫寫入反悔
			
			
			?>
			<script language=javascript> //為了讓跳轉回去可以回到同一頁
				document.write("<form action=\"RecordStatus.php\" method=post name=\"form1\">");  //新增一個Form傳值回去
				document.write("<input type=\"hidden\" name=\"Pge\" value=<?php echo $_POST['Pge'];?>>");  //隱藏剛過來的頁碼 傳回去
				document.write("</form>");  
				document.form1.submit();  
			</script>  
			<?php
			break;//一次只做一筆，找到可跳出(理論上上面應該會跳轉了)
		}
	}
	if($FindPost==false)//不當路徑進入
		echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"index.php\";</script>";
?>