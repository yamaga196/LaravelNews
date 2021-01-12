<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laravel-News</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="body">
  
  <?php
  require('header.php');
  ?>

<div class="margin-top"></div>
<?php
  $fp = fopen("message.txt", "r");
  while(!feof($fp)){
    $buffer = fgets($fp, 4096);
    if(strstr($buffer, $_SESSION['title'])){
      $aaa = $buffer;
      break;
    }
  }
  fclose($fp);
 ?><br>
<div class="margin-top"></div>

<div class="margin-top"></div>
<p class="border"></p><br>


  <a href="index.php">投稿画面に戻る</a>

</body>
</html>