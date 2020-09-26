<?php
//外部ページを読み込み
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
//在庫情報を取得
$stock = get_post('stock');

//在庫数を更新
if(update_item_stock($db, $item_id, $stock)){
  set_message('在庫数を変更しました。');
} else {
  set_error('在庫数の変更に失敗しました。');
}

//管理者ページヘジャンプ
redirect_to(ADMIN_URL);