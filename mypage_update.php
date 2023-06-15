<?php
mb_internal_encoding("utf8");

session_start();
try{
    $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
    }catch(PDOException $e){
        die("<p>申し訳ありません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>
        しばらくしてから再度ログインをしてください。</p>
        <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
    );
}

$pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");

$stmt = $pdo -> prepare("update login_mypage set name=:name,mail=:mail,password=:password,comments=:comments where id = :id");

$stmt -> bindValue(":id",$_SESSION['id']);
$stmt -> bindValue(":name",$_POST['name']);
$stmt -> bindValue(":mail",$_POST['mail']);
$stmt -> bindValue(":password",$_POST['password']);
$stmt -> bindValue(":comments",$_POST['comments']);

$stmt -> execute();

$stmt = $pdo -> prepare("select * from login_mypage where id = ?");

$stmt -> bindValue(1,$_SESSION['id']);
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


header('Location:mypage.php');
?>