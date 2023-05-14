<?php
session_start();
$u = htmlspecialchars($_POST['myn'], ENT_QUOTES);
$p = htmlspecialchars($_POST['myc'], ENT_QUOTES);
$b = htmlspecialchars($_POST['myb'], ENT_QUOTES);
?>
<HTML>
<HEAD>
<META HTTP-EQUIV='Content-Type' CONTENT='text/html;charset=UTF-8'>
<TITLE>コメントを書き込みました</TITLE>
</HEAD>
<BODY STYLE='background-color:lightblue'>
<?php
if (isset($_SESSION['us']) && $_SESSION['us'] != null && 
        $_SESSION['tm'] >= time()-300){
    $_SESSION['tm'] = time();
?>
<P><?php print $u; ?>さんコメント</P>
<P>【コメント】<BR><?php print $p;?></P>
<A HREF='g.php'>ホームに戻ります</A>
<?php
    require_once("db_init.php");
    $ima = date('YmdHis');
    $ps = $db->prepare("INSERT INTO table3 (ban, com, nam, dat)
                        VALUES (:v_b, :v_c, :v_n,:v_d)");
    $ps->bindParam(':v_b', $b);
    $ps->bindParam(':v_c', $p);
    $ps->bindParam(':v_n', $u);
    $ps->bindParam(':v_d', $ima);
    $ps->execute();
}else{
    session_destroy();
    print "<P>ログインしてください<BR>
           <A HREF='g_login.php'>ログイン</A></P>";
}
?>
</BODY>
</HTML>
