<?php

//メッセージを保存するファイルのパス設定
define('FILENAME', './message.txt');

//変数の初期化
$data = null;
$file_handle = null;
$split_data = null;
$message = array();
$message_array = array();

//$_POST['submit']が空じゃなければ
if(!empty($_POST['submit'])){
  //$file_handleにfopen(FILENAME, "a")を入れる
  //fopen(ファイルを開く)
  //"a"は書き出し用で開く
  if($file_handle = fopen(FILENAME, "a")){

    //書き込みデータを作成
    $data = "'".$_POST['title']."','".$_POST['text']."'"."\n";

    //fwriteで書き込み
    fwrite($file_handle, $data);

    //fcloseでファイルを閉じる
    fclose($file_handle);
  }
}

//$file_handleにfopen(FILENAME, "r")を入れる
//fopen(ファイルを開く)
//"r"は読み込み
if($file_handle = fopen(FILENAME,"r")){

  //whileは条件式がtrueだった場合に、処理を実行
  while($data = fgets($file_handle)){
    //preg_split関数は文字列を特定の文字で分割する関数
    $split_data = preg_split('/\'/', $data);

    //$messageにarray配列を入れる
    $message = array(
      'title' => $split_data[1],
      'text' => $split_data[3],
    );
    //配列の先頭に要素を追加する関数
    array_unshift($message_array, $message);
  }

  //ファイルを閉じる
  fclose($file_handle);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Laravel-News</title>
</head>
<body class="body">

  <!--　ヘッダー　-->
  <div class="header">
    <header>Laravel News</header>
  </div>
  
  <!--　h１　-->
  <h1 class="h1">さぁ、最新のニュースをシェアしましょう</h1>

  <!-- 要素 を入れる-->
  <div class="input-matome">
    <form action="" method="POST">
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

  <!-- 要素を取り入れる -->
  <div class="comment-matome">

    <!-- $message_arrayが空じゃなければ -->
    <?php if(!empty($message_array)){ ?>

    <!-- foreachは、配列＋繰り返し文をしたようなもの -->
    <!-- 一次元配列 -->
    <!-- ($message_array as $value)で$message_arrayの中に入っている要素を$valueに代入する -->
    <?php foreach($message_array as $value){ ?>

    <div class="comment-text">
      <p class="border"></p>

      <!-- 96行目で$valueに要素を入れているので、$valueの中にある['title']を呼び出す -->
      <h2><?php echo $value['title']; ?></h2>

      <!-- 96行目で$valueに要素を入れているので、$valueの中にある['text']を呼び出す -->
      <p><?php echo $value['text']; ?></p>

      <!-- comment.phpに飛ぶ -->
      <a href="comment.php">記事全文・コメントを見る</a>

    </div>
    <?php } ?>
    <?php } ?>
  </div>


</body>
</html>