<?php
session_start();
?>

<HTML>
<HEAD>
<META HTTP EQUIV='Content-Type' CONTENT='text/html;charset=UTF-8'>
<TITLE>🦋試作掲示板🦋</TITLE>
<link rel="stylesheet" type="text/css" href="g.css">
</HEAD>
<BODY>
<?php
if (isset($_SESSION['us']) && $_SESSION['us'] != null){
?>
<P STYLE='color: red'>🦋試作掲示板🦋</P>
<DIV id='hidari'>
    <P><A HREF='g_up.php'>投稿する</A><BR>
    <A HREF='g_logout.php'>ログアウト</A></P>
</DIV>


<?php
    require_once("db_init.php");
    $ps = $db->query("SELECT * FROM table1
                      WHERE ope=1 ORDER BY ban DESC");
    while ($r = $ps->fetch()){
        $tg = $r['gaz'];
        $tb = $r['ban'];
        $ii = null;
        $ps_ii = $db->query("SELECT DISTINCT * FROM table4
                             WHERE ban = $tb");
        $coun_iine = 0;
        while ($r_ii = $ps_ii->fetch()){
            $ii = $ii . " " . $r_ii['nam'];
            $coun_iine++;
        }
        print "<DIV ID='box'>{$r['ban']}【投稿者：{$r['nam']}】{$r['dat']}
               <P CLASS='iine'><A HREF=g_iine.php?tran_b=$tb>いいね</A>
               ($coun_iine):$ii" . "</P><BR>" . nl2br($r['mes']) .
               "<BR><A HREF='../gz_img/$tg' TARGET='_blank'>
               <IMG SRC='../gz_img/thumb_$tg'></A><BR>
               <P CLASS='com'><A HREF='g_com.php?sn=$tb'>
               コメント</A></P>";
        $ps_com = $db->query("SELECT * FROM table3 WHERE ban = $tb");
        $coun = 1;
        while ($r_com = $ps_com->fetch()){
            print "<P CLASS = 'com'>●投稿コメント{$coun}<BR>
                  【{$r_com['nam']}さんのメッセージ】{$r_com['dat']}<BR>"
                   . nl2br($r_com['com']) . "</P>";
            $coun++;
        }
        print "</P></DIV>";
    }
    print "</DIV><DIV id='hidari'>
          <A HREF='g_up.php'>投稿する</A>
          <P><A HREF='g_logout.php'>ログアウト</A></P></DIV>";
}else{
   session_destroy();
   print "<P>ログインしてください<BR>
         <A HREF='g_login.php'>ログイン</A></P>";
}
?>
</BODY>
</HTML>