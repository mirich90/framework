<?php

namespace App\Controllers\Profile;

use App\Core\Controller;
use App\Db;

class show extends Controller
{
  protected function construct()
  {
    $UsersInfo = new \App\Models\UsersInfo();

    $usersInfo = $UsersInfo->selectOne(
      ['link', 'avatar', 'city', 'username', 'info', 'datetime', 'role', 'status', 'user_id'],
      ['link' => $_GET['id']]
    );
    $user = $this->getUserSecret($usersInfo);

    $this->view->user = array_merge($user, $usersInfo);

    $this->view->display('Profile/show');
  }

  private function getUserSecret($usersInfo)
  {
    $UsersSecretData = new \App\Models\UsersSecretData();
    $usersSecretData =  $UsersSecretData->selectOne(
      ['email', 'id'],
      ['id' => $usersInfo['user_id']]
    );

    return $usersSecretData;
  }

  protected function title()
  {
    return "Indyground";
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
