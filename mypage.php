<?php
mb_internal_encoding("utf8");
session_start();

if(empty($_SESSION['id'])){

try{
$pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
}catch(PDOException $e){
    die("<p>申し訳ありません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>
    しばらくしてから再度ログインをしてください。</p>
    <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
);
}

$mail1 = $_POST['mail'];
$pass1 = $_POST['password'];

$stmt = $pdo -> prepare("select * from login_mypage where mail = ? and password = ?");

$stmt -> bindValue(1,$mail1);
$stmt -> bindValue(2,$pass1);
$stmt -> execute();

$pdo = NULL;

$result = $stmt -> fetchAll();
foreach($result as $row){
    $rowid = $row['id'];
    $rowname = $row["name"];
    $rowmail = $row["mail"];
    $rowpass = $row["password"];
    $rowpic = $row["picture"];
    $rowcome = $row["comments"];
    $_SESSION['id'] = $rowid;
    $_SESSION['name'] = $rowname;
    $_SESSION['mail'] = $rowmail;
    $_SESSION['password'] = $rowpass;
    $_SESSION['picture'] = $rowpic;
    $_SESSION['comments'] = $rowcome;
}

if(empty($_SESSION['mail']) || empty($_SESSION['password'])){
    header('Location:login_error.php');
}

if(!empty($_POST['check'])){
    $_SESSION['check'] = $_POST['check'];
}
}

if(!empty($_SESSION['id']) && !empty($_SESSION['check'])){
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('check',$_SESSION['check'],time()+60*60*24*7);
}else if(empty($_SESSION['check'])){
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('check','',time()-1);
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
        <form action="mypage_hensyu.php" method="post" class="form_center">
            <input type="hidden" value="<?php echo rand(1,10)?>" name="from_center">
            <div class="form_contents">
                <h2>会員情報</h2>
                <div class="hello">こんにちは！　<?php echo $_SESSION['name'];?>さん</div>
                <div class="pic">
                    <img src="<?php echo $image_path;?>">
                </div>
                <div class="info">
                    <div class="shimei">氏名：<?php echo $_SESSION['name'];?></div><br>
                    <div class="me-ru">メール：<?php echo $_SESSION['mail'];?></div><br>
                    <div class="pasu">パスワード：<?php echo $_SESSION['password'];?></div><br>
                </div>
                <div class="comme">
                    <label><?php echo $_SESSION['comments'];?></label>
                </div>
                <div class="edit">
                    <input type="submit" class="edit_button" size="35" value="編集する">
                </div>
            </div>
            
        </form>
    </main>
    <footer>
    © 2018 InterNous.inc. All rights reserved
    </footer>
    </body>
</html>