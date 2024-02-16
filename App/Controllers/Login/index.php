<?php

namespace App\Controllers\Login;

use App\Core\Controller;
use App\Db;

class index extends Controller
{
  protected function construct()
  {
    if ($this->check_response(['submit'])) {
      $this->login();
    }

    $this->view->display('Auth/login');
  }

  private function login()
  {
    $UsersSecretData = new \App\Models\UsersSecretData();
    $UsersSecretData->load($_POST);
    $UsersSecretData->validate($_POST);
    $user_id = $UsersSecretData->login();

    if ($user_id) {
      $email = $UsersSecretData->attributes['email'];
      $UsersInfo = new \App\Models\UsersInfo();
      $user_info = $UsersInfo->selectOne(
        ['username', 'link', 'avatar', 'city', 'info', 'info', 'role', 'status', 'datetime', 'user_id'],
        ['user_id' => $user_id]
      );
      $user_info["email"] = $email;

      $this->setUserSession($user_info);
      $UsersSecretData->sendResponse('Вы успешно авторизованы', $user_info);
    } else {
      $UsersSecretData->sendResponse('Логин или пароль введены неверно', [], 400);
    }
    redirect('/profile');
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
