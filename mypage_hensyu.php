<?php
mb_internal_encoding("utf8");

session_start();

if(empty($_POST['from_center'])){
    header('Location:login_error.php');
}
$image_path = "./image/".$_SESSION['picture'];
?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="mypage.css">
    </head>
    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="logout"><a href="log_out.php">ログアウト</a></div>
        </header>
    <main>
        <form action="mypage_update.php" method="post" enctype="multipart/form-data">
            <div class="form_contents">
                <h2>会員情報</h2>
                <div class="hello">こんにちは！　<?php echo $_SESSION['name'];?>さん</div>
                <div class="pic">
                    <img src="<?php echo $image_path;?>">
                </div>
                <div class="info">
                    <div class="shimei">氏名：
                    <input type="text" class="formbox" size="30" name="name" value="<?php echo $_SESSION['name'];?>">
                    </div><br>
                    <div class="me-ru">メール：
                    <input type="text" class="formbox" size="30" name="mail" value="<?php echo $_SESSION['mail'];?>">
                    </div><br>
                    <div class="pasu">パスワード：
                    <input type="text" class="formbox" size="30" name="password" value="<?php echo $_SESSION['password'];?>">
                    </div><br>
                </div>
                <div class="comme">
                    <textarea rows="5" cols="70" name="comments" ><?php echo $_SESSION['comments'];?></textarea>
                </div>
                <div class="edit">
                    <input type="submit" class="edit_button" size="35" value="この内容に変更する">
                </div>
            </div>
            
        </form>
    </main>
    <footer>
    © 2018 InterNous.inc. All rights reserved
    </footer>

    </body>
</html>