<?php
//外部ファイルを読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

//セッション開始
session_start();

//ログイン状況確認
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
//cart_id,数量をPOST取得
$cart_id = get_post('cart_id');
$amount = get_post('amount');

//購入数を追加
if(update_cart_amount($db, $cart_id, $amount)){
  set_message('購入数を更新しました。');
} else {
  set_error('購入数の更新に失敗しました。');
}

//カートページヘジャンプ
redirect_to(CART_URL);