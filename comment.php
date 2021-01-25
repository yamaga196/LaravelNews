<?php

//idを取得
$id = $_GET['id'];

//共通関数
require('function.php');

if(!empty($_POST)){

  //変数にユーザー情報を代入
  $comment = $_POST['comment'];

  //未入力チェック　コメント
  validRequiredcomment($comment, 'comment');
  //50文字以下をチェック
  validMaxgo($comment, 'comment');

//===============================
// コメントのデータベースの挿入
//===============================
  if(empty($err_msg)){

    try{
      //DBへ接続
      $dbh = dbConnect();
      //SQL文作成
      $sql = 'INSERT INTO comments (kizi_id, comment) VALUES (:kizi_id,:comment)';
      $data = array(':kizi_id' => $id, ':comment' => $comment);

      //クエリ実行
      queryPost($dbh, $sql, $data);

      header('Location:' . $_SERVER['REQUEST_URI']);

    }catch(Exception $e){
      $err_msg['comment'] = validRequiredcomment;
    }
  }
}

//=============================
//コメントのデータベースを削除
//=============================
if(isset($_POST['del'])){

  //変数にユーザー情報を代入
  $del = $_POST['del'];
  //削除ボタンが押された場合
  try{
    //DBへ接続
    $dbh = dbConnect();
    //SQL文作成
    $sql = 'DELETE FROM comments WHERE id = :del';
    $data = array(':del' => $del);
    //クエリ実行
    queryPost($dbh, $sql, $data);

    header('Location:' . $_SERVER['REQUEST_URI']);
  }catch(Exception $e){
    $err_msg['comment'] = validRequiredcomment;
  }
}

//==============================
//コメントのデータベースの検索
//==============================
  if(isset($_POST)){

    try{
      //DBへ接続
      $dbh = dbConnect();
      //SQL文作成
      $sql = 'SELECT * FROM comments';

      $stmtcomment = $dbh->query($sql);

    }catch(Exception $e){
      $err_msg['comment'] = validRequiredcomment;
    }
  }

//================================
//記事のデータベースの検索
//================================
if(isset($_POST)){

  try{
    //DBへ接続
    $dbh = dbConnect();
    //SQL文作成
    $sql = 'SELECT * FROM kizi';

    $stmt = $dbh->query($sql);
  }catch(Exception $e){
    $err_msg['comment'] = validRequiredcomment;
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

  <!-- タイトルと記事を表示 -->
  <div class="margin-top"></div>
  <?php if(!empty($stmt)): ?>
    <?php foreach($stmt as $row): ?>
      <?php if(rtrim($row['id'] === $id)): ?>
        <h2><?php echo $row['title']; ?></h2>
        <p class="text"><?php echo $row['text']; ?></p>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endif; ?>
  <p class="border"></p>
  

  <!-- エラーメッセージ -->
  <?php if(!empty($_POST)): ?>
    <?php if(!empty($err_msg['comment'])) echo $err_msg['comment']; ?>
  <?php endif; ?>

  <!-- コメントフォーム -->
  <div class="comment-form">
    <div class="comment-body">
      <form method="post">
        <div class="text">
          <textarea name="comment"></textarea>
          <input type="submit" value="コメントを書く">
        </div>
      </form>
    </div>
  </div>

  <!-- コメントを表示 -->
  <div class="comment-delete">
    <form method="post">
      <?php if(!empty($stmtcomment)): ?>
        <?php foreach($stmtcomment as $commentrow): ?>
          <?php if(rtrim($commentrow['kizi_id'] === $id)): ?>
            <div class="comment-color">
              <?php echo $commentrow['comment']; ?>
                <input type="hidden" name="del" value="<?php echo $commentrow['id']; ?>">
                <input type="submit" value="コメントを消す">
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </form>
  </div>

  <!-- aタグ -->
  <div class="comment-a">
    <a href="kizi.php">投稿画面に戻る</a>
  </div>
</body>
</html>