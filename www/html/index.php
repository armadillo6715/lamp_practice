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
//トークン生成
$token = get_csrf_token();
//全商品数
$total_item = total_item($db);
//全ページ数
$total_page = ceil($total_item['total_item']/MAX_VIEW);
//現在いるのページ
if(!isset($_GET['page'])){
  $now_page = 1;
}else{
  $now_page = $_GET['page'];
}
//取得開始の商品
$start_item = ($now_page-1) * MAX_VIEW;
//公開商品のみ取得
$items = get_open_items($db);
//購入ランキングを取得
$ranking = ranking($db);
//初期化（初期値は1）
$i = 1;
//トークン生成
$token = get_csrf_token();
//商品の取得範囲
$item_range = array_slice($items,$start_item,MAX_VIEW,true);
//外部ファイルを読み込み
include_once VIEW_PATH . 'index_view.php';