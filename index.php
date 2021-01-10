<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Document</title>
</head>
<body class="body">

  <!--　ヘッダー　-->
  <div class="header">
    <header>Laravel News</header>
  </div>
  
  <!--　h１　-->
  <h1 class="h1">さぁ、最新のニュースをシェアしましょう</h1>

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
      <input type="submit" value="投稿">
      </form>
  </div>


</body>
</html>