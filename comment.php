<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="body">
  
  <?php
  require('header.php');
  ?>

  <?php
  if(!empty($_POST['title'])) echo $_POST['title'];
  ?>

  <a href="index.php">投稿画面に戻る</a>

</body>
</html>