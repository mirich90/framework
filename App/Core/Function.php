<?php

// beauty var_dump
function c($var)
{
  static $int = 0;
  echo '<pre><b style="background: cyan;padding: 1px 5px;">' . $int . '</b> ';
  var_dump($var);
  echo '</pre>';
  $int++;
}

function d($path)
{
  $home_directory = __DIR__ . '/../../';
  return $home_directory . str_replace('\\', '/', $path);
}

function p($path)
{
  $is_local = (include d('/.env.php'))['is_local'];
  $public_dir = ($is_local) ? 'public' : 'public_html';
  return d($public_dir . $path);
}

function redirect($http = false)
{
  if ($http) {
    $redirect = $http;
  } else {
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
  }
  header("Location: $redirect");
  die;
}

function getObContent()
{
  $ob_content = ob_get_contents();
  ob_end_clean();
  return $ob_content;
}

function getNameClass($class)
{
  return explode('\\', get_class($class));
}

function getNameCss($class)
{
  $class = getNameClass($class);
  return 'page' . $class[2] . ucfirst($class[3]);
}

function getUri()
{
  $uri = $_SERVER['REQUEST_URI'];
  $parts = explode('/', parse_url($uri, PHP_URL_PATH));
  return $parts[1];
}

function getControllerName()
{
  $uri =  getUri();
  $ctrl = $uri ? $uri :  'index';
  return ucfirst($ctrl);
}

function getClassName($ctrl)
{
  if (isset($_GET['id'])) {
    $filename = 'show';
  } else if (isset($_GET['create'])) {
    $filename = 'create';
  } else {
    $filename = 'index';
  }


  $class = '\App\Controllers\NotFound\index';
  $path = d("/App/Controllers/$ctrl/$filename.php");

  if (file_exists($path)) {
    $class = "\App\Controllers\\$ctrl\\$filename";
  }

  return new $class;
}

function props($props, $key, $default = '', $new_value = null)
{
  if (isset($props[$key])) {
    if ($new_value == null) return $props[$key];
    $new_value = str_replace('___', $props[$key], $new_value);
    return $new_value;
  } else {
    return $default;
  }
}


function translit($value)
{
  $converter = array(
    'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
    'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
    'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
    'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
    'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
    'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
    'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
  );

  $value = mb_strtolower($value);
  $value = strtr($value, $converter);
  $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
  $value = mb_ereg_replace('[-]+', '-', $value);
  $value = trim($value, '-');

  return $value;
}

function translitSrc($str)
{
  $image_name = translit($str);
  $random = random_int(100, 999);
  $date = date('Ymd_His_');
  $src = $date . $random . "_$image_name";
  return $src;
}

function randomCode($len)
{
  $code = "";
  $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $pos = strlen($char);
  $pos = pow($pos, $len);
  $total = strlen($char) - 1;

  for ($i = 0; $i < $len; $i++) {
    $code = $code . $char[rand(0, $total)];
  }
  return $code;
}
