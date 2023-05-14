<?php
session_start();
?>

<HTML>
<HEAD>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<TITLE>ようこそ🦋試作掲示板🦋へ！</TITLE>
</HEAD>
<BODY>

<?php
if (isset($_SESSION["us"]) && $_SESSION["us"] != null){

    if (!empty($_POST['myn']) && !empty($_POST['mym'])){

        $my_nam = htmlspecialchars($_POST['myn'],ENT_QUOTES);
        $my_mes = htmlspecialchars($_POST['mym'],ENT_QUOTES);
        $ima = date('YmdHis');
        $fn = null;
        $file = $_FILES['myf'];
        if ($_FILES['myf']['size'] > 0 && 
            (($file['type'] == 'image/jpeg' || $file['type'] == 'image/png') 
            && (strtolower(mb_strrchr($file['name'], '.', FALSE)) == ".jpg"
            || strtolower(mb_strrchr($file['name'], '.', FALSE)) == ".png"))){

            if ($file['size'] > 1024*1024*5){
                unlink($file['tmp_name']);
?>
<P>アップするファイルのサイズは5MB以下にしてください</P>
<P><A HREF='g_up.php'>投稿画面に戻る</A></P>

<?php
            }else{
                //アップロードされた画像ファイルを移動
                $fn = $ima . $file['name'];
                move_uploaded_file($file['tmp_name'], '../gz_img/'.$fn);
                $motogazo = strtolower(mb_strrchr($file['name'], '.', FALSE)) == ".jpg" ? imagecreatefromjpeg("../gz_img/$fn") : imagecreatefrompng("../gz_img/$fn");
                list($w, $h) = getimagesize("../gz_img/$fn");
                $new_h = 200;
                $new_w = $w * 200 / $h;

                //サムネイルの作成
                $mythumb = imagecreatetruecolor($new_w, $new_h);
                imagecopyresized($mythumb, $motogazo, 0, 0, 0, 0,
                                 $new_w,$new_h,$w,$h);
                imagejpeg($mythumb, "../gz_img/thumb_$fn");

                //サムネイルの表示
                print "<P>" . $file['name'] . "のアップロードに成功！<BR>
                      <IMG SRC='../gz_img/thumb_$fn'></P>";
            }
        }

        //データベースに追加
        require_once("db_init.php");

        $ps = $db->prepare("INSERT INTO table1 (nam,mes,ope,gaz,dat)
                            VALUES (:v_n,:v_m,1,:v_g,:v_d)");
        $ps->bindParam(':v_n', $my_nam);
        $ps->bindParam(':v_m', $my_mes);
        $ps->bindParam(':v_g', $fn);
        $ps->bindParam(':v_d', $ima);
        $ps->execute();
        print "<A HREF=g.php>ホームに戻る</A>";
    }else{
    ?>
    
    <P>名前とメッセージを入力してください<BR>
    <A HREF='g_up.php'>再度アップロード</A></P>
    <?php
        }
    }else{
        session_destroy();
    ?>
       <P>ログインしてください。<BR>
              <A HREF='g_login.php'>ログイン</A></P>
    <?php
    }
    ?>
    </BODY>
    </HTML>
