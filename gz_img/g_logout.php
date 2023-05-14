<?php
session_start();

$_SESSION = array();
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 3600, '/');
}
session_destroy();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ログアウト</title>
</head>
<body>
<p STYLE = 'color: red'>🦋試作掲示板🦋</P>
<p>ログアウト完了<br>
<a HREF = 'g_login.php'>再度ログインはこちら</a></p>
</body>
</html>
