<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
	require("conn_mysql.php");
	if(isset($_POST['code']))//如果是由post進入
	{
		$Token=$_POST['code'];
		$row_UpdateLine="UPDATE AccountTable SET LineToken=\"".$_POST['code']."\" where Account=\"".$_POST['state']."\"";//把要通過那筆通過
		$Rst1=mysqli_query($db_link,$row_UpdateLine) or die($row_UpdateLine);//把要通過那筆通過
		/*底下為LINE NOTIFY的部分，傳送LINE確認*/
			$headers = array(
				'Content-Type: multipart/form-data',
				'Authorization: Bearer '.$Token
			);//宣告一下表頭與要傳送的TOKEN(權杖)，這樣才知道要傳給哪個BOT
			$message = array(
				'message' => '晤談系統2.0綁定成功通知'
			);//宣告一下訊息內容
			$ch = curl_init();
			curl_setopt($ch , CURLOPT_URL , "https://notify-api.line.me/api/notify");//宣告要傳遞的網址
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);//要傳遞的表頭
			curl_setopt($ch, CURLOPT_POST, true);//POST方式傳遞
			curl_setopt($ch, CURLOPT_POSTFIELDS, $message);//要傳遞的訊息內容
			$result = curl_exec($ch);//把容器拋出去~!
			curl_close($ch);
		/*以上為LINE NOTIFY的部分，傳送LINE確認*/
		//echo"<script  language=\"JavaScript\">alert('Line綁定完成，已傳送測試訊息');location.href=\"index.php\";</script>";
	}
	else//不當路徑進入
		echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"index.php\";</script>";
		
?>