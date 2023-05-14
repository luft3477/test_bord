<HTML>
<HEAD>
  <META HTTP-EQUIV='Content-Type' CONTENT='text/html;charset=UTF-8'>
  <TITLE>ログイン画面</TITLE>
  <link rel="stylesheet" type="text/css" href="g_login.css">
</HEAD>
<BODY>
  <div class="container">
    <h1>🦋試作掲示板🦋へようこそ</h1>
    <?php
    if (isset($_COOKIE['gz_user'])){
        print "<p>" . $_COOKIE['gz_user'] .
              "さんは前回{$_COOKIE['gz_date']}に利用しています</p>";
        $gu = $_COOKIE['gz_user'];
    } else {
        print "<p>こんにちは！</p>";
        $gu="";
    }
    ?>
    <p>ログインしてください。</p>
    <form action="g_login2.php" method="post">
      <label>ユーザー名</label>
      <input type="text" name="user" size="30"><br>
      <label>パスワード</label>
      <input type="password" name="pass" size="30">
      <input type="submit" value="送信">
    </form>
    <p><a href="register.html">新規の方はこちらでサインアップできます。</a></p>
  </div>
</BODY>
</HTML>
