<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
	require("conn_mysql.php");//連線資料庫
	$FindPost=false;
	$sql_query_ChkRecord="SELECT * FROM Appointment where 1 order by `Status` ASC , `DataTime` ASC";//找尋現在的每一筆登記
	$Rst=mysqli_query($db_link,$sql_query_ChkRecord) or die("操作失敗");
	//審核中 通過! 未通過
	while($row=mysqli_fetch_array($Rst)){//每筆紀錄檢查
		
		if($row[2]>date("Y-m-d 00:00:00")){//只檢查今天以後的紀錄
			if(isset($_POST[$row[0]])){//檢查通過部分
				$row_Agree="UPDATE Appointment SET status=\"未通過\" where _ID=\"".$row[0]."\"";//把要通過那筆通過
				$Rst1=mysqli_query($db_link,$row_Agree) or die("操作失敗");//把要通過那筆通過
				echo"<script  language=\"JavaScript\">alert('預約取消完成');location.href=\"index.php\";</script>";
				$FindPost=true;
				break;//一次只做一筆，找到可跳出(理論上上面應該會跳轉了)
			}
		}
	}
	if($FindPost==false)//不當路徑進入
		echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"index.php\";</script>";
?>