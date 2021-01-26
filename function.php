<?php

error_reporting(E_ALL); //E_STRICTレベル以外のエラーを報告する
ini_set('display_errors','on'); //画面にエラーを表示させるか

//============================
//定数
//============================
//エラーメッセージを定数に設定
define('VALID_TITLE','タイトルは入力必須です');
define('VALID_KIZI','記事は入力必須です');
define('VALID_COMMENT','コメントは入力必須です');
define('VALID_TITLE_30','タイトルは30文字以下です');
define('VALID_COMMENT_50','コメントは50文字以下です');

//エラーメッセージ格納用の配列
$err_msg = array();

//===============================
// バリデーション関数
//===============================

//バリデーション関数(未入力チェック(title))
function validRequiredtitle($str, $key){
  if(empty($str)){
    global $err_msg;
    $err_msg[$key] = VALID_TITLE;
  }
}

//バリデーション関数(未入力チェック(text))
function validRequiredtext($str, $key){
  if(empty($str)){
    global $err_msg;
    $err_msg[$key] = VALID_KIZI;
  }
}

//バリデーション関数(未入力チェック(text))
function validRequiredcomment($str, $key){
  if(empty($str)){
    global $err_msg;
    $err_msg[$key] = VALID_COMMENT;
  }
}


//バリデーション関数(30文字以下)
function validMaxsan($str, $key, $max = 30){
  if(mb_strlen($str) > $max){
    global $err_msg;
    $err_msg[$key] = VALID_TITLE_30;
  }
}

//バリデーション関数(50文字以下)
function validMaxgo($str, $key, $max = 50){
  if(mb_strlen($str) > $max){
    global $err_msg;
    $err_msg[$key] = VALID_COMMENT_50;
  }
}

//=====================================
// データベース
//=====================================
//DB接続関数
function dbConnect(){
  //DBへの接続準備
  $dsn = 'mysql:dbname=laravel_news;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $options = array(
    //SQL実行失敗時にはエラーコードのみ設定
    PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    //デフォルトフェッチモードを連想配列形式に設定
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //バッファードクエリを使う(一度に結果セットを全て取得し、サーバー負荷)
    //SELECTで得た結果に対してもrowCountメソッドを使えるようにする
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
  );
  //PDOオブジェクト生成(DBへ接続)
  $dbh = new PDO($dsn, $user, $password, $options);
  return $dbh;
}
//SQL実行関数
function queryPost($dbh, $sql, $data){
  //クエリー作成
  $stmt = $dbh->prepare($sql);
  //プレースホルダに値をセットし、SQL文を実行
  $stmt->execute($data);
  return $stmt;
}

?>