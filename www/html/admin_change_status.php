<?php
//外部ファイルの読み込み
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

//管理者でない場合、ログイン画面へ
if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}

//item_idを$_POSTで取得
$item_id = get_post('item_id');
//ステータスの変更内容を$_POSTで取得
$changes_to = get_post('changes_to');

//商品ステータスを変更
if($changes_to === 'open'){
  update_item_status($db, $item_id, ITEM_STATUS_OPEN);
  set_message('ステータスを変更しました。');
}else if($changes_to === 'close'){
  update_item_status($db, $item_id, ITEM_STATUS_CLOSE);
  set_message('ステータスを変更しました。');
}else {
  set_error('不正なリクエストです。');
}

//管理者ページヘジャンプ
redirect_to(ADMIN_URL);