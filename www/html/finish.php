<?php
//外部ファイルを読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

//セッション開始
session_start();

//ログイン状況を確認
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

//カート内商品の取得
$carts = get_user_carts($db, $user['user_id']);

//購入失敗時、カートページヘジャンプ
if(purchase_carts($db, $carts) === false){
  set_error('商品が購入できませんでした。');
  redirect_to(CART_URL);
} 
history_detail($db,$carts);

//合計金額
$total_price = sum_carts($carts);

//外部ファイルを読み込み
include_once '../view/finish_view.php';