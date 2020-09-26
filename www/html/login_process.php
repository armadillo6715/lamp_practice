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

//DB接続
$db = get_db_connect();

//ログインユーザーの特定
$user = login_as($db, $name, $password);
if($user === false){
  set_error('ログインに失敗しました。');
  redirect_to(LOGIN_URL);
}

set_message('ログインしました。');

//管理者は管理者ページヘジャンプ
if ($user['type'] === USER_TYPE_ADMIN){
  redirect_to(ADMIN_URL);
}
//ホーム画面へジャンプ
redirect_to(HOME_URL);