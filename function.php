<?php

ini_set('log_errors','on'); //ログを取るか
ini_set('error_log','php.log'); //ログの出力ファイルを指定

//============================
//定数
//============================
//エラーメッセージを定数に設定
define('MSG01','タイトルは入力必須です');
define('MSG02','コメントは入力必須です');
define('MSG03','タイトルは30文字以下です');
define('MSG04','コメントは50文字以下です');

//エラーメッセージ格納用の配列
$err_msg = array();

//バリデーション関数(未入力チェック(title))
function validRequiredtitle($str, $key){
  if(empty($str)){
    global $err_msg;
    $err_msg[$key] = MSG01;
  }
}

//バリデーション関数(未入力チェック(text))
function validRequiredtext($str, $key){
  if(empty($str)){
    global $err_msg;
    $err_msg[$key] = MSG02;
  }
}


//バリデーション関数(30文字以下)
function validMax30($str, $key, $max = 30){
  if(mb_strlen($str) > $max){
    global $err_msg;
    $err_msg[$key] = MSG02;
  }
}

//バリデーション関数(50文字以下)
function validMax50($str, $key, $max = 50){
  if(mb_strlen($str) > $max){
    global $err_msg;
    $err_msg[$key] = MSG03;
  }
}

?>