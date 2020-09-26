<?php
//外部ファイルを読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

//セッション開始
session_start();

//ログイン状態を確認
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

//トークン照合
$token = get_post('token');
if (is_valid_csrf_token($token) === false) {
  redirect_to(LOGIN_URL);
}

//トークン破棄
unset($_SESSION['csrf_token']);

//DB接続
$db = get_db_connect();

//セッションIDを取得
$user = get_login_user($db);

//管理者以外はログインページへ
if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}

//item_idを取得
$item_id = get_post('item_id');

//商品を削除
if(destroy_item($db, $item_id) === true){
  set_message('商品を削除しました。');
} else {
  set_error('商品削除に失敗しました。');
}

//管理者ページヘジャンプ
redirect_to(ADMIN_URL);