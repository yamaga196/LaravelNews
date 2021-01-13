<?php
session_start();
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

<div class="margin-top"></div>
<?php
//メッセージを保存するファイルのパス設定
define('FILENAME', './text.txt');

$num = count(file(FILENAME));
    $num++;

//$file_handleにfopen(FILENAME, "r")を入れる
  //fopen(ファイルを開く)
  //"r"は読み込み
  if($file_handle = fopen(FILENAME,"r")){
    
    //whileは条件式がtrueだった場合に、処理を実行
    //fgets指定したファイルから内容を1行読み込む関数
    while($data = fgets($file_handle)){
     if($num === $num){
       echo $_SESSION['title'];
       echo $_SESSION['text'];
     }

    }
    
    //ファイルを閉じる
    fclose($file_handle);
  }

 ?><br>
<div class="margin-top"></div>

<div class="margin-top"></div>
<p class="border"></p><br>


  <a href="index.php">投稿画面に戻る</a>

</body>
</html>