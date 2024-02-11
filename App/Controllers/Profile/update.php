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


    return true;
  }

  protected function construct()
  {
    if ($this->check_response(['submit'])) {
      $this->update();
      die;
    }

    $this->view->display('Profile/update');
  }

  private function update()
  {
    $UsersInfo = new \App\Models\UsersInfo();
    $UsersInfo->load($_POST, true);
    $UsersInfo->validate($_POST, true);

    $id = intval(FUser::getId());
    $is_edit = $UsersInfo->edit(['username', 'link', 'info', 'city'], ['user_id', $id]);

    if ($is_edit) {
      $user_info = $UsersInfo->selectOne($id, 'user_id', ['username', 'link', 'avatar', 'city', 'info', 'info', 'role', 'status', 'datetime', 'user_id']);
      $data = array_merge($user_info,  ['email' => FUser::getEmail()]);

      $UsersInfo->createResponse([
        "status" => 200,
        'message' => "Профиль успешно отредактирован",
        "data" => $data,
        'class' => 'Profile'
      ]);

      $this->setUserSession($data);

      redirect('/profile?update');
    }
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
