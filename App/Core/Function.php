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
  $is_local = env('is_local');
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
  if (isset($_GET['update'])) {
    if (isset($_GET['id'])) {
      $filename = 'update';
    } else {
      $filename = 'create';
    }
  } else if (isset($_GET['create'])) {
    $filename = 'create';
  } else if (isset($_GET['id'])) {
    $filename = 'show';
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

function env($key)
{
  $env = (include d('/.env.php'));
  return $env[$key];
}

function JSON($array)
{
  return  json_encode($array, JSON_UNESCAPED_UNICODE);
}

function props($props, $key, $default = '', $new_value = null)
{
  if (isset($props[$key])) {
    if ($props[$key] === false) return $default;
    if ($new_value == null) return $props[$key];
    if ($props[$key] === true) return $new_value;
    $new_value = str_replace('___', $props[$key], $new_value);
    return $new_value;
  } else {
    return $default;
  }
}
