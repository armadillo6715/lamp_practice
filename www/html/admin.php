<?php
//定数ファイルの読み込み
require_once '../conf/const.php';
//関数ファイルの読み込み
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
//セッション開始
session_start();
//ログイン状態を確認
if(is_logined() === false){
  //失敗の場合、ログイン画面へリダイレクト
  redirect_to(LOGIN_URL);
}
//DB接続
$db = get_db_connect();
//loginIDの取得
$user = get_login_user($db);
//ID取得が出来ない場合、ログイン画面へリダイレクト
if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}
//DB接続状態ならば、全商品情報を取得
$items = get_all_items($db);
//トークン生成
$token = get_csrf_token();
//外部のviewファイルを一度だけ読み込む
include_once VIEW_PATH . '/admin_view.php';
