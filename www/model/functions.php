<?php
//変数表示
function dd($var){
  var_dump($var);
  exit();
}
//引数のURLへリダイレクト
function redirect_to($url){
  //任意のURLへジャンプ
  header('Location: ' . $url);
  //これ以下のスクリプト拒否
  exit;
}
//$_GETのisset処理
function get_get($name){
  if(isset($_GET[$name]) === true){
    return $_GET[$name];
  };
  return '';
}
//$_POSTのisset処理
function get_post($name){
  if(isset($_POST[$name]) === true){
    return $_POST[$name];
  };
  return '';
}
//$_FILESのisset処理
function get_file($name){
  if(isset($_FILES[$name]) === true){
    return $_FILES[$name];
  };
  return array();
}
//$_SESSIONのisset処理
function get_session($name){
  if(isset($_SESSION[$name]) === true){
    return $_SESSION[$name];
  };
  return '';
}
//$_SESSION作成
function set_session($name, $value){
  $_SESSION[$name] = $value;
}
//エラーsessionへ追記
function set_error($error){
  $_SESSION['__errors'][] = $error;
}
//エラーを出力後、リセット
function get_errors(){
  $errors = get_session('__errors');
  if($errors === ''){
    return array();
  }
  set_session('__errors',  array());
  return $errors;
}
//エラーsessionが1つ以上存在するかをチェック
function has_error(){
  return isset($_SESSION['__errors']) && count($_SESSION['__errors']) !== 0;
}
//メッセージsessionへ追記
function set_message($message){
  $_SESSION['__messages'][] = $message;
}
//メッセージを出力後、リセット
function get_messages(){
  $messages = get_session('__messages');
  if($messages === ''){
    return array();
  }
  set_session('__messages',  array());
  return $messages;
}
//$_SESSION['user_id']が存在することを検証
function is_logined(){
  return get_session('user_id') !== '';
}
//新たなファイル名を作成する
function get_upload_filename($file){
  //アップロード失敗した時に、空を返す。
  if(is_valid_upload_image($file) === false){
    return '';
  }
  //ファイルタイプ(jpegなど)を取得
  $mimetype = exif_imagetype($file['tmp_name']);
  $ext = PERMITTED_IMAGE_TYPES[$mimetype];
  //ランダムな文字列にファイルタイプを付ける
  return get_random_string() . '.' . $ext;
}
//ランダムな文字列を取得
function get_random_string($length = 20){
  return substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, $length);
}
//アップロードしたファイルを別ファイルへ移動
function save_image($image, $filename){
  return move_uploaded_file($image['tmp_name'], IMAGE_DIR . $filename);
}
//画像ファイルの削除
function delete_image($filename){
  //ファイルの存在有無を調べる
  if(file_exists(IMAGE_DIR . $filename) === true){
    //ファイルを削除する
    unlink(IMAGE_DIR . $filename);
    return true;
  }
  return false;
  
}
//文字数の範囲を決定する
function is_valid_length($string, $minimum_length, $maximum_length = PHP_INT_MAX){
  $length = mb_strlen($string);
  return ($minimum_length <= $length) && ($length <= $maximum_length);
}

function is_alphanumeric($string){
  return is_valid_format($string, REGEXP_ALPHANUMERIC);
}

function is_positive_integer($string){
  return is_valid_format($string, REGEXP_POSITIVE_INTEGER);
}

function is_valid_format($string, $format){
  return preg_match($format, $string) === 1;
}


function is_valid_upload_image($image){
  //ファイルがアップロードされたか検証
  if(is_uploaded_file($image['tmp_name']) === false){
    set_error('ファイル形式が不正です。');
    return false;
  }
  $mimetype = exif_imagetype($image['tmp_name']);
  if( isset(PERMITTED_IMAGE_TYPES[$mimetype]) === false ){
    set_error('ファイル形式は' . implode('、', PERMITTED_IMAGE_TYPES) . 'のみ利用可能です。');
    return false;
  }
  return true;
}

function h($str) {
  $str = htmlspecialchars($str,ENT_QUOTES,'utf-8');
  return $str;
}

//トークン生成関数
function get_csrf_token(){
  // get_random_string()はユーザー定義関数。
  $token = get_random_string(30);
  // set_session()はユーザー定義関数。
  set_session('csrf_token', $token);
  return $token;
}

//トークン照合関数
function is_valid_csrf_token($token){
  if($token === '') {
    return false;
  }
  // get_session()はユーザー定義関数
  return $token === get_session('csrf_token');
}