<?php
session_start();
if(isset($_SESSION['id'])){
    header("Location:mypage.php");
}
?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>

    <body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="login"><a href="login.php">ログイン</a></div>
    </header>

    <main>
        <div class="box">
        <form action="mypage.php" method="post">
        <div class="addpass">
        <div class="address">
        <label>メールアドレス</label><br>
        <input type="text" class="formbox" size="40" name="mail" 
        value="<?php if(!empty($_COOKIE['check'])){echo $_COOKIE['mail'];}?>">
        </div>
        <div class="pass">
        <label>パスワード</label><br>
        <input type="password" class="formbox" size="40" name="password" 
        value="<?php if(!empty($_COOKIE['check'])){echo $_COOKIE['password'];}?>">
        </div>
        </div>
        <div class="check">
        <label><input type="checkbox" name="check" 
        <?php if(isset($_COOKIE['check'])){echo "checked='checked'";}?>> ログイン状態を保持する</label>
        </div>
        <div class="lo">
            <input type="submit" value="ログイン" class="login_button" size="35" name="login">  
        </div>    
        </form> 
        </div>

    </main>
    <footer>
    © 2018 InterNous.inc. All rights reserved
    </footer>
    </body>
</html>