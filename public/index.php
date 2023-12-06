<?php

require __DIR__ . '/../App/Core/Autoload.php';
require __DIR__ . '/../App/Core/Function.php';
require __DIR__ . '/../App/Function/converter.php';
require __DIR__ . '/../App/Function/session.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$ctrl = getControllerName();

try {
  $ctrl = getClassName($ctrl);
  $ctrl();
} catch (\App\Core\DbException $error) {
  echo 'Ошибка в БД: ' . $error->getMessage();
  die;
} catch (\App\Core\Errors $errors) {
  foreach ($errors->all() as $error) {
    echo 'Ошибка: ' . $error->getMessage();
    echo '<br />';
  }
}
