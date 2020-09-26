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

//DB接続
$db = get_db_connect();
//セッションIDを取得
$user = get_login_user($db);
//カートの商品情報を取得
$carts = get_user_carts($db, $user['user_id']);
//合計金額を取得
$total_price = sum_carts($carts);

//トークン生成
$token = get_csrf_token();

//外部ファイル読み込み
include_once VIEW_PATH . 'cart_view.php';