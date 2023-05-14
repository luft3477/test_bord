<?php
session_start();
$u = htmlspecialchars($_POST['user'], ENT_QUOTES);
$p = htmlspecialchars($_POST['pass'], ENT_QUOTES);
require_once("db_init.php");
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ようこそ🦋試作掲示板🦋へ！</title>
    <link rel="stylesheet" type="text/css" href="g_login.css">
</head>
<body>

<div class="container">
    <?php
    $ps = $db->prepare("SELECT pas FROM table2 WHERE nam= :user");
    $ps->bindParam(':user', $u);
    $ps->execute();

    if ($ps->rowCount() > 0) {
        $r = $ps->fetch();
        if (password_verify($p, $r['pas'])) {
            $_SESSION['us'] = $u;
            ?>
            <h1>ようこそ🦋試作掲示板🦋へ！</h1>
            <p><a href="g.php">ホームへ</a></p>
            <?php
        } else {
            session_destroy();
            ?>
            <p class="error">パスワードが違います</p>
            <p><a href="g_login.php">ログイン画面へ戻る</a></p>
            <p><a href="register.html">アカウントをお持ちでない方は、こちらから登録できます</a></p>
            <?php
        }
    } else {
        session_destroy();
        ?>
        <p class="error">ユーザーが登録されていません</p>
        <p><a href="g_login.php">ログイン画面へ戻る</a></p>
        <p><a href="register.html">アカウントをお持ちでない方は、こちらから登録できます</a></p>
        <?php
    }
    ?>
</div>

</body>
</html>
