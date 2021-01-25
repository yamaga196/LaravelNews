<?php

//共通関数
require('function.php');

//post送信されていた場合
if(!empty($_POST)){

  //変数にユーザー情報を代入
  $title = $_POST['title'];
  $text = $_POST['text'];

  //未入力チェック　タイトル
  validRequiredtitle($title, 'title');
  //未入力チェック　テキスト
  validRequiredtext($text, 'text');
  //30文字以下をチェック
  validMaxsan($title, 'title');

  //==========================
  //投稿のデータベース
  //==========================
  if(empty($err_msg)){

    try{
      //DBへ接続
      $dbh = dbConnect();
      //SQL文作成
      $sql = 'INSERT INTO kizi (title,text) VALUES (:title,:text)';
      $data = array(':title' => $title, ':text' => $text);

      //クエリ実行
      queryPost($dbh, $sql, $data);

      header('Location: ' . $_SERVER['SCRIPT_NAME']); //同じページへ

    }catch (Exception $e){
      $err_msg['title'] = valid_title;
      $err_msg['text'] = valid_kizi;
    }
  }
}

//=================================
//投稿のデータベースを検索
//=================================
  if(isset($_POST)){

    try{
      //DBへ接続
      $dbh = dbConnect();
      //SQL文作成
      $sql = 'SELECT * FROM kizi ORDER BY id DESC';

      $stmt = $dbh->query($sql);

    }catch(Exception $e){
      $err_msg['title'] = valid_title;
      $err_msg['text'] = valid_kizi;
    }

  }

?>

<!-- ヘッド -->
<?php
  require('head.php');
?>

<body class="body">
  
  <!-- ヘッダー -->
  <?php
    require('header.php');
  ?>

  <!-- h1 -->
  <h1 class="h1">さぁ、最新のニュースをシェアしましょう</h1>

  <!-- エラーメッセージ -->
  <?php if(!empty($_POST)){ ?>
    <?php if(!empty($err_msg['title'])) echo $err_msg['title']; ?><br>
    <?php if(!empty($err_msg['text'])) echo $err_msg['text']; ?>
  <?php } ?>

  <!-- 要素 を入れる-->
  <div class="input-matome">
    <form method="post" onsubmit="return submitChk()">
      <div class="input-main">
        <div class="margin-frist">
          <p>タイトル：</p><input type="text" name="title">
        </div>
        <div class="margin-second">
          <p>　　記事：</p><textarea name="text"></textarea>
        </div>
      </div>
      <input type="submit" name="submit" value="投稿">
    </form>
    </div>

    <form action="">

    <div class="comment-matome">
      <?php if(!empty($stmt)): ?>
        <?php foreach($stmt as $row): ?>
          
          <div class="comment-text">
            <p class="border"></p>
            <h2><?php echo $row['title']; ?></h2>
            <p class="text"><?php echo $row['text']; ?></p>
            <a href="comment.php?id=<?php echo $row['id']; ?>">記事全文・コメントを見る</a>
          </div>

        <?php endforeach; ?>
      <?php endif; ?>
    </div>
          
    </form>


</body>
</html>