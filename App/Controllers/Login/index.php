<?php

namespace App\Controllers\Login;

use App\Core\Controller;
use App\Db;

class index extends Controller
{
  protected function construct()
  {
    $UsersSecretData = new \App\Models\UsersSecretData();
    if ($UsersSecretData->check_response(['submit'])) {
      $this->login($UsersSecretData);
    }

    $this->view->display('Auth/login');
  }

  private function login($UsersSecretData)
  {
    $UsersSecretData->load($_POST);
    $UsersSecretData->validate($_POST);

    if ($UsersSecretData->login()) {
      $UsersSecretData->sendResponse('Вы успешно авторизованы', [], true);;
    } else {
      $UsersSecretData->sendResponse('Логин или пароль введены неверно', [], true);;
    }
    redirect();
  }

  protected function title()
  {
    return "Заметки сайта Indyground";
  }

  protected function description()
  {
    return "Indyground - сайт о создателях игр, музыки, графики и всего осталнього творчества";
  }

  protected function keywords()
  {
    return "Indyground, инди, RPG maker";
  }

  protected function author()
  {
    return "Yuryol";
  }
}
