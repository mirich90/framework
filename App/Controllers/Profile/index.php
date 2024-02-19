<?php

namespace App\Controllers\Profile;

use App\Core\Controller;
use App\Db;
use App\Functions\FUser;

class index extends profile
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

    $usersInfo = $this->getUsersInfo();
    $userSecret = $this->getUserSecret($usersInfo);
    $count_notes = $this->getCountNotes($usersInfo);
    $count_images = $this->getCountImages($usersInfo);

    $this->view->user = array_merge($userSecret, $usersInfo);
    $this->view->count_notes = $count_notes;
    $this->view->count_images = $count_images;

    $this->view->display('Profile/index');
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
