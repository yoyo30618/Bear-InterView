<html lang="tw">
    <?php
    
	    if(isset($_POST['Acc'])){//如果是由post進入
        ?>
            <script>
                function oAuth2($Acc) {
                    var URL = 'https://notify-bot.line.me/oauth/authorize?';
                    URL += 'response_type=code';
                    URL += '&client_id=PJQxgGfbencYHw2UilGRWG';
                    //URL += '&redirect_uri=http://127.0.0.1:8787/bct/';
                    URL += '&redirect_uri=http://algolab.nttu.edu.tw/Bear-InterView/CatchLineToken.php';
                    URL += '&scope=notify';
                    URL += '&state='+$Acc;
                    URL += '&response_mode=form_post';
                    window.location.href = URL;
                }
                oAuth2("<?php echo $_POST['Acc'];?>");
            </script>
        <?php
        }
        else//不當路徑進入
            echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"index.php\";</script>";
        ?>
</html>