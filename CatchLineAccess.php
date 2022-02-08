<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
	require("conn_mysql.php");
	if(isset($_POST['code']))//如果是由post進入
	{
		$AccessCode=$_POST['code'];
		/*成功將Line Access Code轉為Token*/
			$headers = array(
				'Content-Type: application/x-www-form-urlencoded',
			);
			$message = "grant_type=authorization_code&code=".$AccessCode."&client_id=PJQxgGfbencYHw2UilGRWG&client_secret=waTUnNDXWHk6JZJ0juw7rbVrIfhmyWdXijIbUWYHQy8&redirect_uri=http://algolab.nttu.edu.tw/Bear-InterView/CatchLineAccess.php";//宣告一下訊息內容
			$ch = curl_init();
			curl_setopt($ch , CURLOPT_URL , "https://notify-bot.line.me/oauth/token");//宣告要傳遞的網址
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);//要傳遞的表頭
			curl_setopt($ch, CURLOPT_POST, true);//POST方式傳遞
			curl_setopt($ch, CURLOPT_POSTFIELDS, $message);//要傳遞的訊息內容
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//要傳遞的訊息內容
			$result = curl_exec($ch);//把容器拋出去~!
			curl_close($ch);
			$x=(json_decode ($result));
			$LineToken=$x->{'access_token'};
		/*成功將Line Access Code轉為Token*/
		$row_UpdateLine="UPDATE AccountTable SET LineToken=\"".$LineToken."\" where Account=\"".$_POST['state']."\"";//把要通過那筆通過
		$Rst1=mysqli_query($db_link,$row_UpdateLine) or die($row_UpdateLine);//把要通過那筆通過
		
		/*發送測試訊息*/
		/*底下為LINE NOTIFY的部分，傳送LINE確認*/
		$headers = array(
			'Content-Type: multipart/form-data',
			'Authorization: Bearer '.$LineToken
		);//宣告一下表頭與要傳送的TOKEN(權杖)，這樣才知道要傳給哪個BOT
		$message = array(
			'message' => '晤談系統2.0已經註冊與Line綁定'
		);//宣告一下訊息內容

		//一些關於curl的設定(有點類似網頁版本的CMD?)
		$ch = curl_init();//想像成宣告一個空容器?
		curl_setopt($ch , CURLOPT_URL , "https://notify-api.line.me/api/notify");//宣告要傳遞的網址
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);//要傳遞的表頭
		curl_setopt($ch, CURLOPT_POST, true);//POST方式傳遞
		curl_setopt($ch, CURLOPT_POSTFIELDS, $message);//要傳遞的訊息內容
		$result = curl_exec($ch);//把容器拋出去~!
		curl_close($ch);
		/*底下為LINE NOTIFY的部分，傳送LINE確認*/
		
		echo"<script  language=\"JavaScript\">alert('Line綁定完成，請至Line檢查是否收到測試訊息');location.href=\"index.php\";</script>";	
	}
	else//不當路徑進入
		echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"index.php\";</script>";	
?>