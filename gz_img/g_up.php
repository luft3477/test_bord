<?php
session_start();
?>

<HTML>
<HEAD>
<META HTTP EQUIV='Content-Type' CONTENT='text/html;charset=UTF-8'>
<TITLE>ようこそ🦋試作掲示板🦋へ！</TITLE>
<LINK REL='stylesheet' TYPE='text/css' HREF='g_up.css'>
</HEAD>
<BODY>
<P STYLE='color: red'>🦋試作掲示板🦋</P>

<?php
if (isset($_SESSION['us']) && $_SESSION['us'] != null){
?>

<P>どんなことを投稿しますか?</P>
<FORM ENCTYPE = 'multipart/form-data' ACTION = 'g_up_set.php' 
      METHOD = 'post'>
    名前<br>
    <INPUT TYPE='text' NAME='myn'><br>
    メッセージ<br>
    <TEXTAREA NAME='mym' ROWS='10' COLS=70'></TEXTAREA><br>
    <INPUT TYPE = 'file' NAME='myf'>
    <P>>投稿できるのは5MBまでのJPEGまたはPNG画像です。<br>
    ※現在は名前・メッセージの入力と画像選択の両方をしないとホームへ投稿することができません。
    </P>
    <INPUT TYPE='submit' VALUE='投稿する'>
</FORM>
<P><A HREF=g.php>🦋ホームに戻る🦋</A></P>

<?php
}else{
     session_destroy();
     print "<P>ログインしてください<br>
            <A HREF='g_login.php'>ログイン</A></P>";
}
?>
</BODY>
</HTML>
