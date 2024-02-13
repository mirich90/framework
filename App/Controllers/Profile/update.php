<?php

namespace App\Controllers\Profile;

use App\Core\Controller;
use App\Db;
use App\Functions\FUser;

class update extends Controller
{
  public function access(): bool
  {
    if (!FUser::isLogin()) {
      redirect('/login');
      die;
    }

    if ($_GET['id'] !== FUser::isLink()) {
      redirect('/not_found');
      die;
    }

    return true;
  }

  protected function construct()
  {
    if ($this->check_response(['submit'])) {
      $this->update();
      die;
    }

    $usersInfo = $this->getUsersInfo();
    $userSecret = $this->getUserSecret($usersInfo);

    $this->view->user = array_merge($userSecret, $usersInfo);
    $this->view->display('Profile/update');
  }

  private function getUserSecret($usersInfo)
  {
    $UsersSecretData = new \App\Models\UsersSecretData();
    return $UsersSecretData->selectOne(
      ['email'],
      ['id' => $usersInfo['user_id']]
    );
  }

  private function getUsersInfo()
  {
    $UsersInfo = new \App\Models\UsersInfo();
    return $UsersInfo->selectOne(
      ['link',  'city', 'username', 'info', 'user_id', 'role', 'status', 'avatar', 'datetime'],
      ['link' => $_GET['id']]
    );
  }

  private function update()
  {
    $id = intval(FUser::getId());

    $UsersInfo = new \App\Models\UsersInfo();
    $UsersSecretData = new \App\Models\UsersSecretData();

    $isEditUsersInfo = $this->updateUsersInfo($UsersInfo, $id);
    $isUsersSecretData = $this->updateUsersSecretData($UsersSecretData, $id);

    if ($isEditUsersInfo && $isUsersSecretData) {
      $usersInfo = $this->getUsersInfo();
      $userSecret = $this->getUserSecret($usersInfo);

      $user = array_merge($userSecret, $usersInfo);

      $UsersInfo->createResponse([
        "status" => 200,
        'message' => "Профиль успешно отредактирован",
        "data" => $user,
        'class' => 'Profile'
      ]);

      $this->setUserSession($user);

      redirect('/profile?update&id=' . $usersInfo['link']);
    }
  }

  private function updateUsersInfo($UsersInfo, $id)
  {
    $UsersInfo->load($_POST, true);
    $UsersInfo->validate($_POST, true);

    return $UsersInfo->edit(['username', 'link', 'info', 'city'], ['user_id', $id]);
  }

  private function updateUsersSecretData($UsersSecretData, $id)
  {
    $UsersSecretData->load($_POST, true);
    $UsersSecretData->validate($_POST, true);

    return $UsersSecretData->edit(['email'], ['id', $id]);
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
