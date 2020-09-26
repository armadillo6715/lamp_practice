<?php
//外部ファイルを読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';

//セッション開始
session_start();

//ログイン状況を確認
if(is_logined() === true){
  redirect_to(HOME_URL);
}

//トークン生成
$token = get_csrf_token();

//外部ファイルを読み込み
include_once VIEW_PATH . 'login_view.php';