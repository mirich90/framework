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

function getControllerName()
{
  $uri = $_SERVER['REQUEST_URI'];
  $parts = explode('/', $uri);
  $ctrl = $parts[1] ? $parts[1] : 'Index';
  return ucfirst($ctrl);
}

function getClassName($ctrl)
{
  $class = '\App\Controllers\NotFound';
  $file = d("/App/Controllers/$ctrl.php");

  if (file_exists($file)) {
    $class = "\App\Controllers\\$ctrl";
  }

  return new  $class;
}
