<?php
$db = new pdo("mysql:host=localhost;dbname=db","root","root");

$pas = htmlspecialchars($_POST['pass'], ENT_QUOTES);
$nam = htmlspecialchars($_POST['name'], ENT_QUOTES);


$hashed_pas = password_hash($pas, PASSWORD_DEFAULT);

$ps = $db->prepare("INSERT INTO table2 (pas, nam) VALUES (:pas, :nam)");
$ps->bindParam(':pas', $hashed_pas);
$ps->bindParam(':nam', $nam);
$ps->execute();

print "<p>ユーザー登録が完了しました。</p>";
print "<p><a href=\"g_login.php\">ログイン画面に戻る</a></p>";
?>
