<?php
//外部ファイルを読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

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
//公開商品のみ取得
$items = get_open_items($db);

//トークン生成
$token = get_csrf_token();

//外部ファイルを読み込み
include_once VIEW_PATH . 'index_view.php';