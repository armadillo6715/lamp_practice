<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';

session_start();

if(is_logined() === true){
  redirect_to(HOME_URL);
}
//トークン生成
$token = get_csrf_token();
include_once VIEW_PATH . 'signup_view.php';



