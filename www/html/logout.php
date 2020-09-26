<?php
//外部ファイルを読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';

//セッション開始
session_start();

$_SESSION = array();

//Cookieの削除
$params = session_get_cookie_params();
setcookie(session_name(), '', time() - 42000,
  $params["path"], 
  $params["domain"],
  $params["secure"], 
  $params["httponly"]
);
session_destroy();

//ログインページへリダイレクト
redirect_to(LOGIN_URL);
