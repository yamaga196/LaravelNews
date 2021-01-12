<?php

error_reporting(E_ALL); //E_STRICTレベル以外のエラーを報告する
ini_set('display_errors','on'); //画面にエラーを表示させるか

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
function validMaxsan($str, $key, $max = 30){
  if(mb_strlen($str) > $max){
    global $err_msg;
    $err_msg[$key] = MSG03;
  }
}

//バリデーション関数(50文字以下)
function validMaxgo($str, $key, $max = 50){
  if(mb_strlen($str) > $max){
    global $err_msg;
    $err_msg[$key] = MSG03;
  }
}

?>