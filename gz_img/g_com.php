<?php
session_start();
$u = $_GET['sn'];
?>
<HTML>
<HEAD>
<META HTTP-EQUIV='Content-Type' CONTENT='text/html;charset=UTF-8'>
<TITLE>コメントを入力してください</TITLE>
</HEAD>
<BODY>
<?php
if (isset($_SESSION['us']) && $_SESSION['us'] != null && 
        $_SESSION['tm'] >= time()-300){
    $_SESSION['tm'] = time();
?>
<P><?php print $u; ?>の画像に対するコメント</P>

<FORM ACTION = "gz_com_set.php" METHOD="post">
   名前<BR>
   <INPUT TYPE = "text" NAME = "myn" 
          VALUE = "<?php print $_SESSION['us']; ?>"><BR>
   コメント<BR>
   <TEXTAREA NAME = "myc" ROWS = "10" COLS = "70"></TEXTAREA><BR>
   <INPUT TYPE = "hidden" NAME = "myb" VALUE = "<?php print $u; ?>">
   <INPUT TYPE = "submit" VALUE = "送信">
</FORM>
<P><A HREF = g.php>ホームに戻る</A></P>
<?php
}else{
    session_destroy();
    print "<P>ログインしてください<BR>
           <A HREF='g_login.php'>ログイン</A></P>";
}
?>
</BODY>
</HTML>