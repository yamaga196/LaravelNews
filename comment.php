<!-- ヘッド -->
<?php
 require('head.php');
?>

<body class="body">
  
<!-- ヘッダー -->
  <?php
  require('header.php');
  ?>

<div class="margin-top"></div>

<h1><?php echo $_GET['title']; ?></h1>
<p><?php echo $_GET['text']; ?></p>

<div class="margin-top"></div>

<div class="margin-top"></div>
<p class="border"></p><br>

<?php

  //共通関数
  require('function.php');

  session_start();

  //メッセージを保存するファイルのパス設定
  define('FILENAME', './come.csv');

  //変数
  $data = '';
  $file_handle = '';
  $split_data = '';
  $message = array();
  $message_array = array();
  $count = (count(file(FILENAME))+1);

  if(!empty($_POST)){

    //変数に情報を代入
    $_SESSION['comment'] = $_POST['comment'];
    $comment = $_SESSION['comment'];
    $_SESSION['num'] = $_GET['num'];
    $num = $_SESSION['num'];

    //バリデーションチェック
      validRequiredcomment($comment, 'comment');
      validMaxgo($comment, 'comment');

    if(empty($err_msg)){
      
      //$file_handleにfopen(FILENAME, "a")を入れる
      //fopen(ファイルを開く)
      //"a"は書き出し用で開く
      if($file_handle = fopen(FILENAME, "a")){
        
        //書き込みデータを作成
        $data = $num."'".$_SESSION['comment']."'".$count."'"."\n";

        //fwriteで書き込み
        fwrite($file_handle, $data);

        //fcloseでファイルを閉じる
        fclose($file_handle);
      }
    }
  }

    //$file_handleにfopen(FILENAME, "r")を入れる
    //fopen(ファイルを開く)
    //"r"は読み込み
    if($file_handle = fopen(FILENAME,"r")){

      //whileは条件式がtrueだった場合に、処理を実行
      //fgets指定したファイルから内容を1行読み込む関数
      while($data = fgets($file_handle)){
        //preg_split関数は文字列を特定の文字で分割する関数
        $split_data = preg_split('/\'/', $data);

        //$messageにarray配列を入れる
        $message = array(
          'num' => $split_data[0],
          'comment' => $split_data[1],
        );

        //配列の先頭に要素を追加する関数
        array_unshift($message_array, $message);
      }

      //ファイルを閉じる
      fclose($file_handle);
    }

?>

<!-- エラーメッセージ -->
<?php if(!empty($_POST)){?>
  <?php if(!empty($err_msg['comment'])) echo $err_msg['comment']; ?>
<?php } ?>

<!-- 要素 を入れる-->
<div class="comment-form">
  <div class="comment-body">
    <form method="post" action="">
      <div class="text">
        <textarea name="comment"></textarea>
        <input type="submit" value="コメントを書く">
      </div>
    </form>
  </div>
  
  <!-- コメントを入れる -->
  <?php
  if(!empty($message_array)){
    foreach($message_array as $value){
      if(rtrim($value['num']) === $_GET['num']){
        ?>
    <div class="comment-color">
      <?php  echo $value['comment']; ?>
    </div>
    
    <?php
      }
    }
  }
  
  ?>

<div class="comment-a">
  <a href="index.php">投稿画面に戻る</a>
</div>
</div>

</body>
</html>