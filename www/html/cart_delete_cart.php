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
//セッションID取得
$user = get_login_user($db);

//cart_idをPOST取得
$cart_id = get_post('cart_id');

//カート商品の削除
if(delete_cart($db, $cart_id)){
  set_message('カートを削除しました。');
} else {
  set_error('カートの削除に失敗しました。');
}

//カートページヘジャンプ
redirect_to(CART_URL);