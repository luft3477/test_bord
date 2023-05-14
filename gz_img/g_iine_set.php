<?php
session_start();
$u = htmlspecialchars($_POST['myn'], ENT_QUOTES);
$b = htmlspecialchars($_POST['myb'], ENT_QUOTES);
if (isset($_SESSION['us']) && $_SESSION['us'] != null  &&
          $_SESSION['tm'] >= time()-300){
   $_SESSION['tm']= time();
?>
<HTML>
<HEAD>
<META HTTP-EQUIV='Content-Type' CONTENT='text/html;charset=UTF-8'>
<TITLE>イイネを送信しました</TITLE>
</HEAD>
<?php
    require_once("db_init.php");
    $ps = $db->prepare("INSERT INTO table4 (ban,nam)
                        VALUES (:v_b, :v_n)");
	$ps->bindParam(':v_b', $b);
	$ps->bindParam(':v_n', $u);
	$ps->execute();
     print "<P>". $u . "さんが「イイネ!」と言いました<BR>
            <A HREF=g.php>一覧表示に戻る</A></P>";
}else{
    session_destroy();
    print "<P>ちゃんとログオンしてね！<BR>
           <A HREF='g_login.php'>ログオン</A></P>";
}
?>
</BODY>
</HTML>
