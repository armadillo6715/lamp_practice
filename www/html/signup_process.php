<?php
//外部ファイルを読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

//セッション開始
session_start();

//ログイン状況を確認
if(is_logined() === true){
  redirect_to(HOME_URL);
}

//トークン照合
$token = get_post('token');
if (is_valid_csrf_token($token) === false) {
  redirect_to(LOGIN_URL);
}

//トークン破棄
unset($_SESSION['csrf_token']);

$name = get_post('name');
$password = get_post('password');
$password_confirmation = get_post('password_confirmation');

//DB接続
$db = get_db_connect();

//ユーザー登録
try{
  $result = regist_user($db, $name, $password, $password_confirmation);
  if( $result=== false){
    set_error('ユーザー登録に失敗しました。');
    redirect_to(SIGNUP_URL);
  }
}catch(PDOException $e){
  set_error('ユーザー登録に失敗しました。');
  redirect_to(SIGNUP_URL);
}

set_message('ユーザー登録が完了しました。');

//ユーザーの特定
login_as($db, $name, $password);
//ホーム画面へジャンプ
redirect_to(HOME_URL);