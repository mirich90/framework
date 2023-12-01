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
  $class = '\App\Controllers\NotFound';
  $file = d("/App/Controllers/$ctrl.php");

  if (file_exists($file)) {
    $class = "\App\Controllers\\$ctrl";
  }

  return new $class;
}
